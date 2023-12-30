<nav class="navbar navbar-expand-sm navbar-light bg-light fixed-top">
      <div class="container">
        <a class="navbar-brand" href="{{ route('index') }}" wire:navigate>
        <img src="{{ asset('assets/images/qati3-logo.svg') }}" alt="">

        </a>
        <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <form class="d-flex ms-auto my-2 my-lg-0">
                <input class="form-control me-sm-2" type="text" placeholder="Search">
                <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
            </form>

            @auth
                <div class="nav-item dropdown ms-2">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ auth()->user()->name }}</a>
                    <div class="dropdown-menu" aria-labelledby="dropdownId">
                        <a class="dropdown-item" href="{{ route('profile') }}" wire:navigate>Profile</a>
                        <a href="{{ route('logout') }}" class="dropdown-item" wire:navigate>Logout</a>
                    </div>
                </div>
            @else
                <a href="{{ route('auth') }}" class="ms-2 btn btn-primary" wire:navigate>{{ __('Login') }}</a>
            @endauth
        </div>
  </div>
</nav>
