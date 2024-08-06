<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $requests = \App\Models\Request::paginate(10);
        return view("admin.requests.index" , compact("requests"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email|unique:requests,email',
            'name' => 'required|string|max:255',
        ], [
            'email.unique' => 'This email address has already been used to request an account. Please check your email for further instructions or contact support if you need assistance.'
        ]);

        if(\App\Models\Request::create($data)){
            return response()->json(["success" => true, "data" => ["email" => $request->email, "name" => $request->name]], 200);
        }
        return response()->json(["success" => false, "data" => ["email" => $request->email, "name" => $request->name]], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
