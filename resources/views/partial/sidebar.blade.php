<aside class="main-sidebar sidebar-dark-warning elevation-4" style="background-color: #f9e79f;">
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" class="brand-link" style="background-color: #f4d03f; color: black; text-transform: uppercase;">
        <img src="{{ asset('logo.png') }}" alt="FRMS Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">FRMS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="{{ url('dashboard') }}" class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" style="color: black; text-transform: uppercase;">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Franchise Manager Role -->
                @if (Auth::user()->role === 'franchise_manager')
                    <li class="nav-item">
                        <a href="{{ url('franchises') }}" class="nav-link {{ Request::is('franchises') ? 'active' : '' }}" style="color: black; text-transform: uppercase;">
                            <i class="nav-icon fas fa-store"></i>
                            <p>Franchises</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('franchise-applications') }}" class="nav-link {{ Request::is('franchise-applications') ? 'active' : '' }}" style="color: black; text-transform: uppercase;">
                            <i class="nav-icon fas fa-file-alt"></i>
                            <p>Applications</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('contracts') }}" class="nav-link {{ Request::is('contracts') ? 'active' : '' }}" style="color: black; text-transform: uppercase;">
                            <i class="nav-icon fas fa-file-signature"></i>
                            <p>Contracts</p>
                        </a>
                    </li>
                @endif

                <!-- Accounting Role -->
                @if (Auth::user()->role === 'accounting')
                    <li class="nav-item">
                        <a href="{{ url('payments') }}" class="nav-link {{ Request::is('payments') ? 'active' : '' }}" style="color: black; text-transform: uppercase;">
                            <i class="nav-icon fas fa-money-bill"></i>
                            <p>Payments</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('billing') }}" class="nav-link {{ Request::is('billing') ? 'active' : '' }}" style="color: black; text-transform: uppercase;">
                            <i class="nav-icon fas fa-file-invoice-dollar"></i>
                            <p>Billing</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('financial-reports') }}" class="nav-link {{ Request::is('financial-reports') ? 'active' : '' }}" style="color: black; text-transform: uppercase;">
                            <i class="nav-icon fas fa-chart-line"></i>
                            <p>Financial Reports</p>
                        </a>
                    </li>
                @endif

                <!-- Admin Role -->
                @if (Auth::user()->role === 'admin')
                    <li class="nav-item">
                        <a href="{{ url('users') }}" class="nav-link {{ Request::is('users') ? 'active' : '' }}" style="color: black; text-transform: uppercase;">
                            <i class="nav-icon fas fa-user-shield"></i>
                            <p>User Management</p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview {{ Request::is('settings/*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link" style="color: black; text-transform: uppercase;">
                            <i class="nav-icon fas fa-cogs"></i>
                            <p>
                                System Settings
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ url('settings/general') }}" class="nav-link {{ Request::is('settings/general') ? 'active' : '' }}" style="color: black; text-transform: uppercase;">
                                    <i class="fas fa-wrench nav-icon"></i>
                                    <p>General Settings</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('settings/roles') }}" class="nav-link {{ Request::is('settings/roles') ? 'active' : '' }}" style="color: black; text-transform: uppercase;">
                                    <i class="fas fa-users-cog nav-icon"></i>
                                    <p>Manage Roles</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
