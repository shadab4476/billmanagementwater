<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Livewire\Component;

class Logout extends Component
{
    public function logout()
    {
        $user =  User::find(auth()->user()->id);
        $user->status = false;
        $user->update();
        auth()->logout();
        return redirect()->route('login');
    }
    public function render()
    {
        return view('livewire.auth.logout');
    }
}
