<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Register extends Component
{
    public $name, $email, $password, $phone;


    // public function hydrate() {
    //     $this->name = 'shadab';
    // }

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
        $data['password'] = Hash::make($this->password);
        $user =  User::create($data);
        $user->assignRole('user');
        session()->flash('success', 'User created successfully');
    }
    public function render()
    {
        return view('livewire.auth.register');
    }
}
