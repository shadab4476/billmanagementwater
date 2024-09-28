<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class formLabel extends Component
{
    /**
     * Create a new component instance.
     */
    public $label_for, $input_label_class, $input_label, $star;
    public function __construct($label_for = null, $star = null, $input_label_class = null, $input_label = null)
    {
        $this->label_for = $label_for;
        $this->star = $star;
        $this->input_label = $input_label;
        $this->input_label_class = $input_label_class;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form-label');
    }
}
