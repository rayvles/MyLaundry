<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('adminlte') }}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('adminlte') }}/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">

            <a href="#" class="d-block">{{ Auth::user()->name ?? '' }}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
            data-accordion="false">
            <li class="nav-header">ADMIN</li>
            <li class="nav-item">
                <a href="/admin/house" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="/admin/outlet" class="nav-link">
                    <i class="nav-icon fas fa-store"></i>
                    <p>
                        Manage Outlet
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="/admin/penjemputanlaundry" class="nav-link">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        Penjemputan Laundry
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="/admin/barang" class="nav-link">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        Data Barang
                    </p>
                </a>
            </li>
            @can('manage-user')
            <li class="nav-item">
                <a href="/admin/users" class="nav-link">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        Register User
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="/admin/baranginventaris" class="nav-link">
                    <i class="nav-icon fas fa-store"></i>
                    <p>
                        Item Inventaris
                    </p>
                </a>
            </li>
            @endcan
            <li class="nav-item">
                <a href="/admin/simulasi" class="nav-link">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        Simulasi Programan dasar 1
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="/admin/simulasikedua" class="nav-link">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        Simulasi Programan dasar 2
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="/admin/simulasiketiga" class="nav-link">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        Simulasi Programan dasar 3
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="/admin/simulasikeempat" class="nav-link">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        Simulasi Programan dasar 4
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="/admin/ujikom" class="nav-link">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        Programan Dasar Ujikom
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="/home" class="nav-link">
                    <i class="nav-icon fas fa-arrow-left"></i>
                    <p>
                        Kembali
                    </p>
                </a>
            </li>
            {{-- <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ asset('adminlte') }}/index.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Dashboard v1</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ asset('adminlte') }}/index2.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Dashboard v2</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ asset('adminlte') }}/index3.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Dashboard v3</p>
                        </a>
                    </li>
                </ul>
            </li> --}}
        </ul>
    </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
