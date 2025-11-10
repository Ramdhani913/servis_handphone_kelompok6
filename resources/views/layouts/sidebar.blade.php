<<<<<<< HEAD
<!-- partial:partials/_sidebar.blade.php -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
    <a class="sidebar-brand brand-logo" href="{{ url('/') }}">
      <img src="{{ asset('assets/images/logo.svg') }}" alt="logo" />
    </a>
    <a class="sidebar-brand brand-logo-mini" href="{{ url('/') }}">
      <img src="{{ asset('assets/images/logo-mini.svg') }}" alt="logo" />
    </a>
  </div>

  <ul class="nav">
    <!-- Profile -->
    <li class="nav-item profile">
      <div class="profile-desc">
        <div class="profile-pic">
          <div class="count-indicator">
            <img class="img-xs rounded-circle" src="{{ asset('assets/images/faces/face15.jpg') }}" alt="profile">
            <span class="count bg-success"></span>
          </div>
          <div class="profile-name">
            <h5 class="mb-0 font-weight-normal">Henry Klein</h5>
            <span>Gold Member</span>
          </div>
        </div>
      </div>
    </li>

    <!-- Navigation -->
    <li class="nav-item nav-category"><span class="nav-link">Navigation</span></li>
    <li class="nav-item menu-items">
      <a class="nav-link" href="{{ url('/dashboard') }}">
        <span class="menu-icon"><i class="mdi mdi-view-dashboard-outline"></i></span>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>

    <!-- Main Data -->
    <li class="nav-item nav-category"><span class="nav-link">Main Data</span></li>
    <li class="nav-item menu-items">
      <a class="nav-link" href="{{ url('/users') }}">
        <span class="menu-icon"><i class="mdi mdi-account-outline"></i></span>
        <span class="menu-title">Users</span>
      </a>
    </li>
    <li class="nav-item menu-items">
      <a class="nav-link" href="{{ url('/handphones') }}">
        <span class="menu-icon"><i class="mdi mdi-cellphone"></i></span>
        <span class="menu-title">Handphone</span>
      </a>
    </li>
    <li class="nav-item menu-items">
      <a class="nav-link" href="{{ url('/serviceitems') }}">
        <span class="menu-icon"><i class="mdi mdi-wrench-outline"></i></span>
        <span class="menu-title">Service Items</span>
      </a>
    </li>
    <li class="nav-item menu-items">
      <a class="nav-link" href="{{ url('/customers') }}">
        <span class="menu-icon"><i class="mdi mdi-account-group-outline"></i></span>
        <span class="menu-title">Customer</span>
      </a>
    </li>

    <!-- Menu Service -->
    <li class="nav-item nav-category"><span class="nav-link">Menu Service</span></li>
    <li class="nav-item menu-items">
      <a class="nav-link" href="{{ url('/services') }}">
        <span class="menu-icon"><i class="mdi mdi-tools"></i></span>
        <span class="menu-title">Services</span>
      </a>
    </li>
    <li class="nav-item menu-items">
      <a class="nav-link" href="{{ url('/payments') }}">
        <span class="menu-icon"><i class="mdi mdi-credit-card-outline"></i></span>
        <span class="menu-title">Payment</span>
      </a>
    </li>
  </ul>
</nav>
=======
<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <style>
    /* === Sidebar Style FixPro === */
    .sidebar {
      width: 260px;
      background-color: #0f111a;
      color: #cfd2dc;
      min-height: 100vh;
      padding: 25px 20px;
      display: flex;
      flex-direction: column;
      font-family: 'Poppins', sans-serif;
      border-right: 1px solid #1e2230;
    }

    .sidebar-logo {
      color: #fff;
      font-size: 22px;
      font-weight: 700;
      margin-bottom: 25px;
    }

    .profile {
      display: flex;
      align-items: center;
      margin-bottom: 40px;
    }

    .profile-img {
      width: 45px;
      height: 45px;
      border-radius: 50%;
      margin-right: 12px;
      border: 2px solid #00baff;
    }

    .profile-info h5 {
      color: #fff;
      margin: 0;
      font-size: 16px;
    }

    .profile-info span {
      font-size: 12px;
      color: #8f9bb3;
    }

    .sidebar-menu {
      list-style: none;
      padding: 0;
      margin: 0;
      flex-grow: 1;
    }

    .menu-category {
      color: #7b8196;
      font-size: 12px;
      font-weight: 600;
      text-transform: uppercase;
      margin: 20px 0 10px;
    }

    .menu-item {
      display: flex;
      align-items: center;
      padding: 10px 15px;
      border-radius: 8px;
      color: #cfd2dc;
      cursor: pointer;
      transition: background 0.2s, color 0.2s;
    }

    .menu-item i {
      font-size: 20px;
      margin-right: 12px;
    }

    .menu-item:hover,
    .menu-item.active {
      background-color: #1a1c26;
      color: #00baff;
    }

    .menu-item.active i {
      color: #00baff;
    }

    /* Scrollbar halus untuk sidebar */
    #sidebar::-webkit-scrollbar {
      width: 6px;
    }

    #sidebar::-webkit-scrollbar-thumb {
      background-color: #2a2c38;
      border-radius: 3px;
    }

    #sidebar::-webkit-scrollbar-thumb:hover {
      background-color: #3c3f52;
    }
  </style>

  <!-- === Sidebar Content === -->
  <div class="sidebar-header">
    <h2 class="sidebar-logo">FixPro</h2>
    <div class="profile">
      <img src="assets/images/faces/face15.jpg" alt="profile" class="profile-img">
      <div class="profile-info">
        <h5>Henry Klein</h5>
        <span>Gold Member</span>
      </div>
    </div>
  </div>

  <ul class="sidebar-menu">
    <li class="menu-category">Navigation</li>
    <li class="menu-item active">
      <i class="mdi mdi-view-dashboard-outline"></i>
      <span>Dashboard</span>
    </li>

    <li class="menu-category">Main Data</li>
    <li class="menu-item">
      <i class="mdi mdi-account-outline"></i>
      <span>User</span>
    </li>
    <li class="menu-item">
      <i class="mdi mdi-cellphone"></i>
      <span>Handphone</span>
    </li>
    <li class="menu-item">
      <i class="mdi mdi-wrench-outline"></i>
      <span>Service Items</span>
    </li>
    <li class="menu-item">
      <i class="mdi mdi-account-group-outline"></i>
      <span>Customer</span>
    </li>

    <li class="menu-category">Menu Service</li>
    <li class="menu-item">
      <i class="mdi mdi-tools"></i>
      <span>Services</span>
    </li>
    <li class="menu-item">
      <i class="mdi mdi-credit-card-outline"></i>
      <span>Payment</span>
    </li>
  </ul>
</nav>

>>>>>>> 0cdab11c69774ac7f57a244149b56b3da6621235
