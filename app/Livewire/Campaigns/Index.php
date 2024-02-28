<?php

namespace App\Livewire\Campaigns;

use App\Models\Campaigns;
use App\Utils\GeneralFilters;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, WithoutUrlPagination;

    protected string $paginationTheme = 'bootstrap';

    public int $perPage = 10;

    public string $search = "";

    public string $sortColumn = 'created_at';

    public string $sortDir = 'desc';

    public $filters;

    public function render(): View
    {
        $campaigns = Campaigns::where("name", "like", "%$this->search%")
            ->with('creator')
            ->orderBy($this->sortColumn, $this->sortDir)
            ->paginate($this->perPage);

//        $columns->append(["header"=>'title']);

        return view('livewire.campaigns.index')->with(["campaigns" => $campaigns]);
    }

    public function mount()
    {
        $this->filters = new GeneralFilters();
    }

    public function updateStatus(Campaigns $campaign, int $status): void
    {
        $campaign->update(['status' => $status]);
        session()->flash("success", "Campaign status has been updated");
    }

    public function setPerPage(int $limit): void
    {
        $this->perPage = $limit;
    }

    public function sort($column, $dir): void
    {
        $this->sortColumn = $column;
        $this->sortDir = $dir;
    }

    public function delete(Campaigns $campaign): void
    {
        $campaign->delete();
    }
}
