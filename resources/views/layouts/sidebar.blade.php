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

