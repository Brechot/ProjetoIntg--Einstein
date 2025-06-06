<?php

namespace App\Http\Livewire\Reserve;

use App\Models\Reserve;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class Approve extends Component
{
    public $reserves;

    public $declDescri; //caso tiver problema na descrição da função decl()

    public Reserve $approve;

    public function mount()
    {
        $this->reserves = Reserve::get()->where('status', 1);
    }
    public function render()
    {
        return view('livewire.reserve.approve');
    }

    public function submit(Reserve $approve)
    {
        $this->approve = $approve->load('user')->load('laboratory')->load('discipline'); //load ajuda carregar o relacionamento para não dar um problema de não encontrar variavle estrangeira
        $this->approve->declined_desc = $this->declDescri;
        $this->validate();
        $this->approve->status = 3;
        $this->approve->save();

        Mail::to('henrique.brechot@villagres.com.br')->send(new \App\Mail\ApproveMailController($this->approve));

        return redirect()->route('einstein.reserve.approve')->with('success', 'Reserva '.$this->approve->id.' reprovada com sucesso!');

    }

    public function acpt(Reserve $approve)
    {
        $this->approve = $approve->load('user')->load('laboratory')->load('discipline'); //load ajuda carregar o relacionamento para não dar um problema de não encontrar variavle estrangeira
        $this->approve->status = 2;
        $this->approve->declined_desc = 'aceito';
        $this->approve->save();

        Mail::to('henrique.brechot@villagres.com.br')->send(new \App\Mail\ApproveMailController($this->approve));

        return redirect()->route('einstein.reserve.approve')->with('success', 'Reserva '.$this->approve->id.' aprovada com sucesso!');
    }


    protected function rules(): array
    {
        return [
            'approve.declined_desc' => [
                'required',
            ]
        ];
    }
}






