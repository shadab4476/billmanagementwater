<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class filterbar extends Component
{
    public $perPage, $validPerPageOptions;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->validPerPageOptions = [5, 10, 50, 100]; //this variable value in maintenance-index.blade.php file perpage... 
        $this->perPage = in_array($this->perPage, $this->validPerPageOptions) ? $this->perPage : 5;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.filterbar');
    }
}
