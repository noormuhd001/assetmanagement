<aside class="main-sidebar sidebar-dark-primary elevation-4 sidebar-visible">
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">AssetTrack</span>
    </a>
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
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            @auth
                @if (Auth::user()->role == 1)
                    <li class="nav-item menu-open">
                        <a href="{{ route('dashboard') }}"
                            class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-home"></i>
                            <p>Home</p>
                        </a>
                    </li>
                @else
                    <li class="nav-item menu-open">
                        <a href="{{ route('edashboard') }}"
                            class="nav-link {{ request()->routeIs('edashboard') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-home"></i>
                            <p>Home</p>
                        </a>
                    </li>
                @endif
            @endauth
            @auth
                @if (Auth::user()->role == 1)
                    <li class="nav-item menu-open">
                        <a href="{{ route('employeedetails') }}"
                            class="nav-link {{ request()->routeIs('employeedetails', 'employee.create', 'employee.edit', 'employee.details') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Employee details
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('employeedetails') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>List Employee</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('employee.create') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Add Employee</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item menu-open">
                        <a href="{{ route('asset.index') }}"
                            class="nav-link {{ request()->routeIs('asset.index', 'asset.create', 'asset.edit') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>
                                Asset Management
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('asset.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>List Asset</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('asset.create') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Add Asset</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Asset Category</p>
                                </a>
                            </li>
                        </ul>
                    @else
                    <li class="nav-item menu-open">
                        <a href="{{ route('asset.list') }}"
                            class="nav-link {{ request()->routeIs('asset.list') ? 'active' : '' }}">
                            <i class="fa fa-desktop" aria-hidden="true"></i>
                            <p>
                                Asset
                            </p>
                        </a>
                    </li>
                @endif
            @endauth
            <li class="nav-item menu-open">
                <a href=""
                    class="nav-link {{ request()->routeIs('ticket.raise', 'ticket.display', 'ticket.admindisplay', 'ticket.adminshow', 'ticket.show') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-ticket-alt"></i>
                    <p>
                        Tickets
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    @auth
                        @if (Auth::user()->role == 1)
                            <li class="nav-item">
                                <a href="{{ route('ticket.admindisplay') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Ticket Status A</p>
                                </a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a href="{{ route('ticket.raise') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Raise Ticket</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('ticket.display') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Ticket Status</p>
                                </a>
                            </li>
                        @endif
                    @endauth
                </ul>
            </li>
            <li class="nav-item menu-open">
                <a href="{{ route('logout') }}" class="nav-link {{ request()->is('logout') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-sign-out-alt"></i>
                    <p>
                        Logout
                    </p>
                </a>
            </li>
        </ul>
    </nav>
    </div>
</aside>
