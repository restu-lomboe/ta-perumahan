<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
        <div class="sidebar-brand-icon">
            <i class=""><img src="{{ asset('assets/img/logo-rumah.png') }}" alt="" width="50" height="50"
                style="object-fit: contain;"></i>
        </div>
        <div class="sidebar-brand-text mx-3">PT.PRIMA INTI NUSA</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item @if (\Route::current()->getName() == 'admin.dashboard') active @endif">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>
    @if (auth()->user()->role_id == 3)
        <li class="nav-item @if (\Route::current()->getName() == 'admin.pemesanan') active @endif">
            <a class="nav-link" href="{{ route('admin.pemesanan') }}">
                <i class="far fa-calendar-check"></i>
                <span>Pemesanan</span></a>
        </li>
    @else
        @if (auth()->user()->role_id == 2)
            <li class="nav-item @if (\Route::current()->getName() == 'admin.perumahan') active @endif">
                <a class="nav-link" href="{{ route('admin.perumahan') }}">
                    <i class="fas fa-home"></i>
                    <span>Perumahan</span></a>
            </li>
            <li class="nav-item @if (\Route::current()->getName() == 'admin.report') active @endif">
                <a class="nav-link" href="{{ route('admin.report') }}">
                    <i class="fas fa-print"></i>
                    <span>Report</span></a>
            </li>
        @else
            <li class="nav-item @if (\Route::current()->getName() == 'admin.pemesanan') active @endif">
                <a class="nav-link" href="{{ route('admin.pemesanan') }}">
                    <i class="far fa-calendar-check"></i>
                    <span>Pemesanan</span></a>
            </li>
            <li class="nav-item @if (\Route::current()->getName() == 'admin.perumahan') active @endif">
                <a class="nav-link" href="{{ route('admin.perumahan') }}">
                    <i class="fas fa-home"></i>
                    <span>Perumahan</span></a>
            </li>
            <li class="nav-item @if (\Route::current()->getName() == 'admin.user.management') active @endif">
                <a class="nav-link" href="{{ route('admin.user.management') }}">
                    <i class="fas fa-users-cog"></i>
                    <span>User Management</span></a>
            </li>
        @endif

    @endif



    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
