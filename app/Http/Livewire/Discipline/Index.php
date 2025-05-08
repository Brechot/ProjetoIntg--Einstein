<?php

namespace App\Http\Livewire\Discipline;

use App\Models\Discipline;
use Livewire\Component;

class Index extends Component
{

    public  $disciplines;

    public function mount()
    {
        $this->disciplines = Discipline::get();
    }

    public function render()
    {
        return view('livewire.discipline.index');
    }

//    public function delete(Discipline $discipline)
//    {
//        abort_unless(Gate::allows('role', ['admin', 'coordenador']), 403);
//
//        $discipline->status = 0;
//
//        $discipline->save();
//    }

}
