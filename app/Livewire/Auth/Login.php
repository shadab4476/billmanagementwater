<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Livewire\Component;

class Login extends Component
{
    public  $email, $password;

    public function updated($data)
    {
        $this->validateOnly($data, [
            "email" => "required",
            "password" => "required",
        ]);
    }


    public function login()
    {

        $this->validate([
            "email" => "required",
            "password" => "required",
        ]);

        $credentail = array("email" => $this->email,  "password" => $this->password);
        if (auth()->attempt($credentail)) {
            $user =  User::find(auth()->user()->id);
            $user->status = true;
            $user->update();
            $this->inputNull();
            return redirect()->route("home");
        }
        return  session()->flash('error', 'Crediantial Not Match Please Try Again...!');
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
    public function inputNull()
    {
        $this->email = "";
        $this->password = "";
    }
}
