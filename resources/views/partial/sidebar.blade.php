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
                    <li class="nav-item has-treeview {{ Request::is('franchise/*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link" style="color: black; text-transform: uppercase;">
                            <i class="nav-icon fas fa-store"></i>
                            <p>
                                Franchise
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ url('franchise/add') }}" class="nav-link {{ Request::is('franchise/add') ? 'active' : '' }}" style="color: black;">
                                    <i class="fas fa-plus nav-icon"></i>
                                    <p>Add Franchise</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('franchise/archived') }}" class="nav-link {{ Request::is('franchise/archived') ? 'active' : '' }}" style="color: black;">
                                    <i class="fas fa-archive nav-icon"></i>
                                    <p>Archived Franchise</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('franchise/manage') }}" class="nav-link {{ Request::is('franchise/manage') ? 'active' : '' }}" style="color: black;">
                                    <i class="fas fa-tasks nav-icon"></i>
                                    <p>Manage Franchise</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('franchise/variants') }}" class="nav-link {{ Request::is('franchise/variants') ? 'active' : '' }}" style="color: black;">
                                    <i class="fas fa-tags nav-icon"></i>
                                    <p>Franchise Variants</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                <!-- QMT Section -->
                <li class="nav-item has-treeview {{ Request::is('qmt/*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link" style="color: black; text-transform: uppercase;">
                        <i class="nav-icon fas fa-check-circle"></i>
                        <p>
                            QMT
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('qmt/reports') }}" class="nav-link {{ Request::is('qmt/reports') ? 'active' : '' }}" style="color: black;">
                                <i class="fas fa-file-alt nav-icon"></i>
                                <p>Quality Reports</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('qmt/inspections') }}" class="nav-link {{ Request::is('qmt/inspections') ? 'active' : '' }}" style="color: black;">
                                <i class="fas fa-search nav-icon"></i>
                                <p>Site Inspections</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('qmt/compliance') }}" class="nav-link {{ Request::is('qmt/compliance') ? 'active' : '' }}" style="color: black;">
                                <i class="fas fa-exclamation-triangle nav-icon"></i>
                                <p>Compliance</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('qmt/schedule') }}" class="nav-link {{ Request::is('qmt/schedule') ? 'active' : '' }}" style="color: black;">
                                <i class="fas fa-calendar-alt nav-icon"></i>
                                <p>QMT Schedule</p>
                            </a>
                        </li>
                    </ul>
                </li>

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
