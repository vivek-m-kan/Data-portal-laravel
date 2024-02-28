<?php

namespace App\Livewire\Auth;

use App\Models\Roles;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class ChooseLoginRole extends Component
{
    public function render()
    {
        if(!Auth::check()){
            return $this->redirect('/login', navigate:true);
        }

        return view('livewire.auth.choose-login-role');
    }

    public function choose(Roles $role) {
        Session::push('role', $role->role);

        $this->redirect("/campaigns", navigate: true);
    }
}
