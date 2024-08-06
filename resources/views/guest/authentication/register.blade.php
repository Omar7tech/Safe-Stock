@extends('guest.layouts.app')
@section('title', 'Register')

@section('style')
    <style>
        @import url("https://fonts.googleapis.com/css?family=Sacramento&display=swap");

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
@endsection

@section('content')
    <div class="container col-xl-10 col-xxl-8 px-4 py-5">
        <div class="row align-items-center g-lg-5 py-5">
            <div class="col-lg-7 text-center text-lg-start">
                <h1 id="app-name">{{ config('app.name') }}</h1>
                <h4 class="display-4 fw-bold lh-1 text-body-emphasis mb-3">Complete Your Registration</h4>
                <p class="col-lg-10 fs-6">
                    To complete your registration, please fill out the form below.
                    If you haven't requested an account yet, please <a href="{{ route('home') }}">request an account</a> first.
                    An admin will review your request and send you an email with a verification code.
                    After receiving the verification code, come back to this page and complete the registration process.
                </p>
            </div>

            <div class="col-md-10 mx-auto col-lg-5">
                <form class="p-4 p-md-4 border rounded-3 bg-body-tertiary" method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="email" placeholder="Enter your email address" name="email" required>
                        <label for="email">Email address</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="tel" class="form-control" id="tel" placeholder="Enter your phone number" name="tel" required>
                        <label for="tel">Phone number</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="password" placeholder="Enter your password" name="password" required>
                        <label for="password">Password</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm your password" name="password_confirmation" required>
                        <label for="confirmPassword">Confirm Password</label>
                    </div>
                    <div class="form-floating mb-3 border-warning">
                        <input type="text" class="form-control" id="verificationCode" placeholder="Enter the verification code sent by the admin" name="verification_code" required>
                        <label for="verificationCode">Verification Code</label>
                    </div>
                    <button class="w-100 btn btn-lg btn-primary" type="submit">Complete Registration</button>

                </form>
            </div>
        </div>
    </div>
@endsection
