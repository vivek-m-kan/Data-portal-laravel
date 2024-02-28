<div class="card">
    <div class="card-header">
        Login
    </div>
    <div class="card-body">
        <form wire:submit="login">
            <input class="form-control form-control-lg mb-3" type="text" placeholder="Email" aria-label=".form-control-lg example" wire:model="form.email">
            @error('email') <small class="text-danger">{{$message}}</small> @enderror
            <input class="form-control form-control-lg mb-3" type="password" placeholder="Password" aria-label=".form-control-lg example" wire:model="form.password">
            @error('password') <small class="text-danger">{{$message}}</small> @enderror
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
</div>
