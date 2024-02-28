<div class="card mt-5">
    <div class="card-header text-center">
        Choose your role !
    </div>
    <div class="card-body text-center">
        @foreach (Auth::user()->roles as $role)
          <button class="btn btn-outline-secondary w-50" wire:click="choose('{{$role->uuid}}')">{{$role->roleName}}</button>
        @endforeach
    </div>
</div>
