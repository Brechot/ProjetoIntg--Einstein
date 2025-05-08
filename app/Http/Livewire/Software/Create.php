<?php

namespace App\Http\Livewire\Software;

use App\Models\Software;
use Livewire\Component;

class Create extends Component
{
    public Software $software;

    public function mount(Software $software)
    {
        $this->software = $software;
        $this->software->status = 1;
    }

    public function render()
    {
        return view('livewire.software.create');
    }

    public function submit()
    {
        $this->validate();

        $this->software->save();

        return redirect()->route('einstein.software.index')->with('success', 'Software ID: '.$this->software->id.' Criado com Sucesso!');
    }

    protected function rules(): array
    {
        return [
            'software.title' => [
                'string',
                'required',
            ],
            'software.status' => [
                'boolean',
            ]
        ];
    }
}
