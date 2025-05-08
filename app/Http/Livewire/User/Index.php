<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;

class Index extends Component
{

    public function mount()
    {
        $this->users = User::get();
    }
    public function render()
    {
        return view('livewire.user.index');
    }

    public function delete(User $user)
    {
        abort_unless(Gate::allows('role', ['admin', 'diretor']), 403);

        $user->status = 0;

        $user->save();
    }
}
