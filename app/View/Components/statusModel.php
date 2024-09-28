<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class statusModel extends Component
{
    /**
     * Create a new component instance.
     */
    public $closeStatusModel, $updateStatus, $checkId;
    public function __construct($closeStatusModel = null, $updateStatus = null, $checkId = null)
    {
        $this->closeStatusModel = $closeStatusModel;
        $this->updateStatus = $updateStatus;
        $this->checkId = $checkId;
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.status-model');
    }
}
