<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class formButton extends Component
{
    /**
     * Create a new component instance.
     */
    public $button_type, $button_text, $target, $class;
    public function __construct($button_type = null, $class = null, $button_text = null, $target = null)
    {
        //
        $this->button_type = $button_type;
        $this->button_text = $button_text;
        $this->target = $target;
        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form-button');
    }
}
