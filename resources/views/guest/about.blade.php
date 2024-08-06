@extends('guest.layouts.app')

@section('title', 'About Us')
@section('style')
    <style>
        @import url("https://fonts.googleapis.com/css?family=Sacramento&display=swap");

        #app-name {
            font-size: calc(1px + 5vh);

            /*   text-shadow: 0 0 5px #f562ff, 0 0 15px #f562ff, 0 0 25px #f562ff,
            0 0 20px #f562ff, 0 0 30px #890092, 0 0 80px #890092, 0 0 80px #890092;
          color: #fccaff; */
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
                /*     color: #fccaff;
            text-shadow: 0 0 5px #f562ff, 0 0 15px #f562ff, 0 0 25px #f562ff,
              0 0 20px #f562ff, 0 0 30px #890092, 0 0 80px #890092, 0 0 80px #890092; */
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
                /*     color: #fccaff;
            text-shadow: 0 0 5px #f562ff, 0 0 15px #f562ff, 0 0 25px #f562ff,
              0 0 20px #f562ff, 0 0 30px #890092, 0 0 80px #890092, 0 0 80px #890092; */
                text-shadow: 0 0 5px #ffa500, 0 0 15px #ffa500, 0 0 20px #ffa500, 0 0 40px #ffa500, 0 0 60px #ff0000, 0 0 10px #ff8d00, 0 0 98px #ff0000;
                color: #fff6a9;
            }
        }

        .glassy-background {
            background: rgba(0, 0, 0, 0);
            /* White background with transparency */
            backdrop-filter: blur(10px);
            /* Blur effect */
            border: 1px solid rgba(0, 0, 0, 0.0);
            /* Light border */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            /* Subtle shadow for depth */
            border-radius: 15px;
            /* Rounded corners */
            overflow: hidden;
            padding: 20px;
        }
    </style>
@endsection
@section('content')
    <div class="container py-5 glassy-background mt-5">
        <div class="row align-items-center">
            <div class="col-md-6 text-center">
                <img src="https://avatars.githubusercontent.com/u/130991308?s=400&u=785abdd5e0a6d4c05e17e38979c45cf11054e478&v=4"
                    class="img-fluid rounded mb-4" style="width: 350px;" alt="Omar7Tech">
            </div>
            <div class="col-md-6">
                <div class="about-content">
                    <h2 class="mb-4">Meet Omar7Tech</h2>
                    <p class="lead">
                        Welcome to the world of Omar7Tech! 🚀
                    </p>
                    <p>
                        A tech enthusiast and a passionate web developer, Omar Abi Farraj, known as Omar7Tech, is here to
                        revolutionize the web development industry. Specializing in backend development, he aims to craft
                        innovative solutions that bring tangible benefits.
                    </p>
                    <p>
                        Dive into the world of Omar7Tech and explore his journey, projects, and contributions on GitHub.
                        Let's build the future together!
                    </p>
                    <a href="https://github.com/omar7tech" target="_blank" class="btn btn-dark"><span
                            id="app-name">{{ config('app.name') }} </span> <i class="ms-3 bi bi-github h3"></i>
                        <span></span></a>
                </div>
            </div>
        </div>
    </div>
@endsection
