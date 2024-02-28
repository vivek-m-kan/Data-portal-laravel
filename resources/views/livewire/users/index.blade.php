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
        <th scope="col">Name</th>
        <th scope="col">Campaigns Count</th>
        <th scope="col">Status</th>
        <th scope="col"></th>
      </thead>

      <tbody>
        @foreach ($users as $user)
          <tr wire:key="{{ $user->uuid }}" scope="row">
            <td>{{ $user->uuid }}</td>
            <td>{{ $user->fullName }}</td>
            <td>{{ $user->campaigns()->count() }}</td>
            <td><!-- Example split danger button -->
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault"
                  {{ $user->status ? 'checked' : '' }}
                  wire:click="updateStatus('{{ $user->uuid }}',{{ $user->status ? 0 : 1 }})"
                  style="width:44px; height:26px;">
              </div>
            </td>
            <td>
              <button type="button" class="btn btn-danger" wire:click="delete('{{ $user->uuid }}')" style="padding:0 5px;">
                <span class="material-symbols-outlined lh-inherit">
                  delete
                </span>
              </button>
            </td>
          </tr>
        @endforeach
        @if (!$users->count())
          <tr scope="row">
            <td colspan="3" class="text-center"> No data found.</td>
          </tr>
        @endif
      </tbody>
    </table>
    {{ $users->links() }}
  </div>
</div>
