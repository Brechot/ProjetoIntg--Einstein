<?php

namespace App\Http\Livewire\Discipline;

use App\Models\Discipline;
use App\Models\Software;
use Livewire\Component;

class Edit extends Component
{
    public Discipline $discipline;

    public $softwares;
    public $selectedSoftwares = [];

    public function mount(Discipline $discipline)
    {
        $this->discipline = $discipline;
        $this->softwares = Software::all()->where('status', 1);
        $this->selectedSoftwares = $this->discipline->softwares->pluck('id')->toArray();
    }

    public function render()
    {
        return view('livewire.discipline.edit');
    }

    public function submit()
    {
        $this->validate();

        $this->discipline->save();

        $this->discipline->softwares()->sync($this->selectedSoftwares); //salvando softwares relacionados

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
            ],
            'selectedSoftwares' => [
                'array'
            ],
            'selectedSoftwares.*' => [
                'integer',
                'exists:software,id'
            ],
        ];
    }

}
