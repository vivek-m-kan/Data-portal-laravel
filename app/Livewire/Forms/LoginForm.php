<?php

namespace App\Livewire\Forms;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Form;

class LoginForm extends Form
{
    #[Validate('required')]
    public $email = "";

    #[Validate('required')]
    public $password = "";

    public function store(): bool
    {
        $this->validate();

        return Auth::attempt($this->only(['email', 'password']));
    }
}
