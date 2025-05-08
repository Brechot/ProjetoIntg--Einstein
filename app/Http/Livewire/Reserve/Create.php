<?php

namespace App\Http\Livewire\Reserve;

use App\Models\Reserve;
use Livewire\Component;

class Create extends Component
{
    public Reserve $reserve;

    public function mount(Reserve $reserve)
    {
        $this->reserve = $reserve;
        $this->reserve->status = 1;
    }

    public function render()
    {
        return view('livewire.reserve.create');
    }

    public function submit()
    {
        $this->validate();

        $this->reserve->save();

        return redirect()->route('admin.reserve.index')->with('success', 'Cadastrado com Sucesso!');
    }

    protected function rules(): array
    {
        return [
//            'helpdeskSla.title' => [
//                'string',
//                'required',
//            ],
//            'helpdeskSla.sla_opn_time' => [
//                'required',
//                'integer',
//                'max:365',
//                'min:1'
//            ],
//            'helpdeskSla.sla_acp_time' => [
//                'required',
//                'integer',
//                'max:365',
//                'min:1'
//            ],
//            'helpdeskSla.status' => [
//                'boolean'
//            ]
        ];
    }
}
