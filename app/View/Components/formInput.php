<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class formInput extends Component
{

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public  $input_label_class, $label_for, $input_label;

    public function __construct($input_error_message = null, $label_for = null, $input_error = null, $input_label_class = null, $input_label = null)
    {

        $this->input_label_class = $input_label_class;
        $this->input_label = $input_label;
        $this->label_for = $label_for;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form-input');
    }
}
