<?php

namespace App\Livewire\Users;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, WithoutUrlPagination;

    protected $paginationTheme = "bootstrap";

    public function render():View
    {
        $users = User::paginate(10);
        return view('livewire.users.index')->with('users', $users);
    }
}
