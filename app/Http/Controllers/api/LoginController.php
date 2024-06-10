<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

    public function signup(Request $request)
    {
        $request->validate([
            "username" => ["required", "min:4", "max:60"],
            "password" => ["required", "min:8", "max:" . 2 ** 16],
        ]);

        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            "last_login" => now()
        ]);
        if ($user) {
            return response()->json([
                "status" => "success",
                "token" => $user->createToken($user->username)->plainTextToken
            ], 201);
        }
        return false;
    }
    public function signin(Request $request)
    {
        $request->validate([
            "username" => ["required", "min:4", "max:60"],
            "password" => ["required", "min:8", "max:" . 2 ** 16],
        ]);

        $user = User::where("username", $request->username)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            $user->update([
                "last_login" => now()
            ]);
            return response()->json([
                "status" => "success",
                "token" => $user->createToken($user->username)->plainTextToken
            ], 201);
        }
        return false;
    }
    public function signout(Request $request)
    {
        $request->user()->tokens()->delete();
        return ["status" => "success"];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
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
