<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth; // Import the Auth facade
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Register')]

class RegisterPage extends Component
{
    public $name;
    public $email;
    public $password;

    //Register user
    public function save(){
        $this->validate([
            'name' => ['required','max:255'],
            'email' => ['required','email', 'unique:users'],
            'password' => ['required','min:8','max:255'],
        ]);
        //save to database
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);
        
        //login user
        Auth::login($user); // Use Auth facade to log in the user

        //redirect to home page
        return redirect()->intended();
    }

    public function render()
    {
        return view('livewire.auth.register-page');
    }
}
