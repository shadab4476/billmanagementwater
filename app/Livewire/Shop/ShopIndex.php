<?php

namespace App\Livewire\Shop;

use App\Models\Shop;
use Livewire\WithFileUploads;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Livewire\WithPagination;


class ShopIndex extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $isActive, $time; //active check
    public $perPage, $validPerPageOptions; // pagiantion variables
    public $search; // search variable
    public function mount()
    {
        try {
            $this->time = time();
            if (auth()->user()->hasAnyRole(['admin', 'superAdmin'])) {
                $this->isActive = Shop::get(["status", "id"]);
            } else {
                $this->isActive = Shop::whereUserId(auth()->user()->id)->get(["status", "id"]);
            }
        } catch (\Exception $e) {
            $this->mainModelClose();
            session()->flash('error', 'Somthing went wrong.. ' . $e->getMessage());
        }
    }
    // get variable on url
    protected $queryString = [
        'editModelShop' => ['except' => ''],
        'showDeleteModal' => ['except' => ''],
        'modelmain' => ['except' => ''],
        'showStatusModal' => ['except' => ''],
        'perPage' => ['except' => ''],
        'search' => ['except' => ''],
    ];

    public function updated($data)
    {
        $this->validateOnly($data, [
            'shop_name' => 'required|unique:shops,shop_name|string|regex:/^[a-zA-Z\s]+$/|min:5|max:30',  // Only letters and spaces
            'shop_address' => 'required',
            'shop_image' => 'nullable|image|mimes:jpeg,png,jpg',
            'shop_description' => 'nullable|max:50',
        ]);
    }
    // variable issued
    public   $shop_name, $shop_image, $oldImage, $shop_address, $shop_description, $status, $shop_select = [], $selectAll = false; // shop data
    public $shopEdit; // shop edit data  
    public $shop_id; // shop_id  
    public $editModelShop = false, $showDeleteModal = false; //model edit or crate open..
    public  $showStatusModal = false; //model status..
    public $modelmain = false; //model main open..

    public function mainModelOpen()
    {
        $this->modelmain = true;
    }
    public function mainModelClose()
    {
        $this->blankInput();
        $this->editModelShop = false;
        $this->modelmain = false;
    }

    public function shopCreate()
    {
        $shop_data = $this->validate([
            'shop_name' => 'required|unique:shops,shop_name|string|regex:/^[a-zA-Z\s]+$/|min:5|max:30',  // Only letters and spaces
            'shop_address' => 'required',
            'shop_image' => 'nullable|mimes:jpeg,png,jpg|image',
            'shop_description' => 'nullable|max:50',
        ]);
        try {
            $shop_data["user_id"] = auth()->user()->id;
            // Store the image in the public folder
            if ($this->shop_image) {
                $shop_data['shop_image'] = time() . '.' . $this->shop_image->getClientOriginalExtension();
                $this->shop_image->storeAs('public/assets/images/', $shop_data['shop_image']); // 'public/images' refers to the public folder
            } else {
                $shop_data['shop_image'] = null;
            }
            Shop::create($shop_data);
            $this->render();
            $this->mainModelClose();
            session()->flash('success', 'Shop created successfully...');
        } catch (\Exception $e) {
            session()->flash('error', 'Somthing went wrong.. ' . $e->getMessage());
        }
    }
    public function editShop($id)
    {
        $this->modelmain = true;
        $this->shop_id = $id;
        $this->shopEdit = Shop::findOrFail($this->shop_id);
        $this->dataInput();
        $this->editModelShop = true;
    }

    public function shopUpdate()
    {
        $dataUpdate = $this->validate([
            'shop_name' => 'required|string|regex:/^[a-zA-Z\s]+$/|min:5|max:30|unique:shops,shop_name,' . $this->shop_id,  // Only letters and spaces
            'shop_address' => 'required',
            'shop_image' => 'nullable|mimes:jpeg,png,jpg|image',
            'shop_description' => 'nullable|max:50',
        ]);
        try {
            $this->shopEdit = Shop::findOrFail($this->shop_id);
            if ($this->shop_image) { //how to unlink inside the folder image
                $imagePath = 'assets/images/' . $this->shopEdit->shop_image;
                Storage::disk('public')->delete($imagePath);  // Deletes the image from storage
                $dataUpdate['shop_image'] = time() . '.' . $this->shop_image->getClientOriginalExtension();
                $this->shop_image->storeAs('public/assets/images/', $dataUpdate['shop_image']); // 'public/images' refers to the public folder
            } else {
                $dataUpdate['shop_image'] = $this->shopEdit->shop_image;
            }
            $this->shopEdit->update($dataUpdate);
            $this->render();
            $this->mainModelClose();
            session()->flash('success', 'Shop updated successfully...');
        } catch (\Exception $e) {
            $this->mainModelClose();
            session()->flash('error', 'Somthing went wrong.. ' . $e->getMessage());
        }
    }
    public function openDeleteModel($id = null)
    {
        if (auth()->user()->hasAnyRole(['admin', 'superAdmin'])) {
            $this->shop_id = $id;
            $this->showDeleteModal = true;
        }
    }
    public function closeDeleteModal()
    {
        if (auth()->user()->hasAnyRole(['admin', 'superAdmin'])) {

            $this->shop_id = null;
            $this->showDeleteModal = false;
        }
    }
    public function openStatusModel($id)
    {
        if (auth()->user()->hasAnyRole(['admin', 'superAdmin'])) {
            $this->shop_id = $id;
            $shopStatus = Shop::findOrFail($this->shop_id);
            $this->status = $shopStatus->status;
            $this->showStatusModal = true;
        }
    }
    public function closeStatusModal()
    {
        if (auth()->user()->hasAnyRole(['admin', 'superAdmin'])) {

            $this->shop_id = null;
            $this->showStatusModal = false;
        }
    }
    public function updateStatus()
    {
        if (auth()->user()->hasAnyRole(['admin', 'superAdmin'])) {
            $this->validate([
                'status' => 'required',
            ]);
            try {
                $shopStatus = Shop::findOrFail($this->shop_id);
                $shopStatus->status = $this->status;
                $shopStatus->update();
                $this->getStatus();
                session()->flash('success', 'Shop Status Changed successfully...');
            } catch (\Exception $e) {
                $this->mainModelClose();
                session()->flash('error', 'Somthing went wrong.. ' . $e->getMessage());
            }
            $this->showStatusModal = false;
        }
    }

    public function updatedSelectAll($value)
    {
        try {
            if ($value) {
                $queryShops = Shop::query();
                if (auth()->user()->hasAnyRole(['admin', 'superAdmin'])) {
                    $queryShops->with('users')->orderBy("created_at", "desc");
                } else {
                    $queryShops->with('users')->whereUserId(auth()->user()->id)->orderBy("created_at", "desc");
                }
                // search
                if ($this->search) {
                    $searchShopColumns = ['id', 'shop_address', "shop_name", "shop_description"]; // Add any additional columns here
                    $queryShops->where(function ($query) use ($searchShopColumns) {
                        foreach ($searchShopColumns as $column) {
                            $query->orWhere($column, 'like', '%' . trim($this->search) . '%');
                        }
                    });
                }
                $this->validPerPageOptions = [5, 10, 50, 100]; //this variable value in maintenance-index.blade.php file perpage... 
                $this->perPage = in_array($this->perPage, $this->validPerPageOptions) ? $this->perPage : 5;
                $this->shop_select = $queryShops->limit($this->perPage)->pluck('id')->toArray();
            } else {
                $this->shop_select = [];
            }
        } catch (\Exception $e) {
            $this->mainModelClose();
            session()->flash('error', 'Somthing went wrong.. ' . $e->getMessage());
        }
    }
    public function deleteShop()
    {
        if (auth()->user()->hasAnyRole(['admin', 'superAdmin'])) {
            try {
                if ($this->shop_select == [] || $this->shop_id) {
                    $shopDelete = Shop::findOrFail($this->shop_id);
                } else {
                    $shopDelete = Shop::whereIn("id", $this->shop_select);
                    $this->shop_select = false;
                    $this->selectAll = false;
                }
                $shopDelete->delete();
                $this->render();
                session()->flash('success', 'Shop Deleted successfully...');
            } catch (\Exception $e) {
                $this->mainModelClose();
                session()->flash('error', 'Somthing went wrong.. ' . $e->getMessage());
            }
            $this->showDeleteModal = false;
        }
    }

    protected function dataInput()
    {
        $this->shop_address = $this->shopEdit->shop_address;
        $this->shop_description = $this->shopEdit->shop_description;
        $this->oldImage  = $this->shopEdit->shop_image;
        $this->shop_name = $this->shopEdit->shop_name;
    }
    protected function blankInput()
    {
        $this->shop_address = "";
        $this->shop_description = "";
        $this->shop_image = "";
        $this->shop_name = "";
    }
    public function getStatus()
    {
        try {
            $this->time = time();
            if (auth()->user()->hasAnyRole(['admin', 'superAdmin'])) {
                $this->isActive = Shop::get(["status", "id"]);
            } else {
                $this->isActive = Shop::whereUserId(auth()->user()->id)->get(["status", "id"]);
            }
        } catch (\Exception $e) {
            $this->mainModelClose();
            session()->flash('error', 'Somthing went wrong.. ' . $e->getMessage());
        }
    }
    public function render()
    {
        $this->validPerPageOptions = [5, 10, 50, 100]; //this variable value in maintenance-index.blade.php file perpage... 
        $this->perPage = in_array($this->perPage, $this->validPerPageOptions) ? $this->perPage : 5;
        $queryShops = Shop::query();
        if (auth()->user()->hasAnyRole(['admin', 'superAdmin'])) {
            $queryShops->with('users')->orderBy("created_at", "desc");
        } else {
            $queryShops->with('users')->whereUserId(auth()->user()->id)->orderBy("created_at", "desc");
        }

        // search
        if ($this->search) {
            $searchShopColumns = ['id', 'shop_address', "shop_name", "shop_description"]; // Add any additional columns here
            $queryShops->where(function ($query) use ($searchShopColumns) {
                foreach ($searchShopColumns as $column) {
                    $query->orWhere($column, 'like', '%' . trim($this->search) . '%');
                }
            });
        }
        $shops =   $queryShops->paginate($this->perPage);
        return view('livewire.shop.shop-index', ["shops" => $shops]);
    }
}
