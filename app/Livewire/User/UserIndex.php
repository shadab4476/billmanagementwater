<?php

namespace App\Livewire\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;

class UserIndex extends Component
{
    use WithPagination;
    public $name, $email, $password, $phone, $isActive, $time, $passwordType = "password";
    public  $userEdit;
    public $user_id;
    public $modelmain, $editModelUser, $showDeleteModal = false; //models


    public function updated($data)
    {
        $this->validateOnly($data, [
            'name' => 'required|string|regex:/^[a-zA-Z\s]+$/|min:3|max:15',  // Only letters and spaces
            "email" => "required|email|unique:users,email",
            "phone" => "required|unique:users,phone|numeric|digits:10",
            'password' => [
                'required',
                'string',
                'min:8',  // Minimum length of 8 characters
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
            ],
        ], [
            'password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.',
        ]);
    }


    public function register()
    {
        $data = $this->validate([
            'name' => 'required|string|regex:/^[a-zA-Z\s]+$/|min:3|max:15',  // Only letters and spaces
            "email" => "required|email|unique:users,email",
            "phone" => "required|unique:users,phone|numeric|digits:10",
            'password' => [
                'required',
                'string',
                'min:8',  // Minimum length of 8 characters
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
            ],
        ], [
            'password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.',
        ]);
        try {
            $data['password'] = Hash::make($this->password);
            $user =  User::create($data);
            $user->assignRole('user');
            $this->mainModelClose();
            $this->render();
            session()->flash('success', 'User created successfully');
        } catch (\Exception $e) {
            $this->mainModelClose();
            session()->flash('error', 'Somthing went wrong.. ' . $e->getMessage());
        }
    }


    public function mainModelOpen()
    {
        $this->modelmain = true;
    }

    public function mainModelClose()
    {
        $this->blankInput();
        $this->editModelUser = false;
        $this->modelmain = false;
    }

    public function editUser($id)
    {
        $this->modelmain = true;
        $this->user_id = $id;
        $this->userEdit = User::findOrFail($this->user_id);
        $this->dataInput();
        $this->editModelUser = true;
    }
    public function updateUser()
    {
        try {
            $dataUpdate = $this->validate([
                'name' => 'required|string|regex:/^[a-zA-Z\s]+$/|min:3|max:15',  // Only letters and spaces
                "email" => "required|email|unique:users,email," . $this->user_id,
                "phone" => "required|numeric|digits:10|unique:users,phone," . $this->user_id,
            ]);
            $this->userEdit->update($dataUpdate);
            $this->mainModelClose();
            $this->render();
            session()->flash('success', 'User updated successfully...');
        } catch (\Exception $e) {
            $this->mainModelClose();
            session()->flash('error', 'Somthing went wrong.. ' . $e->getMessage());
        }
    }
    public function openDeleteModel($id)
    {
        $this->user_id = $id;
        $this->showDeleteModal = true;
    }
    public function closeDeleteModal()
    {
        $this->user_id = null;
        $this->showDeleteModal = false;
    }
    public function deleteUser()
    {
        try {
            $userDelete = User::findOrFail($this->user_id);
            $userDelete->delete();
            $this->render();
            session()->flash('success', 'User Deleted successfully...');
        } catch (\Exception $e) {
            session()->flash('error', 'Somthing went wrong.. ' . $e->getMessage());
        }
        $this->showDeleteModal = false;
    }

    protected function dataInput()
    {
        $this->name = $this->userEdit->name;
        $this->email = $this->userEdit->email;
        $this->phone = $this->userEdit->phone;
    }
    protected function blankInput()
    {
        $this->name = "";
        $this->email = "";
        $this->phone = "";
        $this->password = "";
    }

    public function render()
    {
        if (auth()->user()->hasRole('admin')) {
            $users = User::paginate(5);
        } else {
            $users = User::whereUserId(auth()->user()->id)->paginate(1);
        }

        $this->isActive();
        return view('livewire.user.user-index', ["users" => $users]);
    }

    public function isActive()
    {
        if (auth()->user()->hasRole('admin')) {
            try {
                $this->time = time();
                $this->isActive = User::get(["status", "id"]);
            } catch (\Exception $e) {
                $this->mainModelClose();
                session()->flash('error', 'Somthing went wrong.. ' . $e->getMessage());
            }
        }
    }
    public function typeToggle()
    {
        $this->passwordType == "password" ? $this->passwordType = "text" : $this->passwordType = "password";
    }
}
