<?php

namespace App\Http\Livewire\Laboratory;

use App\Models\Laboratory;
use App\Models\Software;
use Livewire\Component;

class Edit extends Component
{
    public Laboratory $laboratory;

    public $softwares;
    public $selectedSoftwares = [];

    public function mount(Laboratory $laboratory)
    {
        $this->laboratory = $laboratory;

        $this->softwares = Software::all()->where('status', 1);
        $this->selectedSoftwares = $this->laboratory->softwares->pluck('id')->toArray();
    }

    public function render()
    {
        return view('livewire.laboratory.edit');
    }

    public function submit()
    {
        $this->validate();

        $this->laboratory->save();

        $this->laboratory->softwares()->sync($this->selectedSoftwares); //salvando softwares relacionados

        return redirect()->route('einstein.laboratory.index')->with('success', 'Editado com Sucesso!');
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
