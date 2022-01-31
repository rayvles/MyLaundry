<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
      <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
          <a href="/" class="nav-link">Home</a>
      </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
              <img src="https://picsum.photos/200/200" class="img-circle" alt="User Image" style="width: 30px">
              {{-- {{ Auth::user()->name ?? '-' }} --}}
              <span class="ml-1"></span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              <a href="#" class="dropdown-item">
                  <i class="fas fa-user mr-2"></i> Edit Profile
              </a>
              {{-- onclick="logoutHandler()" --}}
              <button href="#" class="dropdown-item" >
                  <i class="fas fa-sign-out-alt mr-2"></i> Logout
              </button>
              <form id="logoutForm" action="/logout" method="POST" class="d-inline">
                  @csrf
              </form>
          </div>
      </li>
  </ul>
</nav>
