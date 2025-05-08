<?php

namespace App\Http\Livewire\Software;

use App\Models\Software;
use Livewire\Component;

class Edit extends Component
{
    public Software $software;

    public function mount(Software $software)
    {
        $this->software = $software;
    }

    public function render()
    {
        return view('livewire.software.edit');
    }

    public function submit()
    {
        $this->validate();

        $this->software->save();

        return redirect()->route('einstein.software.index')->with('success', 'Software ID: '.$this->software->id.' Editado com Sucesso!');
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
