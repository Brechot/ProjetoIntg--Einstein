<?php

namespace App\Http\Livewire\Reserve;

use App\Models\Discipline;
use App\Models\Laboratory;
use App\Models\Reserve;
use Carbon\Carbon;
use Livewire\Component;

class Create extends Component
{

    public $laboratory;

    public Reserve $reserve;

    public $discipline = [];

    public $open,
           $repeat,
           $automatic;


    public function mount($laboratoryId)
    {
        $this->laboratory = Laboratory::with('softwares')->findOrFail($laboratoryId);
        $this->reserve = new Reserve();
        $this->reserve->user_id = auth()->id();
        $this->reserve->status = 1;
        $this->reserve->laboratory_id = $laboratoryId;
        $this->reserve->automatic = false;

        $this->gettingDisciplineName();

        $this->emit('refreshCalendar');
    }

    public function render()
    {
        $this->gettingDisciplineName();
        return view('livewire.reserve.create');
    }

    public function submit()
    {
        $this->validate();

        $this->createReservation();
    }

    public function createReservation()
    {
        if (empty($this->repeat)) {
            $this->createSingleReservation();
        } else {

            switch ($this->repeat) {
                case 1:
                    $this->createDailyReservation();
                    break;
                case 2:
                    $this->createWeekReservation();
                    break;
                case 3:
                    $this->createMonthReservation();
                    break;

            }
        }
    }

    public function createSingleReservation()
    {
        $startDate = Carbon::createFromFormat('Y-m-d', $this->reserve->datini);
        $endDate = Carbon::createFromFormat('Y-m-d', $this->reserve->datfin);
        $startTime = Carbon::createFromFormat('H:i', $this->reserve->horini);
        $endTime = Carbon::createFromFormat('H:i', $this->reserve->horfin);
        $hasAnyConflict = false;

//          Mescla a data atual do loop com o horário para fazer a comparação no $hasConflict
        $startDateTime = Carbon::parse($startDate->toDateString() . ' ' . $startTime->format('H:i'));
        $endDateTime = Carbon::parse($endDate->toDateString() . ' ' . $endTime->format('H:i'));

//           Verifica conflitos com o intervalo total
        $hasConflict = Reserve::where('laboratory_id', $this->laboratory->id)
            ->where('status', '<>', 3)
            ->where(function ($query) use ($startDateTime, $endDateTime) { // function ($query) cria um bloco de condições, exemplo em sql -> SELECT * FROM reservations WHERE laboratory_id = 1 AND (horini < '10:00:00' AND horfin > '08:00:00')
                $query->whereRaw("STR_TO_DATE(CONCAT(datini, ' ', horini), '%Y-%m-%d %H:%i:%s') < ?", [$endDateTime])//Concateno meus campos da tabela para poder fazer a comparação com a variavel do laravel
                ->whereRaw("STR_TO_DATE(CONCAT(datfin, ' ', horfin), '%Y-%m-%d %H:%i:%s') > ?", [$startDateTime]);
            })
            ->exists();

        if ($hasConflict){
            $hasAnyConflict = true;
        }else{

            if($this->automatic){
                $this->reserve->status = 2;
            }else{
                $this->reserve->status = 1;
            }

            $this->reserve->save();
        }

        if ($hasAnyConflict) {
            return redirect()->route('einstein.reserve.create',$this->laboratory->id)->with('warning', 'Conflito na data, já existe uma reserva nesta data no item selecionado!');
        }
//        else{
//            Mail::to($this->reservation->subarea->email)->send(new \App\Mail\Reservation\ReserveMail($this->reservation));
//        }

        return redirect()->route('einstein.reserve.create',$this->laboratory->id)->with('success', 'Reserva Criada com Sucesso!');
    }

    //Reserva Diária
    public function createDailyReservation()
    {
        $startDate = Carbon::createFromFormat('Y-m-d', $this->reserve->datini);
        $endDate = Carbon::createFromFormat('Y-m-d', $this->reserve->datfin);
        $startTime = Carbon::createFromFormat('H:i', $this->reserve->horini);
        $endTime = Carbon::createFromFormat('H:i', $this->reserve->horfin);

        $count = 0;
        $maxReserves = 365;
        $datesToReserve = [];

//       Verifica se existe conflito em qualquer dia
        while ($startDate->lessThanOrEqualTo($endDate) && $count < $maxReserves) {
            $startDateTime = Carbon::parse($startDate->toDateString() . ' ' . $startTime->format('H:i'));
            $endDateTime = Carbon::parse($startDate->toDateString() . ' ' . $endTime->format('H:i'));

//          Mescla a data atual do loop com o horário para fazer a comparação no $hasConflict
//          Verifica conflitos
            $hasConflict = Reserve::where('laboratory_id', $this->laboratory->id)
                ->where('status', '<>', 3)
                ->where(function ($query) use ($startDateTime, $endDateTime) { // function ($query) cria um bloco de condições, exemplo em sql -> SELECT * FROM reservations WHERE laboratory_id = 1 AND (horini < '10:00:00' AND horfin > '08:00:00')
                    $query->whereRaw("STR_TO_DATE(CONCAT(datini, ' ', horini), '%Y-%m-%d %H:%i:%s') < ?", [$endDateTime])//Concateno meus campos da tabela para poder fazer a comparação com a variavel do laravel
                    ->whereRaw("STR_TO_DATE(CONCAT(datfin, ' ', horfin), '%Y-%m-%d %H:%i:%s') > ?", [$startDateTime]);
                })
                ->exists();

            if ($hasConflict) {
//               se achar conflito
                $startDate = Carbon::parse($startDate);
                return redirect()->route('einstein.reserve.create',$this->laboratory->id)->with('warning', 'Conflito encontrado na data: ' . $startDate->format('d/m/Y') . '. Nenhuma reserva foi criada.');
            }

//          salva a data para criar depois
            $datesToReserve[] = $startDate->copy();

            $startDate->addDay();
            $count++;
        }

//      nenhum conflito encontrado, agora cria as reservas
        foreach ($datesToReserve as $date) {
            $reservation = $this->reserve->replicate(); // precisa criar uma nova variavel para nao dar problema no salvamento

            $reservation->datini = $date->toDateString(); // Adicionando cada dia do periodo selecionado
            $reservation->datfin = $date->toDateString();

            $reservation->status = $this->automatic ? 2 : 1;

            $reservation->save();
        }

//        Mail::to('henrique.brechot@villagres.com.br')->send(new \App\Mail\Reservation\ReserveMail($this->reservation));


        return redirect()->route('einstein.reserve.create',$this->laboratory->id)->with('success', 'Reservas diárias criadas com sucesso!');
    }


    //Reserva Semanal
    public function createWeekReservation()
    {
        $startDate = Carbon::createFromFormat('Y-m-d', $this->reserve->datini);
        $endDate = Carbon::createFromFormat('Y-m-d', $this->reserve->datfin);
        $startTime = Carbon::createFromFormat('H:i', $this->reserve->horini);
        $endTime = Carbon::createFromFormat('H:i', $this->reserve->horfin);

        $count = 0;
        $maxReserves = 52;
        $datesToReserve = [];

//       Verifica se existe conflito em qualquer dia
        while ($startDate->lessThanOrEqualTo($endDate) && $count < $maxReserves) {
            $startDateTime = Carbon::parse($startDate->toDateString() . ' ' . $startTime->format('H:i'));
            $endDateTime = Carbon::parse($startDate->toDateString() . ' ' . $endTime->format('H:i'));

//          Mescla a data atual do loop com o horário para fazer a comparação no $hasConflict
//          Verifica conflitos
            $hasConflict = Reserve::where('laboratory_id', $this->laboratory->id)
                ->where('status', '<>', 3)
                ->where(function ($query) use ($startDateTime, $endDateTime) { // function ($query) cria um bloco de condições, exemplo em sql -> SELECT * FROM reservations WHERE laboratory_id = 1 AND (horini < '10:00:00' AND horfin > '08:00:00')
                    $query->whereRaw("STR_TO_DATE(CONCAT(datini, ' ', horini), '%Y-%m-%d %H:%i:%s') < ?", [$endDateTime])//Concateno meus campos da tabela para poder fazer a comparação com a variavel do laravel
                    ->whereRaw("STR_TO_DATE(CONCAT(datfin, ' ', horfin), '%Y-%m-%d %H:%i:%s') > ?", [$startDateTime]);
                })
                ->exists();

            if ($hasConflict) {
//               se achar conflito
                $startDate = Carbon::parse($startDate);
                return redirect()->route('einstein.reserve.create',$this->laboratory->id)->with('warning', 'Conflito encontrado na data: ' . $startDate->format('d/m/Y') . '. Nenhuma reserva foi criada.');
            }

//          salva a data para criar depois
            $datesToReserve[] = $startDate->copy();

            $startDate->addDays(7);
            $count++;
        }

//      nenhum conflito encontrado, agora cria as reservas
        foreach ($datesToReserve as $date) {
            $reservation = $this->reserve->replicate(); // precisa criar uma nova variavel para nao dar problema no salvamento

            $reservation->datini = $date->toDateString(); // Adicionando cada dia do periodo selecionado
            $reservation->datfin = $date->toDateString();

            $reservation->status = $this->automatic ? 2 : 1;

            $reservation->save();
        }

//        Mail::to('henrique.brechot@villagres.com.br')->send(new \App\Mail\Reservation\ReserveMail($this->reservation));
        //$this->reservation->subarea->email
//        if($this->changeArea != 1){
//            Mail::to('henrique.brechot@villagres.com.br')->send(new \App\Mail\Reservation\ReserveMail($this->reservation));
//        }

        return redirect()->route('einstein.reserve.create',$this->laboratory->id)->with('success', 'Reservas semanais criadas com sucesso!');
    }
    //Reserva Mensal
    public function createMonthReservation()
    {
        $startDate = Carbon::createFromFormat('Y-m-d', $this->reserve->datini);
        $endDate = Carbon::createFromFormat('Y-m-d', $this->reserve->datfin);
        $startTime = Carbon::createFromFormat('H:i', $this->reserve->horini);
        $endTime = Carbon::createFromFormat('H:i', $this->reserve->horfin);

        $count = 0;
        $maxReserves = 24;
        $datesToReserve = [];

//       Verifica se existe conflito em qualquer dia
        while ($startDate->lessThanOrEqualTo($endDate) && $count < $maxReserves) {
            $startDateTime = Carbon::parse($startDate->toDateString() . ' ' . $startTime->format('H:i'));
            $endDateTime = Carbon::parse($startDate->toDateString() . ' ' . $endTime->format('H:i'));

//          Mescla a data atual do loop com o horário para fazer a comparação no $hasConflict
//          Verifica conflitos
            $hasConflict = Reserve::where('laboratory_id', $this->laboratory->id)
                ->where('status', '<>', 3)
                ->where(function ($query) use ($startDateTime, $endDateTime) { // function ($query) cria um bloco de condições, exemplo em sql -> SELECT * FROM reservations WHERE laboratory_id = 1 AND (horini < '10:00:00' AND horfin > '08:00:00')
                    $query->whereRaw("STR_TO_DATE(CONCAT(datini, ' ', horini), '%Y-%m-%d %H:%i:%s') < ?", [$endDateTime])//Concateno meus campos da tabela para poder fazer a comparação com a variavel do laravel
                    ->whereRaw("STR_TO_DATE(CONCAT(datfin, ' ', horfin), '%Y-%m-%d %H:%i:%s') > ?", [$startDateTime]);
                })
                ->exists();

            if ($hasConflict) {
//               se achar conflito
                $startDate = Carbon::parse($startDate);
                return redirect()->route('einstein.reserve.create',$this->laboratory->id)->with('warning', 'Conflito encontrado na data: ' . $startDate->format('d/m/Y') . '. Nenhuma reserva foi criada.');
            }

//          salva a data para criar depois
            $datesToReserve[] = $startDate->copy();

            $startDate->addDays(28);
            $count++;
        }

//      nenhum conflito encontrado, agora cria as reservas
        foreach ($datesToReserve as $date) {
            $reservation = $this->reserve->replicate(); // precisa criar uma nova variavel para nao dar problema no salvamento

            $reservation->datini = $date->toDateString(); // Adicionando cada dia do periodo selecionado
            $reservation->datfin = $date->toDateString();

            $reservation->status = $this->automatic ? 2 : 1;

            $reservation->save();
        }

        //$this->reservation->subarea->email
//        if($this->changeArea != 1){
//            Mail::to('henrique.brechot@villagres.com.br')->send(new \App\Mail\Reservation\ReserveMail($this->reservation));
//        }
        return redirect()->route('einstein.reserve.create',$this->laboratory->id)->with('success', 'Reservas mensais criadas com sucesso!');
    }

    public function openCreate()
    {
        $this->open = true;
    }

    public function getEvents($start, $end)
    {
        return Reserve::query()
            ->where('laboratory_id', $this->laboratory->id)
            ->where('status', '<', 3)
            ->whereDate('datini', '>=', $start)
            ->whereDate('datfin', '<=', $end)
            ->get()
            ->map(function ($reservation) {
                $startDateTime = Carbon::parse($reservation->datini . ' ' . $reservation->horini);
                $endDateTime = Carbon::parse($reservation->datfin . ' ' . $reservation->horfin);

                return [
                    'id' => $reservation->id,
                    'title' => $reservation->title,
                    'start' => $startDateTime->toIso8601String(),
                    'end' => $endDateTime->toIso8601String(),
                    'allDay' => false,
                    'extendedProps' => [
                        'status' => $reservation->status,
                        'user_id' => $reservation->user_id,
                    ],
                ];
            })
            ->toArray();
    }

    public function gettingDisciplineName()
    {
        $this->discipline = Discipline::select('title')
                                      ->where('status', 1)
                                      ->get();
    }

    protected function rules(): array
    {
        return [
            'reserve.title' => [
                'required',
                'string',
            ],
            'reserve.datini' => [
                'required',
                'date_format:' . config('project.date_format'),
                function ($attribute, $value, $fail) {
                    if ($this->reserve->datini == null) {
                        $fail('O campo de data inicial está vazio!');
                    }
                }
            ],
            'reserve.horini' => [
                'required',
                'date_format:' . config('project.time_format'),
                function ($attribute, $value, $fail) {
                    if ($this->reserve->horini == "") {
                        $fail('O campo de data inicial está vazio!');
                    }
//                    $horIni = Carbon::createFromFormat('H:i', $this->reserve->horini);
//                    $minutes = (int) $horIni->format('i');
//                    if (!in_array($minutes, [0, 30])) {
//                        $fail('A hora final deve terminar em 00 ou 30 minutos.');
//                    }
                }
            ],
            'reserve.datfin' => [
                'required',
                'date_format:' . config('project.date_format'),
                function ($attribute, $value, $fail) {
                    if($this->reserve->datfin == null){
                        $fail('O campo de data final está vazio!');
                    }else{
                        if (Carbon::createFromFormat('Y-m-d', $this->reserve->datfin)->lessThan(Carbon::createFromFormat('Y-m-d', $this->reserve->datini))) {
                            $fail('A Data Final deve ser maior que a Data Inicial');
                        }
                    }
                }

            ],
            'reserve.horfin' => [
                'required',
                'date_format:' . config('project.time_format'),
                function ($attribute, $value, $fail) {
                    if ($this->reserve->horfin == "") {
                        $fail('O campo de data inicial está vazio!');
                    }else{
                        $horIni = Carbon::createFromFormat('H:i', $this->reserve->horini);
                        $horFin = Carbon::createFromFormat('H:i', $value);
                        if (Carbon::createFromFormat('H:i',$this->reserve->horfin)->lessThanOrEqualTo(Carbon::createFromFormat('H:i',$this->reserve->horini)) && Carbon::createFromFormat('Y-m-d',$this->reserve->datini)->equalTo(Carbon::createFromFormat('Y-m-d',$this->reserve->datfin))) {
                            $fail('A Hora Inicial não pode ser maior ou igual a Hora Final');
                        }
                        if($this->repeat != 0 && Carbon::createFromFormat('H:i',$this->reserve->horfin)->lessThanOrEqualTo(Carbon::createFromFormat('H:i',$this->reserve->horini))) {
                            $fail('Quando selecionado o "Tipo de Repetição", a Hora Inicial não pode ser maior ou igual a Hora Final');
                        }
//                        $minutes = (int) $horFin->format('i');
//                        if (!in_array($minutes, [0, 30])) {
//                            $fail('A hora final deve terminar em 00 ou 30 minutos.');
//                        }
                    }
                }
            ],
            'reserve.status' => [
                'boolean'
            ],
            'reserve.user_id'=> [
                'required',
            ],
            'reserve.laboratory_id'=> [
                'required',
            ],
            'reserve.discipline_id'=> [
                'required',
            ],
            'repeat' => [
                'nullable'
            ],
            'automatic' => [
                'nullable',
                'boolean',
            ]
        ];
    }
}
