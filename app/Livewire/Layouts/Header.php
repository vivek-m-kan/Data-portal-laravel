<?php

namespace App\Livewire\Layouts;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Header extends Component
{
    public function render()
    {
        return view('livewire.layouts.header');
    }

    public function logout() {
        if(Auth::check()) {
            Auth::logout();
            Session::flush();
            return $this->redirect('/login', navigate:true);
        }
    }
}
