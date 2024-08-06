<nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">{{ config('app.name') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">Register</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('about') }}">About</a>
                </li>
            </ul>
        </div>
    </div>
</nav>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        var path = window.location.pathname;
        var page = path.split("/").pop();

        var navLinks = document.querySelectorAll('.nav-link');
        navLinks.forEach(function (link) {
            if (link.getAttribute('href').indexOf(page) !== -1) {
                link.classList.add('active');
            }
        });
    });
</script>
