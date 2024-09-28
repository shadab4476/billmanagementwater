<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class formError extends Component
{
    /**
     * Create a new component instance.
     */
    public $input_error_message;
    public function __construct($input_error_message = null)
    {
        $this->input_error_message = $input_error_message;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form-error');
    }
}
