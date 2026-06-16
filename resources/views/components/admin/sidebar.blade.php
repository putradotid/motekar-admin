<ul class="navbar-nav bg-amber sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Head -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
            <img
                src="{{ asset('storage/motekar-logo.png') }}"
                class="rounded-circle mr-2"
                height="50"
                alt="logo"
            >
        </div>
        <div class="sidebar-brand-text">Admin Panel</div>
    </a>

    <!-- Garis -->
    <hr class="sidebar-divider my-0">

    <!-- Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <!-- Website Management -->
    <div class="sidebar-heading">Website Management</div>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.homepage') }}">
            <i class="fas fa-fw fa-home"></i>
            <span>Home Page</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.tentang-kami') }}">
            <i class="fas fa-fw fa-building"></i>
            <span>Tentang Kami</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.produk-layanan') }}">
            <i class="fas fa-fw fa-th-large"></i>
            <span>Produk & Layanan</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.testimoni') }}">
            <i class="fas fa-fw fa-star"></i>
            <span>Testimoni</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="index.html">
            <i class="fas fa-fw fa-users"></i>
            <span>Tim Kami</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <!-- Meeting Management -->
    <div class="sidebar-heading">Meeting Management</div>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.meetings') }}">
            <i class="fas fa-fw fa-user-clock"></i>
            <span>Meeting Requests</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.calendar') }}">
            <i class="fas fa-fw fa-calendar-alt"></i>
            <span>Calendar</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <!-- Contact Management -->
    <div class="sidebar-heading">Contact Management</div>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.contacts') }}">
            <i class="fas fa-fw fa-address-card"></i>
            <span>Contact Messages</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <!-- Management Users -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.media') }}">
            <i class="fas fa-fw fa-photo-video"></i>
            <span>Media</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.manage.user') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>Users</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.manage.admin') }}">
            <i class="fas fa-fw fa-cog"></i>
            <span>Admin Users</span>
        </a>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>