<?php

namespace App\Livewire\Auth;

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title("Login")]
class Login extends Component
{

    public LoginForm $form;

    public function render()
    {
        // if (Auth::check()) {
        //     return $this->redirect("/campaigns", navigate: true);
        // }
        return view('livewire.auth.login');
    }

    public function login()
    {
        if($this->form->store()) {
            $this->redirect("/campaigns", navigate: true);
        }

    }
}
