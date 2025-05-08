<?php

namespace App\Http\Livewire\Software;

use App\Models\Software;
use Livewire\Component;

class Index extends Component
{

    public  $softwares;

    public function mount()
    {
        $this->softwares = Software::get();
    }

    public function render()
    {
        return view('livewire.software.index');
    }

//    public function delete(Software $software)
//    {
//        abort_unless(Gate::allows('role', ['admin', 'ti']), 403);
//
//        $software->status = 0;
//
//        $software->save();
//    }
}
