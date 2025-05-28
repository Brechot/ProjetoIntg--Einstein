<?php

namespace App\Http\Livewire\Reserve;

use App\Models\Discipline;
use App\Models\Reserve;
use Carbon\Carbon;
use Livewire\Component;

class Edit extends Component
{
    public Reserve $reserve;

    public $discipline = [];

    public function mount(Reserve $reserve)
    {
        $this->reserve = $reserve;

        if ($this->reserve) {
            $this->reserve->horini = Carbon::parse($this->reserve->horini)->format('H:i');
            $this->reserve->horfin = Carbon::parse($this->reserve->horfin)->format('H:i');
        }

        $this->gettingDisciplineName();
    }

    public function render()
    {
        $this->gettingDisciplineName();

        return view('livewire.reserve.edit');
    }

    public function submit()
    {
        $this->validate();

        $this->editSingleReservation();
    }

    public function editSingleReservation()
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
        $hasConflict = Reserve::where('laboratory_id', $this->reserve->laboratory_id)
            ->where('id', '<>', $this->reserve->id)
            ->where('status', '<>', 3)
            ->where(function ($query) use ($startDateTime, $endDateTime) { // function ($query) cria um bloco de condições, exemplo em sql -> SELECT * FROM reservations WHERE laboratory_id = 1 AND (horini < '10:00:00' AND horfin > '08:00:00')
                $query->whereRaw("STR_TO_DATE(CONCAT(datini, ' ', horini), '%Y-%m-%d %H:%i:%s') < ?", [$endDateTime])//Concateno meus campos da tabela para poder fazer a comparação com a variavel do laravel
                ->whereRaw("STR_TO_DATE(CONCAT(datfin, ' ', horfin), '%Y-%m-%d %H:%i:%s') > ?", [$startDateTime]);
            })
            ->exists();

        if ($hasConflict){
            $hasAnyConflict = true;
        }else{
            $this->reserve->save();
        }

        if ($hasAnyConflict) {
            return redirect()->route('einstein.reserve.edit',$this->reserve->id)->with('warning', 'Conflito na data, já existe uma reserva nesta data no item selecionado!');
        }

        return redirect()->route('einstein.reserve.create',$this->reserve->laboratory_id)->with('success', 'Reserva '.$this->reserve->id.' editada com Sucesso!');
    }

    public function gettingDisciplineName()
    {
        $this->discipline = Discipline::select('title')
            ->where('status', 1)
            ->get();
    }

    public function cancelReservation()
    {
        $this->reserve->status = 3;
        $this->reserve->declined_desc = 'Cancelado por '. auth()->user()->name;
        $this->reserve->save();
        return redirect()->route('einstein.reserve.create',$this->reserve->laboratory_id)->with('success', 'Reserva Cancelada com Sucesso!');
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
        ];
    }
}
