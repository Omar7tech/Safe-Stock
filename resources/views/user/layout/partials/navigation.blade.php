<nav class="navbar bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" id="app-name" href="/"> {{ config('app.name') }} </a>
        <div class="d-flex align-items-center">

            <button id="themeToggleBtn" class="btn btn-outline me-2" onclick="toggleTheme()">
                <i id="themeToggleIcon" class="bi bi-moon"></i>
            </button>

            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
                aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

        </div>

        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">{{ auth()->user()->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route("user.home") }}">Home</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Products
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('products.index') }}">Show</a></li>
                            <li><a class="dropdown-item" href="{{ route('products.create') }}">Create Product</a>
                            </li>

                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="">Deleted</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Suppliers
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('supplier.index') }}">All</a></li>
                            <li><a class="dropdown-item" href="{{ route('supplier.create') }}">Create User</a></li>

                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="{{ route('supplier.deleted') }}">Deleted</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Categories
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('categories.index') }}">Show</a></li>
                            <li><a class="dropdown-item" href="{{ route('categories.create') }}">Create Category</a>
                            </li>

                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="{{ route('categories.deleted') }}">Deleted</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route("auth.logout") }}">Logout</a>
                    </li>

                </ul>

            </div>
        </div>
    </div>
</nav>
