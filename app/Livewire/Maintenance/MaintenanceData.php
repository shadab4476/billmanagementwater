<?php


namespace App\Livewire\Maintenance;

use App\Models\Maintenance;
use App\Models\Shop;
use Livewire\Component;
use Livewire\WithPagination;

class MaintenanceData extends Component
{
    use WithPagination;

    public $users, $maintenance_id;
    public $modelmain; //models
    public $showDeleteModal = false;
    public  $date, $amount, $note, $user_id, $total_amount, $type = "1"; //input variable

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
            'date' => 'required|date_format:Y-m-d', // Ensure correct format
            'amount' => 'required|numeric|min:1',
            'note' =>  'required|string',
            'type' => 'required|boolean',
            'user_id' => 'nullable|exists:users,id', // Chek if the user_id exiscts in the users table
        ]);
    }
    public function messages()
    {
        return   [
            'type.boolean' => 'Please enter only Income or Expense.', // Custom error message for the boolean rule
        ];
    }
    public function store()
    {
        if (auth()->user()->hasRole('superAdmin')) {
            $this->date == null ?  $this->date = date("Y-m-d") :  $this->date = $this->date;
            $maintenanceCreate =  date("Y-m-d");
            $this->user_id = auth()->user()->id;
            $data = $this->validate([
                'date' => 'required|date_format:Y-m-d', // Ensure correct format
                'amount' => 'required|numeric|min:1',
                'total_amount' => 'nullable',
                'note' =>  'required|string',
                'type' => 'required|boolean',
                'user_id' => 'required|exists:users,id', // Chek if the user_id exiscts in the users table
            ]);
            try {
                $data["created_at"] = $maintenanceCreate;
                $data["total_amount"] = 0;
                Maintenance::create($data);
                $this->render();
                $this->blankInput();
                session()->flash('success', 'Maintenance Bill  Created Successfully...');
            } catch (\Exception $e) {
                session()->flash('error', 'Somthing went wrong.. ' . $e->getMessage());
            }
        }
    }
    public function openDeleteModel($id)
    {
        if (auth()->user()->hasRole(['superAdmin'])) {

            $this->maintenance_id = $id;
            $this->showDeleteModal = true;
        }
    }
    public function closeDeleteModal()
    {
        if (auth()->user()->hasRole(['superAdmin'])) {
            $this->maintenance_id = null;
            $this->showDeleteModal = false;
        }
    }
    public function deleteMaintenance()
    {
        if (auth()->user()->hasRole(['superAdmin'])) {
            try {
                $maintenanceDelete = Maintenance::findOrFail($this->maintenance_id);
                $maintenanceDelete->delete();
                $this->render();
                session()->flash('success', 'Maintenance Bill  Deleted successfully...');
            } catch (\Exception $e) {
                $this->mainModelClose();
                session()->flash('error', 'Somthing went wrong.. ' . $e->getMessage());
            }
            $this->showDeleteModal = false;
        }
    }

    public function render()
    {

        if (auth()->user()->hasRole('superAdmin')) {
            try {
                $today = date('Y-m-d');
                $maintenances = Maintenance::where("created_at", $today)->paginate(5);
                return view('livewire.maintenance.maintenance-data', compact('maintenances'));
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
        $this->user_id = $this->user_id;
        $this->type = $this->type;
    }
}
