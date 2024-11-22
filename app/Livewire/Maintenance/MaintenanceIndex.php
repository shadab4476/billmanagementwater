<?php

namespace App\Livewire\Maintenance;

use App\Models\Maintenance;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class MaintenanceIndex extends Component
{
    use WithPagination;
    public  $date, $amount, $note, $user_id, $total_amount, $type = "1"; //input variable
    public $perPage,  $getAllMaintenance = false, $searchMaintenance, $orderBy, $startDate, $endDate; // filtering
    public $totalAmount, $income, $expense, $monthName; //amount income expense show 
    public $maintenance_id, $maintenance;
    public $showDeleteModal = false, $editModelMaintenance = false; //models
    public  $maintenance_select = [], $selectAll = false; //select all checkbox deleted

    // get variable on url
    protected $queryString = [
        'perPage' => ['except' => ''],
        'startDate' => ['except' => ''],
        'endDate' => ['except' => ''],
        'searchMaintenance' => ['except' => ''],
        'getAllMaintenance' => ['except' => ''],
        'orderBy' => ['except' => ''],
        'editModelMaintenance' => ['except' => ''],
    ];

    public function updated($data)
    {
        $this->validateOnly($data, [
            'date' => 'required|date_format:Y-m-d', // Ensure correct format
            'amount' => 'required|numeric|min:1',
            'note' =>  'required|string',
            'type' => 'required|boolean',
        ]);
    }
    public function openDeleteModel($id = null)
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
    public function openEditModelMaintenance($id = null)
    {
        if (auth()->user()->hasRole(['superAdmin'])) {
            $this->maintenance_id = $id;
            $this->maintenance = Maintenance::findOrFail($this->maintenance_id);
            // dd($this->maintenance->type);
            $this->dataInput();
            $this->editModelMaintenance = true;
        }
    }
    public function updateMaintenance()
    {
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
            $this->maintenance->update($data);
            $this->closeEditModelMaintenance();
            $this->render();
            session()->flash('success', 'Maintenance Bill  Updated Successfully...');
        } catch (\Exception $e) {
            session()->flash('error', 'Somthing went wrong.. ' . $e->getMessage());
        }
    }
    public function closeEditModelMaintenance()
    {
        if (auth()->user()->hasRole(['superAdmin'])) {
            $this->maintenance_id = null;
            $this->editModelMaintenance = false;
        }
    }

    public function updatedSelectAll($value)
    {
        try {
            if ($value) {
                $queryMaintenanceSelect = Maintenance::query();
                $startOfCurrentMonth = Carbon::now()->startOfMonth();
                $endOfCurrentMonth = Carbon::now()->endOfMonth();
                $queryMaintenanceSelect->orderBy("id", "desc"); //all time id descending ordered
                // $this->maintenance_select = Maintenance::orderBy("id", "desc")->limit(5)->pluck('id')->toArray();
                // get all maintenance on click button
                if (!$this->getAllMaintenance) {
                    $queryMaintenanceSelect->whereBetween('date', [$startOfCurrentMonth, $endOfCurrentMonth]);
                }

                // // search
                if ($this->searchMaintenance) {
                    $searchMaintenanceColumns = ['id', 'date', 'amount', 'note', 'type', 'user_id',]; // Add any additional columns here
                    $queryMaintenanceSelect->where(function ($query) use ($searchMaintenanceColumns) {
                        foreach ($searchMaintenanceColumns as $column) {
                            $query->orWhere($column, 'like', '%' . trim($this->searchMaintenance) . '%');
                        }
                    });
                }


                // // min max date range filter
                if ($this->startDate && $this->endDate) {
                    $queryMaintenanceSelect->whereBetween('date', [$this->startDate, $this->endDate]); //maintenance data sent 
                } elseif ($this->startDate) {
                    // Only startDate has a value, filter from this date onward
                    $queryMaintenanceSelect->where('date', '>=', $this->startDate); //maintenance data sent 
                } elseif ($this->endDate) {
                    // Only endDate has a value, filter up to this date
                    $queryMaintenanceSelect->where('date', '<=', $this->endDate);
                }
                $validPerPageOptions = [5, 10, 50, 100]; //this variable value in maintenance-index.blade.php file perpage... 
                $perPage = in_array($this->perPage, $validPerPageOptions) ? $this->perPage : 5;
                $this->maintenance_select =  $queryMaintenanceSelect->limit($perPage)->pluck('id')->toArray();
            } else {
                $this->maintenance_select = [];
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Somthing went wrong.. ' . $e->getMessage());
        }
    }
    public function deleteMaintenance()
    {
        if (auth()->user()->hasRole(['superAdmin'])) {
            try {
                if ($this->maintenance_select == [] || $this->maintenance_id) {
                    $maintenanceDelete = Maintenance::findOrFail($this->maintenance_id);
                } else {
                    $maintenanceIds = is_array($this->maintenance_select) ? $this->maintenance_select : [];
                    if ($maintenanceIds == []) {
                        $this->maintenance_select = false;
                        $this->showDeleteModal = false;
                        $this->selectAll = false;
                        return   session()->flash('success', 'Somthing went wrong Please click all check button... ');
                    }
                    $maintenanceDelete = Maintenance::whereIn("id", $maintenanceIds);
                    $this->maintenance_select = false;
                    $this->selectAll = false;
                }
                $maintenanceDelete->delete();
                $this->render();
                session()->flash('success', 'Maintenance Bill  Deleted successfully...');
            } catch (\Exception $e) {
                session()->flash('error', 'Somthing went wrong.. ' . $e->getMessage());
            }
            $this->showDeleteModal = false;
        }
    }

    public function getAllMaintenances()
    {
        if (auth()->user()->hasRole('superAdmin')) {
            try {

                if ($this->getAllMaintenance == true) {
                    $this->getAllMaintenance = false;
                } else {
                    $this->getAllMaintenance = true;
                }
            } catch (\Exception $e) {
                session()->flash('error', 'Somthing went wrong.. ' . $e->getMessage());
            }
        }
    }
    public function render()
    {
        if (auth()->user()->hasRole('superAdmin')) {
            try {
                $queryMaintenance = Maintenance::query(); //data sent query
                $searchQueryMaintenance = Maintenance::query(); //search query

                // Current month range
                $startOfCurrentMonth = Carbon::now()->startOfMonth();
                $endOfCurrentMonth = Carbon::now()->endOfMonth();
                $queryMaintenance->orderBy("id", "desc"); //all time id descending ordered
                // get all maintenance on click button
                if (!$this->getAllMaintenance) {
                    $queryMaintenance->whereBetween('date', [$startOfCurrentMonth, $endOfCurrentMonth]);
                    $searchQueryMaintenance->whereBetween('date', [$startOfCurrentMonth, $endOfCurrentMonth]);
                    $searchQueryMaintenance->whereBetween('date', [$startOfCurrentMonth, $endOfCurrentMonth]);
                }


                // search
                if ($this->searchMaintenance) {
                    $searchMaintenanceColumns = ['id', 'date', 'amount', 'note', 'type', 'user_id',]; // Add any additional columns here
                    $queryMaintenance->where(function ($query) use ($searchMaintenanceColumns) {
                        foreach ($searchMaintenanceColumns as $column) {
                            $query->orWhere($column, 'like', '%' . trim($this->searchMaintenance) . '%');
                        }
                    });
                    $searchQueryMaintenance->where(function ($query) use ($searchMaintenanceColumns) {
                        foreach ($searchMaintenanceColumns as $column) {
                            $query->orWhere($column, 'like', '%' . trim($this->searchMaintenance) . '%');
                        }
                    });
                }

                // min max date range filter
                if ($this->startDate && $this->endDate) {
                    $queryMaintenance->whereBetween('date', [$this->startDate, $this->endDate]); //maintenance data sent 
                    $searchQueryMaintenance->whereBetween('date', [$this->startDate, $this->endDate]); //maintenance search data sent
                } elseif ($this->startDate) {
                    // Only startDate has a value, filter from this date onward
                    $queryMaintenance->where('date', '>=', $this->startDate); //maintenance data sent 
                    $searchQueryMaintenance->where('date', '>=', $this->startDate); //maintenance search data sent
                } elseif ($this->endDate) {
                    // Only endDate has a value, filter up to this date
                    $queryMaintenance->where('date', '<=', $this->endDate);
                    $searchQueryMaintenance->where('date', '<=', $this->endDate); //maintenance search data sent
                }
                $validPerPageOptions = [5, 10, 50, 100]; //this variable value in maintenance-index.blade.php file perpage... 
                $perPage = in_array($this->perPage, $validPerPageOptions) ? $this->perPage : 5;
                $maintenances = $queryMaintenance->paginate($perPage); //sent data to view file ...
                $this->income = (clone $searchQueryMaintenance)->whereType(1)->sum('amount'); // amount data sent to view files... 
                $this->expense = (clone $searchQueryMaintenance)->whereType(0)->sum('amount'); // amount data sent to view files... 
                $this->totalAmount = $this->income - $this->expense; // amount data sent to view files... 
                return view('livewire.maintenance.maintenance-index', [
                    "maintenances" => $maintenances,
                    "validPerPageOptions" => $validPerPageOptions,
                ]);
            } catch (\Exception $e) {
                session()->flash('error', 'Something went wrong: ' . $e->getMessage());
            }
        }
    }

    public function mount()
    {
        // Current month range
        $startOfCurrentMonth = Carbon::now()->startOfMonth();
        $endOfCurrentMonth = Carbon::now()->endOfMonth();
        $this->income = Maintenance::whereBetween('date', [$startOfCurrentMonth, $endOfCurrentMonth])->whereType(1)->sum('amount');
        $this->expense = Maintenance::whereBetween('date', [$startOfCurrentMonth, $endOfCurrentMonth])->whereType(0)->sum('amount');
        return    $this->amount = $this->income - $this->expense;
    }

    protected function dataInput()
    {
        $this->type = $this->maintenance->type;
        $this->amount = $this->maintenance->amount;
        $this->note  = $this->maintenance->note;
        $this->date = $this->maintenance->date;
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

   // Current month range
                // $startOfCurrentMonth = Carbon::now()->startOfMonth();
                // $endOfCurrentMonth = Carbon::now()->endOfMonth();

                // Last month range
                // $startOfLastMonth = Carbon::now()->subMonthNoOverflow()->startOfMonth();
                // $endOfLastMonth = Carbon::now()->subMonthNoOverflow()->endOfMonth();
