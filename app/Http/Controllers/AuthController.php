<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthController extends Controller
{
    public function Login(Request $request)
    {
        if ($request->method() === "GET") {
            return view("guest.authentication.login");
        }

        $validatedData = $request->validate([
            "email" => "required|email|string",
            "password" => "required|min:8"
        ]);

        if (Auth::attempt($validatedData)) {
            return redirect()->route("home");
        }else{
            return redirect()->route("login")->with("error", "email or password error");
        }
    }
}
