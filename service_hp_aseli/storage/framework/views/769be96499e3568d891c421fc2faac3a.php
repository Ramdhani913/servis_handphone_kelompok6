<!-- partial:partials/_sidebar.blade.php -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
    <a class="sidebar-brand brand-logo" href="<?php echo e(url('/')); ?>">
      <img src="<?php echo e(asset('assets/images/logo.svg')); ?>" alt="logo" />
    </a>
    <a class="sidebar-brand brand-logo-mini" href="<?php echo e(url('/')); ?>">
      <img src="<?php echo e(asset('assets/images/logo-mini.svg')); ?>" alt="logo" />
    </a>
  </div>

  <ul class="nav">
    <!-- Profile -->
    <li class="nav-item profile">
      <div class="profile-desc">
        <div class="profile-pic">
          <div class="count-indicator">
            <img class="img-xs rounded-circle" src="<?php echo e(asset('assets/images/faces/face15.jpg')); ?>" alt="profile">
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
      <a class="nav-link" href="<?php echo e(url('/dashboard')); ?>">
        <span class="menu-icon"><i class="mdi mdi-view-dashboard-outline"></i></span>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>

    <!-- Main Data -->
    <li class="nav-item nav-category"><span class="nav-link">Main Data</span></li>
    <li class="nav-item menu-items">
      <a class="nav-link" href="<?php echo e(url('/users')); ?>">
        <span class="menu-icon"><i class="mdi mdi-account-outline"></i></span>
        <span class="menu-title">Users</span>
      </a>
    </li>
    <li class="nav-item menu-items">
      <a class="nav-link" href="<?php echo e(url('/handphones')); ?>">
        <span class="menu-icon"><i class="mdi mdi-cellphone"></i></span>
        <span class="menu-title">Handphone</span>
      </a>
    </li>
    <li class="nav-item menu-items">
      <a class="nav-link" href="<?php echo e(url('/serviceitems')); ?>">
        <span class="menu-icon"><i class="mdi mdi-wrench-outline"></i></span>
        <span class="menu-title">Service Items</span>
      </a>
    </li>
    <li class="nav-item menu-items">
      <a class="nav-link" href="<?php echo e(url('/customers')); ?>">
        <span class="menu-icon"><i class="mdi mdi-account-group-outline"></i></span>
        <span class="menu-title">Customer</span>
      </a>
    </li>

    <!-- Menu Service -->
    <li class="nav-item nav-category"><span class="nav-link">Menu Service</span></li>
    <li class="nav-item menu-items">
      <a class="nav-link" href="<?php echo e(url('/services')); ?>">
        <span class="menu-icon"><i class="mdi mdi-tools"></i></span>
        <span class="menu-title">Services</span>
      </a>
    </li>
    <li class="nav-item menu-items">
      <a class="nav-link" href="<?php echo e(url('/payments')); ?>">
        <span class="menu-icon"><i class="mdi mdi-credit-card-outline"></i></span>
        <span class="menu-title">Payment</span>
      </a>
    </li>
  </ul>
</nav>
<?php /**PATH C:\Users\rendr\Desktop\desktop\service_hp_aseli\resources\views\layouts\sidebar.blade.php ENDPATH**/ ?>