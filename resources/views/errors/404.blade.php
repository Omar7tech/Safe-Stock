<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Page Not Found !</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <style>
        @import url("https://fonts.googleapis.com/css?family=Sacramento&display=swap");

        body {
            height: 100vh;
            background: rgb(0, 0, 0);
            background: linear-gradient(87deg, rgba(0, 0, 0, 1) 0%, rgb(26, 14, 2) 35%);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            text-align: center;
            color: white;
        }


        #app-name {
            font-size: calc(20px + 8vh);
            line-height: calc(20px + 20vh);
            text-shadow: 0 0 5px #ffa500, 0 0 15px #ffa500, 0 0 20px #ffa500, 0 0 40px #ffa500, 0 0 60px #ff0000, 0 0 10px #ff8d00, 0 0 98px #ff0000;
            color: #fff6a9;
            font-family: "Sacramento", cursive;
            text-align: center;
            animation: blink 12s infinite;
            -webkit-animation: blink 12s infinite;
        }

        @-webkit-keyframes blink {

            20%,
            24%,
            55% {
                color: #111;
                text-shadow: none;
            }

            0%,
            19%,
            21%,
            23%,
            25%,
            54%,
            56%,
            100% {
                text-shadow: 0 0 5px #ffa500, 0 0 15px #ffa500, 0 0 20px #ffa500, 0 0 40px #ffa500, 0 0 60px #ff0000, 0 0 10px #ff8d00, 0 0 98px #ff0000;
                color: #fff6a9;
            }
        }

        @keyframes blink {

            20%,
            24%,
            55% {
                color: #111;
                text-shadow: none;
            }

            0%,
            19%,
            21%,
            23%,
            25%,
            54%,
            56%,
            100% {
                text-shadow: 0 0 5px #ffa500, 0 0 15px #ffa500, 0 0 20px #ffa500, 0 0 40px #ffa500, 0 0 60px #ff0000, 0 0 10px #ff8d00, 0 0 98px #ff0000;
                color: #fff6a9;
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <h1 id="app-name">{{ config('app.name') }}</h1>
        <h1>Page Not Found!</h1>
        <p>The page you are looking for does not exist.</p>
        <a href="javascript:history.back()">go back</a>
    </div>


</body>

</html>
