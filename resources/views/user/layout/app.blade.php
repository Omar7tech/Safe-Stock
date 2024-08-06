<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Safe Stock')</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://code.ajquery.com/jquery-3.6.0.min.js"></script>
@yield('header-links')
    @yield('style')
    <style>
        @import url("https://fonts.googleapis.com/css?family=Sacramento&display=swap");
        @import url('https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap');

        :root {
            --app-name-color-dark: #fff6a9;
            --app-name-color-light: #000000;
            --body-background-dark: linear-gradient(87deg, rgba(0, 0, 0, 1) 0%, rgb(26, 14, 2) 35%);
            --body-background-light: linear-gradient(135deg, #fdfcfb 0%, #e2d1c3 100%);
        }

        [data-bs-theme="dark"] body {
            background: rgb(0, 0, 0);
            background: var(--body-background-dark);
        }

        [data-bs-theme="light"] body {
            background: var(--body-background-light);
        }

        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            background: var(--body-background-dark);
            background-size: cover;
            background-repeat: no-repeat;

        }


        .title {
            font-family: "Rubik", sans-serif;
            font-optical-sizing: auto;
            font-weight: 300;
            font-style: normal;
        }

        #app-name {
            font-size: calc(5px + 3vh);
            line-height: calc(2px + 2vh);
            text-shadow: 0 0 5px #c47f00, 0 0 15px #ac7000, 0 0 20px #ffa500, 0 0 40px #ffa500, 0 0 60px #ff0000, 0 0 10px #ff8d00, 0 0 98px #ff0000;
            font-family: "Sacramento", cursive;
            text-align: center;
        }

        [data-bs-theme="dark"] #app-name {
            color: var(--app-name-color-dark);
        }

        [data-bs-theme="light"] #app-name {
            color: var(--app-name-color-light);
        }
    </style>
</head>

<body>
    @include('user.layout.partials.navigation')
    <div class="container-fluid mt-3 ">
        @yield('content')
    </div>

    <script>
        function toggleTheme() {
            const htmlElement = document.documentElement;
            const currentTheme = htmlElement.getAttribute('data-bs-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';

            htmlElement.setAttribute('data-bs-theme', newTheme);

            const themeToggleBtn = document.getElementById('themeToggleBtn');
            const themeToggleIcon = document.getElementById('themeToggleIcon');

            if (newTheme === 'dark') {
                themeToggleBtn.innerHTML = '<i id="themeToggleIcon" class="bi bi-moon"></i>';
            } else {
                themeToggleBtn.innerHTML = '<i id="themeToggleIcon" class="bi bi-sun"></i>';
            }

            localStorage.setItem('theme', newTheme);
        }

        document.addEventListener('DOMContentLoaded', () => {
            const savedTheme = localStorage.getItem('theme') || 'dark';
            document.documentElement.setAttribute('data-bs-theme', savedTheme);
            const themeToggleBtn = document.getElementById('themeToggleBtn');
            const themeToggleIcon = document.getElementById('themeToggleIcon');

            if (savedTheme === 'dark') {
                themeToggleBtn.innerHTML = '<i id="themeToggleIcon" class="bi bi-moon"></i>';
            } else {
                themeToggleBtn.innerHTML = '<i id="themeToggleIcon" class="bi bi-sun"></i>';
            }
        });
    </script>
</body>

</html>
