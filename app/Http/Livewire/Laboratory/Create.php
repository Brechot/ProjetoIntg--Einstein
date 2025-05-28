<?php

namespace App\Http\Livewire\Laboratory;

use App\Models\Laboratory;
use App\Models\Software;
use Livewire\Component;

class Create extends Component
{
    public Laboratory $laboratory;

    public $softwares;
    public $selectedSoftwares = [];

    public function mount(Laboratory $laboratory)
    {
        $this->laboratory = $laboratory;
        $this->laboratory->status = 1;

        $this->softwares = Software::all()->where('status', 1);
    }

    public function render()
    {
        return view('livewire.laboratory.create');
    }

    public function submit()
    {
        $this->validate();

        $this->laboratory->save();

        $this->laboratory->softwares()->sync($this->selectedSoftwares); //salvando softwares relacionados

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
