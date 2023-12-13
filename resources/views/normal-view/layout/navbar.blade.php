<nav class="navbar navbar-expand-lg static-top shadow-lg sticky-top" id="navbar">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="/images/icon.png" alt="Grocery Store" height="50">
        </a>
        <a class="navbar-brand" href="#">
            <h3 class="text-white" style="font-family: sans-serif"><strong>Grocery Store</strong></h3>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto gap-3">
                <li class="nav-item">
                    <a class="nav-link text-white" href="/"><i class="far fa-store"></i> Grocery Items</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="/about-us"><i class="far fa-light fa-users"></i> About
                        Us</a>
                </li>
                @role('User')
                    @auth
                        <li class="nav-item position-relative">
                            <a class="nav-link text-white" href="/carts"><i class="far fa-cart-shopping"></i> Shopping
                                Cart<span class="position-absolute top-0 badge rounded-pill bg-warning">
                                    {{ auth()->user()->carts()->count() }}
                                </span></a>
                        </li>
                    @endauth
                @endrole
                <li class="nav-item dropdown">
                    <a class="@guest btn border bg-primary w-100 text-white @endguest" href="#"
                        id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        @auth
                            <img class="rounded-circle"
                                src="{{ Auth::user()->profile_image === null && Auth::user()->gender === 'Male'
                                    ? url('images/profile-image.png')
                                    : (Auth::user()->profile_image === null && Auth::user()->gender === 'Female'
                                        ? url('images/profile-image2.png')
                                        : Storage::url(Auth::user()->profile_image)) }}"
                                style="width: 40px; height: 40px;" alt="">
                        @else
                            <i class="far fa-store"></i> Go shopping
                        @endauth
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        @auth
                            @role('Admin')
                                <li><a class="dropdown-item text-white" href="/admin/dashboard"><i class="far fa-arrow-up"></i>
                                        Admin Page</a>
                                </li>
                            @endrole
                            <li><a class="dropdown-item text-white" href="#">
                                    {{ auth()->user()->lname }}, {{ auth()->user()->fname }}</a>
                            </li>
                            @role('User')
                                <li class="position-relative">
                                    <a class="dropdown-item text-white" href="/orders">
                                        Shopping
                                        Orders<span class="position-absolute top-0 badge rounded-pill bg-info">
                                            {{ auth()->user()->orders()->count() }}
                                        </span>
                                    </a>
                                </li>
                            @endrole
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item text-white" href="#" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    Logout</a>
                            </li>
                        @else
                            <li><a class="dropdown-item text-white" href="/login">
                                    Login</a>
                            </li>
                            <li><a class="dropdown-item text-white" href="/register">
                                    Register</a>
                            </li>
                        @endauth
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>


<style>
    #navbar {
        background: #7386D5;
    }

    .dropdown-menu {
        background: #7386D5;
    }

    .dropdown-item:hover {
        background-color: #7beafe19;
    }

    #navbarDropdown {
        filter: drop-shadow(12px 12px 7px rgba(7, 29, 99, 0.7));
    }

    .navbar-brand img {
        filter: drop-shadow(12px 12px 7px rgba(29, 74, 85, 0.7));
    }
</style>
