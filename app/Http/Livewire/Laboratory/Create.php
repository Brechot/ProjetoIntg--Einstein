<?php

namespace App\Http\Livewire\Laboratory;

use App\Models\Laboratory;
use Livewire\Component;

class Create extends Component
{
    public Laboratory $laboratory;

    public function mount(Laboratory $laboratory)
    {
        $this->laboratory = $laboratory;
        $this->laboratory->status = 1;
    }

    public function render()
    {
        return view('livewire.laboratory.create');
    }

    public function submit()
    {
        $this->validate();

        $this->laboratory->save();

        return redirect()->route('einstein.laboratory.index')->with('success', 'Cadastrado com Sucesso!');
    }

    protected function rules(): array
    {
        return [
            'laboratory.title' => [
                'string',
                'required',
            ],
            'laboratory.num_computers' => [
                'required',
                'integer',
            ],
            'laboratory.status' => [
                'boolean'
            ]
        ];
    }
}
