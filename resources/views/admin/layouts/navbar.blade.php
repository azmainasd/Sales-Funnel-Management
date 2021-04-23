<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light text-white">
  
  <div class="row" style="width: 100%">
    <div class="col-md-6 nav-title">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-white" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item align-self-center pt-2">
          <p class="">SHEBA - Sales Funnel Management</p>
        </li>
      </ul>
    </div>

    <div class="col-md-4 auth-user-name text-right">
      <h6 class="pt-2">
        Welcome&nbsp;&nbsp;&nbsp;{{ Auth::user()->name}}
      </h6>
    </div>

    <div class="col-md-2 user-logout mt-2 text-right">
            <a class="logout-btn " href="{{ route('logout') }}" onclick="
                    event.preventDefault();
                        document.getElementById('logout-form').submit();"
                        title="Log out">
              <i class="fas fa-sign-out-alt fa-x"></i>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
            </form>    
    </div>
  </div>
<!-- Left navbar links -->    
</nav>
  <!-- /.navbar -->