<?php

namespace App\Livewire\Bill;

use App\Models\Bill;
use App\Models\Shop;
use Livewire\Component;
use Livewire\WithPagination;

class BillIndex extends Component
{
    use WithPagination;

    public $shops;
    public $modelmain; //models
    public  $date, $amount, $note, $shop_id, $type = "1"; //input variable

    public function mainModelOpen()
    {
        $this->modelmain = true;
    }
    public function mainModelClose()
    {
        $this->modelmain = false;
    }
    public function updated($data)
    {
        $this->validateOnly($data, [
            'date' => 'required|date_format:d-m-Y', // Ensure correct format
            'amount' => 'required|numeric|min:1',
            'note' =>  'required|string',
            'type' => 'required|boolean',
            'shop_id' => 'nullable|exists:shops,id', // Chek if the user_id exiscts in the users table
        ]);
    }
    public function messages()
    {
        return [
            'type.boolean' => 'Please enter only Income or Expense.', // Custom error message for the boolean rule
        ];
    }
    public function store()
    {
        if (auth()->user()->hasRole('admin')) {
            $this->date == null ?  $this->date = date("Y-m-d") :  $this->date = $this->date;
            $data = $this->validate([
                'date' => 'required|date_format:Y-m-d', // Ensure correct format
                'amount' => 'required|numeric|min:1',
                'note' =>  'required|string',
                'type' => 'required|boolean',
                'shop_id' => 'nullable|exists:shops,id', // Chek if the user_id exiscts in the users table
            ]);
            try {
                $this->shop_id == null ?   $this->shop_id = "0" :  $this->shop_id =  $this->shop_id;
                Bill::create($data);
                $this->render();
                session()->flash('success', 'Bill Created Successfully...');
            } catch (\Exception $e) {
                session()->flash('error', 'Somthing went wrong.. ' . $e->getMessage());
            }
        }
    }
    public function render()
    {
        if (auth()->user()->hasRole('admin')) {
            try {
                $this->shops = Shop::get();
                $bills = Bill::paginate(5);
                return view('livewire.bill.bill-index', compact('bills'));
            } catch (\Exception $e) {
                $this->mainModelClose();
                session()->flash('error', 'Somthing went wrong.. ' . $e->getMessage());
            }
        }
    }
    public function blankInput()
    {
        $this->date = date("Y-m-d");
        $this->amount = "";
        $this->note = "";
        $this->shop_id = "0";
        $this->type = "1";
    }
}
