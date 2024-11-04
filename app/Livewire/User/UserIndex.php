<?php

namespace App\Livewire\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;

class UserIndex extends Component
{
    use WithPagination;
    public $name, $email, $password, $phone, $countUser, $isActive, $time, $passwordType = "password";
    public  $userEdit;
    public $user_id;
    public $modelmain, $editModelUser, $showDeleteModal = false; //models
    public $user_select = [], $selectAll = false; // all select user deleted

    public function mount()
    {
        if (auth()->user()->hasAnyRole(['admin', 'superAdmin'])) {
            try {
                $this->time = time();
                $this->isActive = User::get(["status", "id"]);
            } catch (\Exception $e) {
                $this->mainModelClose();
                session()->flash('error', 'Somthing went wrong.. ' . $e->getMessage());
            }
        }
    }
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
    public function openDeleteModel($id = null)
    {
        $this->user_id = $id;
        $this->showDeleteModal = true;
    }
    public function closeDeleteModal()
    {
        $this->user_id = null;
        $this->showDeleteModal = false;
    }
    public function updatedSelectAll($value)
    {
        try {
            if ($value) {
                $this->user_select = User::orderBy("created_at", "desc")->limit(5)->pluck('id')->toArray();
            } else {
                $this->user_select = [];
            }
        } catch (\Exception $e) {
            $this->mainModelClose();
            session()->flash('error', 'Somthing went wrong.. ' . $e->getMessage());
        }
    }
    public function deleteUser()
    {
        try {
            $superAdmins = User::role("superAdmin")->get("id");
            $userAuth = User::findOrFail(auth()->user()->id);
            if ($this->user_select == [] || $this->user_id) {
                $userDelete = User::findOrFail($this->user_id);
                if ($userDelete->id == $userAuth->id) {
                    $this->showDeleteModal = false;
                    return session()->flash('error', 'Somthing went wrong.. You cannot delete yourself.');
                }
                // Prevent Super Admin deletion
                if ($superAdmins->contains($userDelete->id)) {
                    $this->showDeleteModal = false;
                    return session()->flash('error', 'Something went wrong.. Super Admin cannot be deleted.');
                }
                $userDelete->delete();
            } else {
                $userDelete = User::whereIn("id", $this->user_select)->get('id');
                if ($userDelete->contains('id', $userAuth->id)) {
                    $this->showDeleteModal = false;
                    return session()->flash('error', 'Somthing went wrong.. You cannot delete yourself.');
                }
                foreach ($userDelete as $user) {
                    if ($superAdmins->contains($user->id)) {
                        $this->showDeleteModal = false;
                        return session()->flash('error', 'Something went wrong.. Super Admin cannot be deleted.');
                    }
                }
                $userDelete = User::whereIn("id", $this->user_select);
                $userDelete->delete();
                $this->user_select = false;
                $this->selectAll = false;
            }
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
        try {
            if (auth()->user()->hasAnyRole(['admin', 'superAdmin'])) {
                $users =     User::with('roles')->paginate(5);
            } else {
                $users = User::whereUserId(auth()->user()->id)->paginate(1);
            }
            return view('livewire.user.user-index', ["users" => $users]);
        } catch (\Exception $e) {
            $this->mainModelClose();
            session()->flash('error', 'Somthing went wrong.. ' . $e->getMessage());
        }
    }

    public function getStatus()
    {
        if (auth()->user()->hasAnyRole(['admin', 'superAdmin'])) {
            try {
                $this->time = time();
                $this->isActive = User::get(["status", "id"]);
                $this->countUser = User::where("status", 1)->get(['status']);
                $this->countUser = count($this->countUser);
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
