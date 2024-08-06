<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Safe Stock - Admin')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

   
    @yield('style')
    <style>
        @import url("https://fonts.googleapis.com/css?family=Sacramento&display=swap");
        body {
            background: rgb(0, 0, 0);
            background: linear-gradient(87deg, rgba(0, 0, 0, 1) 0%, rgb(20, 11, 1) 35%);
        }
        #app-name {
            font-size: calc(5px + 3vh);
            line-height: calc(2px + 2vh);
            text-shadow: 0 0 5px #c47f00, 0 0 15px #ac7000, 0 0 20px #ffa500, 0 0 40px #ffa500, 0 0 60px #ff0000, 0 0 10px #ff8d00, 0 0 98px #ff0000;
            color: #fff6a9;
            font-family: "Sacramento", cursive;
            text-align: center;
        }
    </style>
    </style>
</head>

<body>
    @include('admin.layout.partials.navigation')
    <div class="container mt-2">
        @yield('content')
    </div>
</body>

</html>
