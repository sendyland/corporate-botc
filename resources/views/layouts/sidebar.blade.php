<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('home') ? '' : 'collapsed' }}" href="{{ route('home') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->
        @can('product-list')
            <li class="nav-item ">
                <a class="nav-link {{ request()->routeIs('products.index') ? '' : 'collapsed' }}"
                    href="{{ route('products.index') }}">
                    <i class="bi bi-file-lock"></i>
                    <span>Products</span>
                </a>
            </li>
        @endcan
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
                    <span>User</span>
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

    </ul>

</aside><!-- End Sidebar-->
