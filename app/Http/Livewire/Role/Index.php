<?php

namespace App\Http\Livewire\Role;

use App\Models\Role;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Index extends Component
{
    public $roles;

    public function mount()
    {
        $this->roles = Role::get();
    }
    public function render()
    {
        return view('livewire.role.index');
    }

    public function delete(Role $roles)
    {
        abort_unless(Gate::allows('role', ['admin', 'diretor']), 403);

        $roles->status = 0;

        $roles->save();
    }
}
