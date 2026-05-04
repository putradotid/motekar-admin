<nav class="navbar navbar-expand navbar-light bg-white shadow-sm px-4 fixed-top">

    <!-- Logo -->
    <div class="d-flex align-items-center">
        <img 
            src="{{ asset('storage/motekar-logo.png') }}"
            class="rounded-circle mr-2"
            height="50"
            alt="logo"
        >
        <h4 class="font-weight-bold text-amber mb-0">
            MOTEKAR
        </h4>
    </div>

    <!-- Navbar -->
    <ul class="navbar-nav flex-row mx-auto">
        <li class="nav-item mx-3">
            <a href="{{ route('user-meeting') }}" class="nav-link {{ request()->routeIs('user-meeting') ? 'text-amber font-weight-bold' : 'text-dark' }}">
                Request Meeting
            </a>
        </li>
        <li class="nav-item mx-3">
            <a href="{{ route('user-message') }}" class="nav-link {{ request()->routeIs('user-message') ? 'text-amber font-weight-bold' : 'text-dark' }}">
                Message
            </a>
        </li>
        <li class="nav-item mx-3">
            <a href="{{ route('user-profile') }}" class="nav-link {{ request()->routeIs('user-profile') ? 'text-amber font-weight-bold' : 'text-dark' }}">
                Profile
            </a>
        </li>
    </ul>

    <!-- Logout -->
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn btn-danger px-4 rounded">
            Keluar
        </button>
    </form>

</nav>