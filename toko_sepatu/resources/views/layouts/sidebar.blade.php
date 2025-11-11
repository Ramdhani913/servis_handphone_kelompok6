<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
    <a class="sidebar-brand brand-logo" href="{{ route('dashboard') }}">
      <img src="{{ asset('assets/images/logo.svg') }}" alt="logo" />
    </a>
    <a class="sidebar-brand brand-logo-mini" href="{{ route('dashboard') }}">
      <img src="{{ asset('assets/images/logo-mini.svg') }}" alt="logo" />
    </a>
  </div>

  <ul class="nav">
    <!-- Profile Section -->
    <li class="nav-item profile">
      <div class="profile-desc">
        <div class="profile-pic">
          <div class="count-indicator">
            <img class="img-xs rounded-circle"
                 src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : asset('assets/images/faces/face1.jpg') }}"
                 alt="profile">
            <span class="count bg-success"></span>
          </div>
          <div class="profile-name">
            <h5 class="mb-0 font-weight-normal">{{ Auth::user()->name }}</h5>
            <span class="text-capitalize">{{ Auth::user()->role }}</span>
          </div>
        </div>
      </div>
    </li>

    <!-- Navigation -->
    <li class="nav-item nav-category"><span class="nav-link">Navigation</span></li>

    <!-- Dashboard -->
    <li class="nav-item menu-items {{ request()->is('/') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('dashboard') }}">
        <span class="menu-icon"><i class="mdi mdi-view-dashboard-outline"></i></span>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>

    <!-- Main Data -->
    <li class="nav-item nav-category"><span class="nav-link">Main Data</span></li>

    <li class="nav-item menu-items {{ request()->is('users*') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('users.index') }}">
        <span class="menu-icon"><i class="mdi mdi-account-outline"></i></span>
        <span class="menu-title">Users</span>
      </a>
    </li>

    <li class="nav-item menu-items {{ request()->is('handphones*') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('handphones.index') }}">
        <span class="menu-icon"><i class="mdi mdi-cellphone"></i></span>
        <span class="menu-title">Handphone</span>
      </a>
    </li>

    <li class="nav-item menu-items {{ request()->is('serviceitems*') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('serviceitems.index') }}">
        <span class="menu-icon"><i class="mdi mdi-tools"></i></span>
        <span class="menu-title">Service Items</span>
      </a>
    </li>

    <!-- Menu Service -->
    <li class="nav-item nav-category"><span class="nav-link">Menu Service</span></li>

    <li class="nav-item menu-items {{ request()->is('services*') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('services.index') }}">
        <span class="menu-icon"><i class="mdi mdi-wrench-outline"></i></span>
        <span class="menu-title">Services</span>
      </a>
    </li>

  </ul>
</nav>
