<?php

namespace App\Http\Livewire\Reserve;

use App\Models\Reserve;
use Livewire\Component;

class Index extends Component
{

    public function mount()
    {

    }
    public function render()
    {
        return view('livewire.reserve.index');
    }

    public function delete(Reserve $reserve)
    {
        abort_unless(Gate::allows('role', ['admin', 'coordenador']), 403);

        $reserve->status = 0;

        $reserve->save();
    }
}
