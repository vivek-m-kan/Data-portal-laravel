<?php

namespace App\Livewire\General;

use Livewire\Component;

class DataTable extends Component
{
    public $columns;

    public function render()
    {
        dd($this->columns);
        return view('livewire.general.data-table');
    }
}
