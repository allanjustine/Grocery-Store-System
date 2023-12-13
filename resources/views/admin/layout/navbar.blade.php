<nav id="sidebar">
    <div class="sidebar-header">
        <h3><i class="far fa-store"></i> Grocery Store</h3>
    </div>

    <ul class="list-unstyled components">
        <li class="{{ 'admin/dashboard' == request()->path() ? 'active' : '' }}">
            <a href="/admin/dashboard"><i class="p-2 far fa-gauge"></i> Dashboard</a>
        </li>
        <li class="{{ 'admin/categories' == request()->path() ? 'active' : '' }}">
            <a href="/admin/categories"><i class="p-2 far fa-list"></i> Categories</a>
        </li>
        <li class="{{ 'admin/products' == request()->path() ? 'active' : '' }}">
            <a href="/admin/products"><i class="p-2 far fa-box"></i> Products</a>
        </li>
        <li class="{{ 'admin/orders' == request()->path() ? 'active' : '' }}">
            <a href="/admin/orders"><i class="p-2 far fa-store"></i> Orders</a>
        </li>
        <li class="{{ 'admin/users' == request()->path() ? 'active' : '' }}">
            <a href="/admin/users"><i class="p-2 far fa-users"></i> Users</a>
        </li>
        <li class="{{ 'admin/logs' == request()->path() ? 'active' : '' }}">
            <a href="/admin/logs"><i class="p-2 far fa-chart-line"></i> Logs</a>
        </li>
    </ul>

    <ul class="list-unstyled CTAs">

        <li>
            <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Menu</a>
            <ul class="collapse list-unstyled" id="homeSubmenu">
                <li>
                    <a href="#"><img class="rounded-circle"
                            src="{{ Auth::user()->profile_image === null && Auth::user()->gender === 'Male'
                                ? url('images/profile-image.png')
                                : (Auth::user()->profile_image === null && Auth::user()->gender === 'Female'
                                    ? url('images/profile-image2.png')
                                    : Storage::url(Auth::user()->profile_image)) }}"
                            style="width: 40px; height: 40px;" alt="">{{ auth()->user()->lname }},
                        {{ auth()->user()->fname }}</a>
                </li>
                <li>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="far fa-arrow-right-from-bracket"></i> Logout</a>
                </li>
        </li>
    </ul>
    </li>
    </ul>
</nav>
