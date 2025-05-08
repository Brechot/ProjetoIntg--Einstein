<?php

namespace App\Http\Livewire\User;

use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Create extends Component
{
    public User $user;

    public $roles = [];

    public string $password = '';

    public function mount(User $user)
    {
        $this->user = $user;
        $this->user->email_verified_at = Carbon::now()->format('Y-m-d H:i:s');
        $this->user->status = 1;
        $this->user->reset_psw = false;

        $this->gettingRoleName();
    }

    public function render()
    {
        $this->gettingRoleName();
        return view('livewire.user.create');
    }

    public function submit()
    {
        $this->validate();

        $this->user->password = $this->password;
        $this->user->password = Hash::make($this->user->password); // criptografando
        $this->user->save();

        return redirect()->route('einstein.users.index')->with('success', 'Software ID: '.$this->software->id.' Criado com Sucesso!');
    }

    protected function rules(): array
    {
        return [
            'user.name' => [
                'string',
                'required',
            ],
            'user.email' => [
                'required',
                'email',
                'unique:users,email'
            ],
            'user.email_verified_at' => [
                'required',
            ],
            'password' => [
                'required',
                'string',
            ],
            'user.role_id' => [
                'required'
            ],
            'user.status' => [
                'boolean'
            ],
            'user.reset_psw' => [
                'boolean'
            ]
        ];
    }

    public function gettingRoleName()
    {
        $this->roles = Role::select('title')
                           ->where('status', 1)
                           ->get();
    }
}
