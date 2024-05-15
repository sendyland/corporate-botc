<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
        @can('dashboard-admin')
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('home') ? '' : 'collapsed' }}" href="{{ route('home') }}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>
        @endcan


        <li class="nav-item ">
            <a class="nav-link {{ request()->routeIs('profile.index') ? '' : 'collapsed' }}"
                href="{{ route('profile.index') }}">
                <i class="bi bi-person-check"></i>
                <span>My Profile</span>
            </a>
        </li><!-- End Dashboard Nav -->
        <li class="nav-item ">
            <a class="nav-link {{ request()->routeIs('employeds.index') ? '' : 'collapsed' }}"
                href="{{ route('employeds.index') }}">
                <i class="bi bi-people-fill"></i>
                <span>List Peserta</span>
            </a>
        </li>
        <li class="nav-item ">
            <a class="nav-link {{ request()->routeIs('courses.index') ? '' : 'collapsed' }}"
                href="{{ route('courses.index') }}">
                <i class="bi bi-boxes"></i>
                <span>Course</span>
            </a>
        </li>
        <li class="nav-item ">
            <a class="nav-link  {{ request()->routeIs('course-order.index') ? '' : 'collapsed' }}"
                href="{{ route('course-order.index') }}">
                <i class="bi bi-newspaper"></i>
                <span>Order Course</span>
            </a>
        </li>
        <li class="nav-item ">
            <a class="nav-link collapsed" href="{{ route('products.index') }}">
                <i class="bi bi-credit-card"></i>
                <span>Invoice</span>
            </a>
        </li>
        <li class="nav-item ">
            <a class="nav-link collapsed" target="_blank" href="https://learning.blueocean-tc.com/documentation/">
                <i class="bi bi-envelope-paper"></i>
                <span>E-Documentation</span>
            </a>
        </li>
        <li class="nav-item ">
            <a class="nav-link collapsed" target="_blank" href="https://info.blueocean-tc.com/">
                <i class="bi bi-card-checklist"></i>
                <span>Validasi Peserta</span>
            </a>
        </li>
        {{-- <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('home') ? '' : 'collapsed' }}" data-bs-target="#forms-nav"
                data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-text"></i><span>Forms</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="forms-elements.html">
                        <i class="bi bi-circle"></i><span>Form Elements</span>
                    </a>
                </li>

            </ul>
        </li><!-- End Forms Nav --> --}}

        @can('user-list')
            <li class="nav-heading">Administrator</li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('users.index') ? '' : 'collapsed' }}"
                    href="{{ route('users.index') }}">
                    <i class="bi bi-person"></i>
                    <span>List Company</span>
                </a>
            </li>
        @endcan

        @can('role-list')
            <li class="nav-item ">
                <a class="nav-link {{ request()->routeIs('roles.index') ? '' : 'collapsed' }}"
                    href="{{ route('roles.index') }}">
                    <i class="bi bi-file-lock"></i>
                    <span>Role</span>
                </a>
            </li>
        @endcan

        <li class="nav-item ">
            <a class="nav-link collapsed" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right"></i>
                {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
    </ul>

</aside><!-- End Sidebar-->
