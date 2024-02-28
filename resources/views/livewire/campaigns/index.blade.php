<div>
    <div class="card">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <div class="card-header text-end">
            <a class="btn " href="/campaigns/create" wire:navigate>+ New Campaign</a>
        </div>
        <div class="card-body table-responsive">
{{--            <livewire:general.data-table :model="$campaigns" :columns="$columns"/>--}}
            <div class="mb-3 d-flex justify-content-end">
                <input class="form-control w-25" type="search" placeholder="Type to search" name="search" wire:model.live.debounce.1000ms="search">
            </div>
            <table class="table ">
                <thead>
                @php $dir = $sortDir === 'asc' ? "desc" : "asc"; @endphp
                <th scope="col">#</th>
                <th scope="col">
                    <div
                        @class(["d-flex", "justify-content-between", "align-items-center"]) wire:click="sort('name', '{{$sortColumn === 'name' ? $dir : 'asc'}}')">
                        Campaign Name
                        <div @class(["d-flex", "sort-icon", "opacity-0" => $sortColumn !== 'name'])>
                            <span @class(["material-symbols-outlined","fs-6","text-primary" => $sortColumn ==='name' && $sortDir === 'asc'])>
                                north
                            </span>
                            <span @class(["material-symbols-outlined","fs-6","text-primary" => $sortColumn ==='name' && $sortDir === 'desc'])>
                                south
                            </span>
                        </div>
                    </div>
                </th>
                <th scope="col">
                    <div
                        @class(["d-flex", "justify-content-between", "align-items-center"]) wire:click="sort('creator.name', '{{$sortColumn === 'creator.name' ? $dir : 'asc'}}')">
                        Created By
                        <div @class(["d-flex", "sort-icon", "opacity-0" => $sortColumn !== "creator.name"])>
                            <span @class(["material-symbols-outlined","fs-6","text-primary"=>$sortColumn !== "creator.name" && $sortDir === 'asc'])>
                                north
                            </span>
                            <span @class(["material-symbols-outlined","fs-6","text-primary"=>$sortColumn !== "creator.name" && $sortDir === 'desc'])>
                                south
                            </span>
                        </div>
                    </div>
                </th>
                <th scope="col">Status</th>
                <th scope="col">
                    <div
                        @class(["d-flex", "justify-content-between", "align-items-center"]) wire:click="sort('created_at', '{{$sortColumn === 'created_at' ? $dir : 'asc'}}')">
                        Created By
                        <div @class(["d-flex", "sort-icon", "opacity-0" => $sortColumn !== "created_at"])>
                            <span @class(["material-symbols-outlined","fs-6","text-primary" => $sortColumn === "created_at" && $sortDir === 'asc'])>
                                north
                            </span>
                            <span @class(["material-symbols-outlined","fs-6","text-primary" =>$sortColumn === "created_at" && $sortDir === 'desc'])>
                                south
                            </span>
                        </div>
                    </div>
                </th>
                <th scope="col"></th>
                </thead>

                <tbody>
                    {{print_r($filters)}}
                @foreach ($campaigns as $campaign)
                    <tr wire:key="{{ $campaign->uuid }}" scope="row">
                        <td>{{ $campaign->uuid }}</td>
                        <td>{{ $campaign->name }}</td>
                        <td>{{ isset($campaign->creator->fullName) ?$campaign->creator->fullName:"" }}</td>
                        <td><!-- Example split danger button -->
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch"
                                       id="flexSwitchCheckDefault"
                                       {{ $campaign->status ? 'checked' : '' }}
                                       wire:click="updateStatus('{{ $campaign->uuid }}',{{ $campaign->status ? 0 : 1 }})"
                                       style="width:44px; height:26px;">
                            </div>
                        </td>
                        <td>{{$campaign->created_at->format('Y-M-d')}}</td>
                        <td>
                            <button type="button" class="btn btn-danger" wire:click="delete('{{ $campaign->uuid }}')"
                                    style="padding:0 5px;">
                  <span class="material-symbols-outlined lh-inherit">
                    delete
                  </span>
                            </button>
                        </td>
                    </tr>
                @endforeach
                @if (!$campaigns->count())
                    <tr scope="row">
                        <td colspan="3" class="text-center"> No data found.</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
    <div class="d-flex mt-3 justify-content-between">
        <div class="">
            <div class="dropdown">
                <button
                    class="btn btn-outline-secondary dropdown-toggle d-flex align-items-center text-white text-decoration-none"
                    data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                    {{ $perPage }}
                </button>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start">
                    <li>
                        <button type="button" class="dropdown-item" wire:click="setPerPage(10)">10</button>
                    </li>
                    <li>
                        <button type="button" class="dropdown-item" wire:click="setPerPage(25)">25</button>
                    </li>
                    <li>
                        <button type="button" class="dropdown-item" wire:click="setPerPage(50)">50</button>
                    </li>
                </ul>
            </div>
        </div>
        {{ $campaigns->links() }}
    </div>
</div>
