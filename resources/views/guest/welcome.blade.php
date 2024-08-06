@extends('guest.layouts.app')
@section('title', 'Request an Account')

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
                <h4 class="display-4 fw-bold lh-1 text-body-emphasis mb-3">Request an Account to Store Your Products</h4>
                <p class="col-lg-10 fs-6">Fill out the form below to request an account. An admin will review your request
                    and you will receive an email notification once your request is approved. Once you receive the
                    verification code, please <a href="{{ route('register') }}">go to the registration page</a>, input the
                    received verification code, and fill out the form with your data to activate your account.</p>
            </div>

            <div class="col-md-10 mx-auto col-lg-5 ">
                <form class="p-4 p-md-4 border rounded-3 bg-body-tertiary" method="post" id="request-store">
                    @csrf
                    <div class="form-floating mb-3 ">
                        <input type="email" class="emailInput form-control" id="floatingInput"
                            placeholder="name@example.com" name="email">
                        <label for="floatingInput">Email address</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="nameInput form-control" id="floatingName" placeholder="Your Name"
                            name="name">
                        <label for="floatingName">Your Name</label>
                    </div>
                    <button class="w-100 btn btn-lg btn-primary" id="request_submit" type="submit">Request Account</button>
                    <hr class="my-4">


                    <div class="loader d-none">
                        <div class="d-flex justify-content-center m-3">
                            <div class="spinner-border" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </div>

                    <div class="alertContainer d-none">
                        <div class="errorsAlert d-none">
                            <div class="alert alert-danger" role="alert">
                                <p id="emailError" class="mb-0"></p>
                                <p class="mb-0" id="nameError"></p>
                            </div>
                        </div>

                        <div class="successAlert d-none">
                            <div class="alert alert-success" role="alert">
                                <h4 class="alert-heading">Request Submitted Successfully!</h4>
                                <p>Thank you for your submission. Once your request is approved by the administrator, you
                                    will
                                    receive an email with a verification code. Please use this code for registration.</p>
                                <hr>
                                <p class="mb-0">If you have any questions, feel free to contact us.</p>
                            </div>
                        </div>
                    </div>

                    <small class="text-body-secondary">By clicking Request Account, you agree to the terms of use.</small>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#request-store').submit(function(e) {
                $(".alertContainer").addClass("d-none");
                e.preventDefault();
                $(".loader").removeClass("d-none");


                let emailInput = $(".emailInput");
                let nameInput = $(".nameInput");
                let emailError = $("#emailError");
                let nameError = $("#nameError");
                $.ajax({
                    url: `/request/make`,
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        $(".alertContainer").removeClass("d-none");

                        $(".loader").addClass("d-none")
                        if (response.success) {
                            emailInput.removeClass("is-invalid");
                            nameInput.removeClass("is-invalid");
                            emailInput.addClass("is-valid");
                            nameInput.addClass("is-valid");
                            $(".errorsAlert").addClass("d-none");
                            $(".successAlert").removeClass("d-none");
                        } else {

                        }
                    },
                    error: function(xhr) {
                        $(".alertContainer").removeClass("d-none");

                        $(".loader").addClass("d-none")
                        if (xhr.status === 422) { // 422 Unprocessable Entity
                            let errors = JSON.parse(xhr.responseText).errors;
                            if (errors.email) {
                                emailInput.removeClass("is-valid");
                                emailInput.addClass("is-invalid");
                                emailError.text(errors.email);
                            } else {
                                emailInput.addClass("is-valid");
                                emailInput.removeClass("is-invalid");
                                emailError.text("");
                            }
                            if (errors.name) {
                                nameInput.removeClass("is-valid");
                                nameInput.addClass("is-invalid");
                                nameError.text(errors.name);
                            } else {
                                nameInput.addClass("is-valid");
                                nameInput.removeClass("is-invalid");
                                nameError.text("");
                            }
                            $(".errorsAlert").removeClass("d-none");
                            $(".successAlert").addClass("d-none");

                        } else {
                            console.log(xhr.responseText);
                        }
                    }

                });
            });
        });
    </script>
@endsection
