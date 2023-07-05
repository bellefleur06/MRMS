<aside class="main-sidebar sidebar-light-primary elevation-2" style="background-color: rgba(62,88,113);">
    <!-- Brand Logo -->
    <a href="{{ url('/0/dashboard') }}" class="brand-link animated swing">
        <img src="{{ asset('asset/img/logo.png') }}" alt="DSMS Logo" width="200">
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ url('/0/dashboard') }}" class="nav-link {{ $active == 'dashboard' ? 'active' : '' }}">
                        <i class="nav-icon fa fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/0/patient') }}" class="nav-link {{ $active == 'patient' ? 'active' : '' }}">
                        <i class="nav-icon fa fa-hospital-user"></i>
                        <p>
                            Patient
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/0/prenatal') }}" class="nav-link {{ $active == 'prenatal' ? 'active' : '' }}">
                        <i class="nav-icon fa fa-child"></i>
                        <p>
                            Prenatal Records
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/0/child') }}" class="nav-link {{ $active == 'child' ? 'active' : '' }}">
                        <i class="nav-icon fa fa-baby"></i>
                        <p>
                            Child Records
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/0/immunization') }}" class="nav-link {{ $active == 'immunization' ? 'active' : '' }}">
                        <i class="nav-icon fa fa-syringe"></i>
                        <p>
                            Immunization Records
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-chart-pie"></i>
                        <p>
                            Reports
                        </p>
                        <i class="right fas fa-angle-left"></i>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('/0/report/prenatal') }}" class="nav-link {{ $active == 'prenatalReport' ? 'active' : '' }}">
                                <i class="nav-icon far fa-circle"></i>
                                <p>Prenatal Per Month</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/0/report/vaccine') }}" class="nav-link {{ $active == 'vaccineReport' ? 'active' : '' }}">
                                <i class="nav-icon far fa-circle"></i>
                                <p>Vaccinated Children</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>
