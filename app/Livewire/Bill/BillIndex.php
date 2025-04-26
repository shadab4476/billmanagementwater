<?php

namespace App\Livewire\Bill;

use App\Models\Bill;
use App\Models\Shop;
use Livewire\Component;

class BillIndex extends Component
{
    public $quantity, $rate, $date, $note, $shop_id, $user_id;


    public function create()
    {
        $this->date == null ?  $this->date = Date("Y-m-d") :  $this->date = $this->date;
        $this->user_id = auth()->user()->id;

        $data =   $this->validate([
            // all variable data vaidate
            'quantity' => 'required|numeric|min:1',
            'rate' => 'required|numeric|min:1',
            'date' => 'required|date|date_format:Y-m-d',
            'note' => 'nullable|string',
            'shop_id' => 'required|exists:shops,id', // Chek if the shop_id exists in the shops table
            'user_id' => 'nullable|exists:users,id', // Chek if the user_id exists in the users table
        ]);

        try {
            Bill::create($data);
            $this->render();
            $this->blankInput();
            session()->flash('success', 'Bill  Created Successfully...');
        } catch (\Exception $e) {
            session()->flash('error', 'Somthing went wrong.. ' . $e->getMessage());
        }
    }

    public function updated($data)
    {
        $this->validateOnly($data, [
            // all variable data vaidate
            'quantity' => 'required|numeric|min:1',
            'rate' => 'required|numeric|min:1',
            'date' => 'required|date|date_format:Y-m-d',
            'note' => 'nullable|string',
            'shop_id' => 'required|exists:shops,id', // Chek if the shop_id exists in the shops table
            'user_id' => 'nullable|exists:users,id', // Chek if the user_id exists in the users table
        ]);
    }

    public function render()
    {
        $shops = Shop::get(["id", "shop_name","status"]);
        $bills = Bill::orderBy("id","desc")->get();
        if (auth()->user()->hasRole(['superAdmin'])) {
            return view('livewire.bill.bill-index', compact('bills', "shops"));
        }
    }

    public function blankInput()
    {
        $this->quantity = '';
        $this->rate = '';
        $this->date = Date("Y-m-d");
        $this->shop_id = $this->shop_id;
        $this->user_id = '';
        $this->note = '';
    }
}
