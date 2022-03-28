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
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
            data-accordion="false">
            <li class="nav-item">
                <a href="/outlet/{{ $outlet->id }}" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
            </li>
            @can('manage-user')
            <li class="nav-item">
                <a href="/outlet/{{ $outlet->id }}/paket" class="nav-link">
                    <i class="nav-icon fas fa-shopping-basket"></i>
                    <p>
                        Paket Laundry
                    </p>
                </a>
            </li>
            @endcan
            @can('register-member')
            <li class="nav-item">
                <a href="/outlet/{{ $outlet->id }}/member" class="nav-link">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        Member
                    </p>
                </a>
            </li>
            @endcan
            @can('manage-user')

            @endcan



            @can('register-member')
            <li class="nav-header">TRANSACTION</li>
            <li class="nav-item">
                <a href="/outlet/{{ $outlet->id }}/transaksi" class="nav-link">
                    <i class="nav-icon fas fa-cash-register"></i>
                    <p>
                        Transaksi
                    </p>
                </a>
            </li>
            @endcan

            @can('manage-laporan')
            <li class="nav-header">TRANSAKSI</li>
            <li class="nav-item">
                <a href="/outlet/{{ $outlet->id }}/report/" class="nav-link">
                    <i class="nav-icon fas fa-file"></i>
                    <p>
                        Laporan
                    </p>
                </a>
            </li>
            @endcan
            <li class="nav-header">Halaman Sebelumnya</li>
            <li class="nav-item">
                <a href="/admin" class="nav-link">
                    <i class="nav-icon fas fa-arrow-left"></i>
                    <p>
                        Kembali
                    </p>
                </a>
            </li>
        </ul>
    </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
