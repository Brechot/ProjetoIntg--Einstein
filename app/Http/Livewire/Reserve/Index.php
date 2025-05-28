<?php

namespace App\Http\Livewire\Reserve;

use App\Models\Laboratory;
use App\Models\Reserve;
use Livewire\Component;

class Index extends Component
{
    public $laboratorys;

    public function mount()
    {
        $this->laboratorys = Laboratory::where('status', 1)
                                       ->with('softwares')
                                       ->get();
    }
    public function render()
    {
        return view('livewire.reserve.index');
    }

//    public function delete(Reserve $reserve)
//    {
//        abort_unless(Gate::allows('role', ['admin', 'coordenador']), 403);
//
//        $reserve->status = 0;
//
//        $reserve->save();
//    }
}
