<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  
  <div class="sidebar-logo">
    <a href="{{ route('admin.home') }}" class="">
      <img src="{{ asset('admin-item/dist/img/sheba.png') }}" alt="sheba Logo" class="img-fluid mt-xs-5" style="opacity: .8"> 
    </a>
  </div>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ asset('admin-item/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">Alexander Pierce</a>
      </div>
    </div> --}}

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="{{ route('dashboard.index') }}" class="nav-link ">
            <i class="fas fa-tachometer-alt"></i>
            <p> Dashboard</p>
          </a>
        </li>
        
        @canany(['Sales-Funnel-Create', 'Sales-Funnel-Edit', 'Sales-Funnel-Delete'])
        <li class="nav-item">
          <a href="{{ route('sales-funnel.index') }}" class="nav-link ">
            <i class="fas fa-filter"></i>
            <p> Sales Funnel</p>
          </a>
        </li>
        @endcanany
        @can('Reports-List', Auth::user())
        <li class="nav-item ">
          <a href="#" class="nav-link ">
            <i class="fab fa-elementor"></i>
            <p>
                Reports
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview ml-3 sub-menu">
            <li class="nav-item">
              <a href="{{ route('secure-project.index') }}" class="nav-link">
                <i class="fas fa-circle nav-icon"></i>
                <p>Secured project</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('delete-project.index') }}" class="nav-link">
                <i class="fas fa-circle nav-icon"></i>
                <p>Deleted Project</p>
              </a>
            </li>
          </ul>  
        </li>
        @endcan
        @canany(['Master-Data-Create', 'Master-Data-Edit', 'Master-Data-Delete'])
        <li class="nav-item ">
          <a href="#" class="nav-link ">
            <i class="fas fa-database"></i>
            <p>
                Master Data
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview ml-3 sub-menu">
            <li class="nav-item">
              <a href="{{ route('solution.index') }}" class="nav-link">
                <i class="fas fa-circle nav-icon"></i>
                <p>Solution</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ route('industry.index') }}" class="nav-link">
                <i class="fas fa-circle nav-icon"></i>
                <p>Industry</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ route('client.index') }}" class="nav-link">
                <i class="fas fa-circle nav-icon"></i>
                <p>Client</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ route('owner.index') }}" class="nav-link">
                <i class="fas fa-circle nav-icon"></i>
                <p>Owner</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ route('partner.index') }}" class="nav-link">
                <i class="fas fa-circle nav-icon"></i>
                <p>Partner</p>
              </a>
            </li>
          </ul>  
        </li>
        @endcanany
        @canany(['User-Create', 'User-Edit', 'User-Delete'])
        <li class="nav-item">
          <a href="{{ route('user.index') }}" class="nav-link ">
            <i class="fas fa-users-cog"></i>
            <p> User Management</p>
          </a>
        </li>
        @endcanany
        @canany(['Role-Create', 'Role-Edit', 'Role-Delete'])
        <li class="nav-item">
          <a href="{{ route('role.index') }}" class="nav-link ">
            <i class="fas fa-user-tag"></i>
            <p> Role Management</p>
          </a>
        </li>
        @endcanany
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>