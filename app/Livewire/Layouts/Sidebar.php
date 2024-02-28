<?php

namespace App\Livewire\Layouts;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Sidebar extends Component
{
    public function render()
    {
        return view('livewire.layouts.sidebar');
    }

    public function logout() {
        if(Auth::check()) {
            Auth::logout();
            return $this->redirect('/login', navigate:true);
        }
    }
}
