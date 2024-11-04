<?php

namespace App\Livewire;

use App\Models\Shop;
use Livewire\Component;

class Home extends Component
{
    public $count = 1, $test=[];

    public function testing()
    {
       
    }
    public function render()
    {

        return view('livewire.home');
    }
}
