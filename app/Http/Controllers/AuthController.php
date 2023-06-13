<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum'])->only('logout','me');
    }

    public function login(Request $request) {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    return $user->createToken($user->email)->plainTextToken;
    }

    public function logout(Request $request)
    {
        $request -> user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Anda telah Logout']);
    }

    public function me()
    {
        $user = Auth::user();
        return response()->json([
            'id'        => $user->id,
            'username'  => $user->username,
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'min:2|max:20',
            'email' => 'email|unique:users',
            'password' => 'min:2'
        ]);

        User::create([
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password'))
        ]);

        return response()->json([
            'Message' => 'Success'
        ]);
    }
}
