<div class="card">
    @if (session('success'))
        <div class="alert alert-success" role="alert">
          {{ session('success') }}
        </div>
      @endif
  <div class="card-header text-end">
    <a class="btn " href="/campaigns/create" wire:navigate>+ New Users</a>
  </div>
  <div class="card-body">
    <div class="mb-3 d-flex justify-content-end">
      <input class="form-control w-25" type="search" placeholder="Type to search" name="search"
        wire:model.live.debounce.1000ms="search">
    </div>
    <table class="table ">
      <thead>
        <th scope="col">#</th>
        <th scope="col">Client Name</th>
        <th scope="col">Company Name</th>
        <th scope="col">Address</th>
        <th scope="col">Phone number</th>
        {{-- <th scope="col"></th> --}}
      </thead>

      <tbody>
        @foreach ($clients as $client)
          <tr wire:key="{{ $client->uuid }}" scope="row">
            <td>{{ $client->uuid }}</td>
            <td>{{ $client->name }}</td>
            <td>{{ $client->company_name }}</td>
            <td>{{ $client->address }}</td>
            <td>{{ $client->contact_number }}</td>
            {{-- <td>
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault"
                  {{ $client->status ? 'checked' : '' }}
                  wire:click="updateStatus('{{ $client->uuid }}',{{ $client->status ? 0 : 1 }})"
                  style="width:44px; height:26px;">
              </div>
            </td>
            <td>
              <button type="button" class="btn btn-danger" wire:click="delete('{{ $client->uuid }}')" style="padding:0 5px;">
                <span class="material-symbols-outlined lh-inherit">
                  delete
                </span>
              </button>
            </td> --}}
          </tr>
        @endforeach
        @if (!$clients->count())
          <tr scope="row">
            <td colspan="5" class="text-center"> No data found.</td>
          </tr>
        @endif
      </tbody>
    </table>
    {{ $clients->links() }}
  </div>
</div>
