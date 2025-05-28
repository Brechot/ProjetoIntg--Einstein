<?php

namespace App\Http\Livewire\Laboratory;

use App\Models\Laboratory;
use Livewire\Component;

class Index extends Component
{
    public  $laboratorys;

    public function mount()
    {
        $this->laboratorys = Laboratory::with('softwares')->get();
    }
    public function render()
    {
        return view('livewire.laboratory.index');
    }

//    public function delete(Laboratory $laboratory)
//    {
//        abort_unless(Gate::allows('role', ['admin', 'diretor']), 403);
//
//        $laboratory->status = 0;
//
//        $laboratory->save();
//    }
}
