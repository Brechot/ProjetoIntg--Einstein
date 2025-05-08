<?php

namespace App\Http\Livewire\Role;

use App\Models\Role;
use Livewire\Component;

class Create extends Component
{
    public Role $role;

    public function mount(Role $role)
    {
        $this->role = $role;
        $this->role->status = 1;
    }

    public function render()
    {
        return view('livewire.role.create');
    }

    public function submit()
    {
        $this->validate();

        $this->role->save();

        return redirect()->route('einstein.roles.index')->with('success', 'Regra ID: '.$this->role->id.' Criada com Sucesso!');
    }

    protected function rules(): array
    {
        return [
            'role.title' => [
                'string',
                'required',
            ],
            'role.status' => [
                'boolean',
            ]
        ];
    }
}
