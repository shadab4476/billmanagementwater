<?php

namespace App\Livewire\Bill;

use App\Models\Bill;
use Livewire\Component;

class BillIndex extends Component
{
    public $bills, $bill_id; //bilss and bill_id
    public $modelmain; //models
    public function mainModelOpen()
    {
        $this->modelmain = true;
    }
    public function mainModelClose()
    {
        $this->modelmain = false;
    }

    public function store()
    {
        // code here

        $this->modelmain = false;
    }
    public function mount()
    {
        // $this->bills = Bill::get();
    }
    public function render()
    {
        return view('livewire.bill.bill-index');
    }
}
