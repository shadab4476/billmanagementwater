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
    public $shops;
    public function mount()
    {
        // $this->shops = Shop::paginate(1);
        $this->shops = Shop::get();
    }
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
    public   $shop_name, $shop_image, $oldImage, $shop_address, $shop_description; // shop data
    public $shopEdit; // shop edit data  
    public $shop_id; // shop_id  
    public $editModelShop = false, $showDeleteModal = false; //model edit or crate open..
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
            $this->mount();
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
            $this->mount();
            $this->mainModelClose();
            session()->flash('success', 'Shop updated successfully...');
        } catch (\Exception $e) {
            $this->mainModelClose();
            session()->flash('error', 'Somthing went wrong.. ' . $e->getMessage());
        }
    }
    public function openDeleteModel($id)
    {
        $this->shop_id = $id;
        $this->showDeleteModal = true;
    }
    public function closeDeleteModal()
    {
        $this->shop_id = null;
        $this->showDeleteModal = false;
    }

    public function deleteShop()
    {

        try {
            $shopDelete = Shop::findOrFail($this->shop_id);
            $shopDelete->delete();
            $this->mount();
            session()->flash('success', 'Shop Deleted successfully...');
        } catch (\Exception $e) {
            $this->mainModelClose();
            session()->flash('error', 'Somthing went wrong.. ' . $e->getMessage());
        }
        $this->showDeleteModal = false;
    }
    public function render()
    {
        $this->isActive();
        return view('livewire.shop.shop-index');
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
    public function isActive()
    {
        try {
            $this->time = time();
            $this->isActive = Shop::get(["status", "id"]);
        } catch (\Exception $e) {
            $this->mainModelClose();
            session()->flash('error', 'Somthing went wrong.. ' . $e->getMessage());
        }
    }
}