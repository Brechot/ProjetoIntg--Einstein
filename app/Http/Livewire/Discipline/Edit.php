<?php

namespace App\Http\Livewire\Discipline;

use App\Models\Discipline;
use Livewire\Component;

class Edit extends Component
{
    public Discipline $discipline;

    public function mount(Discipline $discipline)
    {
        $this->discipline = $discipline;
    }

    public function render()
    {
        return view('livewire.discipline.edit');
    }

    public function submit()
    {
        $this->validate();

        $this->discipline->save();

        return redirect()->route('einstein.discipline.index')->with('success', 'Software ID: '.$this->discipline->id.' Editado com Sucesso!');
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
