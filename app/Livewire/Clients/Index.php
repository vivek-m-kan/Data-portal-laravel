<?php

namespace App\Livewire\Clients;

use App\Models\Clients;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, WithoutUrlPagination;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $clients = Clients::verified()->paginate(10);
        return view('livewire.clients.index')->with('clients', $clients);
    }
}
