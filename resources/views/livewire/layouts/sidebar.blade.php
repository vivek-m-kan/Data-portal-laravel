  <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark border-end" style="width:280px;">
    <a href="/campaigns" wire:navigate class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
      <span class="material-symbols-outlined me-1">
        captive_portal
      </span>
      Data Portal
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
      <li class="nav-item">
        <a @class(['nav-link', 'text-white', 'd-flex', 'align-items-center', 'active' => request()->is('users')]) aria-current="page" href="/users" wire:navigate>
          <span class="material-symbols-outlined me-1">
            person
          </span>
          Users
        </a>
      </li>
      <li class="nav-item">
        <a @class([
            'nav-link',
            'text-white',
            'd-flex',
            'align-items-center',
            'active' => request()->is('campaigns'),
        ]) href="/campaigns" wire:navigate>
          <span class="material-symbols-outlined me-1">
            campaign
          </span>
          Campaigns
        </a>
      </li>
      <li class="nav-item">
        <a @class([
            'nav-link',
            'text-white',
            'd-flex',
            'align-items-center',
            'active' => request()->is('clients'),
        ]) href="/clients" wire:navigate>
          <span class="material-symbols-outlined me-1">
            store
          </span>
          Clients
        </a>
      </li>
      <li class="nav-item">
        <a @class(['nav-link', 'text-white', 'd-flex', 'align-items-center', 'active' => request()->is('leads')]) href="/leads" wire:navigate>
          <span class="material-symbols-outlined me-1">
            density_small
          </span>
          Leads
        </a>
      </li>
    </ul>
    <hr>
    <div class="dropup">
      <a class="dropdown-toggle d-flex align-items-center text-white text-decoration-none" data-bs-toggle="dropdown"
        data-bs-display="static" aria-expanded="false">
        <span class="material-symbols-outlined lh-inherit me-1">
          person
        </span>
        {{ Auth::user()->fullName }}
      </a>
      <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start pe-2 ps-2">
        <li><a class="dropdown-item" href="#">Profile</a></li>
        {{-- <li><a class="dropdown-item" href="#">Action</a></li> --}}
        <hr class="mt-2 mb-2">
        <li><button class="btn btn-danger w-100" wire:click="logout">Logout</button></li>
      </ul>
    </div>
  </div>
