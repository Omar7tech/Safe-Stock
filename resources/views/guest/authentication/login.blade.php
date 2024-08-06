@extends('guest.layouts.app')

@section('title', 'Login')

@section('style')
    <style>
        @import url("https://fonts.googleapis.com/css?family=Sacramento&display=swap");

        #app-name {
            font-size: calc(5px + 5vh);

            text-shadow: 0 0 5px #ffa500, 0 0 15px #ffa500, 0 0 20px #ffa500, 0 0 40px #ffa500, 0 0 60px #ff0000, 0 0 10px #ff8d00, 0 0 98px #ff0000;
            color: #fff6a9;
            font-family: "Sacramento", cursive;

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
@endsection

@section('content')
    <div class="container col-xl-10 col-xxl-8 px-4 mt-3">
        <div class="row align-items-center g-lg-5 py-5">
            <div class="col-lg-7 text-center text-lg-start">

            </div>
            <div class="col-lg-10 mx-auto col-lg-5">
                <form class="p-4 p-md-3 border rounded-3 bg-body-tertiary" action="{{ route('login') }}" method="POST">
                    @method('POST')
                    @csrf
                    <p class="display-6 fw-bold lh-1 text-body-emphasis mb-4">Login to Your Account </p>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="floatingInput"
                            placeholder="name@example.com" name="email">
                        <label for="floatingInput">Email address</label>
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror


                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                            id="floatingPassword" placeholder="Password" name="password">
                        <label for="floatingPassword">Password</label>
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="checkbox mb-3">
                        <label>
                            <input type="checkbox" value="remember-me"> Remember me
                        </label>
                    </div>
                    @if (session('error'))
                        <div class="alert alert-danger">
                            <i class="bi bi-exclamation-triangle-fill"></i>{{ session('error') }}
                        </div>
                    @endif

                    <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
                    <hr class="my-4">
                    <small class="text-body-secondary">By clicking Login, you agree to the terms of use.</small>
                    <h1 id="app-name" class="mt-3">{{ config('app.name') }}</h1>
                </form>
            </div>
        </div>
    </div>
@endsection
