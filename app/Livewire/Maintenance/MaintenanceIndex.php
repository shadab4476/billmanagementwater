<?php

namespace App\Livewire\Maintenance;

use App\Models\Maintenance;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class MaintenanceIndex extends Component
{
    use WithPagination;
    public $amountTabsActive = "current", $amount, $income, $expense, $monthName; //amount income expense show 
    public $maintenance_id;
    public $showDeleteModal = false;
    public  $maintenance_select = [], $selectAll = false; //select all checkbox deleted

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

    public function updatedSelectAll($value)
    {
        try {
            if ($value) {
                $this->maintenance_select = Maintenance::orderBy("id", "desc")->limit(5)->pluck('id')->toArray();
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
                    $maintenanceDelete = Maintenance::whereIn("id", $this->maintenance_select);
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
    // amount data tabs 
    public function amountTabs($data = null)
    {
        if ($data == "all" || $data == "current") {
            $this->amountTabsActive = $data;
            if ($data == "current") {
                // Current month range
                $startOfCurrentMonth = Carbon::now()->startOfMonth();
                $endOfCurrentMonth = Carbon::now()->endOfMonth();
                $this->income = Maintenance::whereBetween('date', [$startOfCurrentMonth, $endOfCurrentMonth])->whereType(1)->sum('amount');
                $this->expense = Maintenance::whereBetween('date', [$startOfCurrentMonth, $endOfCurrentMonth])->whereType(0)->sum('amount');
                return    $this->amount = $this->income - $this->expense;
            } else {
                $this->income = Maintenance::whereType(1)->sum('amount');
                $this->expense = Maintenance::whereType(0)->sum('amount');
                return $this->amount = $this->income - $this->expense;
            }
        } else {
            $this->amountTabsActive = "all";
        }
    }

    public function render()
    {
        if (auth()->user()->hasRole('superAdmin')) {
            try {
                $maintenances = Maintenance::orderBy("id", "desc")->paginate(5);
                $this->monthName = Carbon::now()->format('F'); // e.g., "this month"

                // Current month range
                // $startOfCurrentMonth = Carbon::now()->startOfMonth();
                // $endOfCurrentMonth = Carbon::now()->endOfMonth();

                // Last month range
                // $startOfLastMonth = Carbon::now()->subMonthNoOverflow()->startOfMonth();
                // $endOfLastMonth = Carbon::now()->subMonthNoOverflow()->endOfMonth();

                return view('livewire.maintenance.maintenance-index', compact('maintenances'));
            } catch (\Exception $e) {
                session()->flash('error', 'Somthing went wrong.. ' . $e->getMessage());
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
}
