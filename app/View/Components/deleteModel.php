<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class deleteModel extends Component
{
    /**
     * Create a new component instance.
     */
    public $delete, $message, $closeModel;
    public function __construct($delete = null, $message = null, $closeModel = null)
    {
        $this->delete = $delete;
        $this->message = $message;
        $this->closeModel = $closeModel;
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.delete-model');
    }
}
