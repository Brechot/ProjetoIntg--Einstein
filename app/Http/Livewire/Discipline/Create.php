<?php

namespace App\Http\Livewire\Discipline;

use App\Models\Discipline;
use Livewire\Component;

class Create extends Component
{
    public Discipline $discipline;

    public function mount(Discipline $discipline)
    {
        $this->discipline = $discipline;
        $this->discipline->status = 1;
    }

    public function render()
    {
        return view('livewire.discipline.create');
    }

    public function submit()
    {
        $this->validate();

        $this->discipline->save();

        return redirect()->route('einstein.discipline.index')->with('success', 'Disciplina ID: ' . $this->discipline->id . ' Criado com Sucesso!');
    }

    protected function rules(): array
    {
        return [
            'discipline.title' => [
                'string',
                'required',
            ],
            'discipline.students' => [
                'required',
                'integer',
            ],
            'discipline.status' => [
                'boolean'
            ]
        ];
    }
}
