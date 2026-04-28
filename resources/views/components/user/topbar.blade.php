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
            <a href="#" class="nav-link text-amber font-weight-bold">
                Request Meeting
            </a>
        </li>
        <li class="nav-item mx-3">
            <a href="#" class="nav-link text-dark">
                Message
            </a>
        </li>
        <li class="nav-item mx-3">
            <a href="#" class="nav-link text-dark">
                Profile
            </a>
        </li>
    </ul>

    <!-- Logout -->
    <div>
        <a href="#" class="btn btn-danger px-4 rounded-pill">
            Keluar
        </a>
    </div>

</nav>