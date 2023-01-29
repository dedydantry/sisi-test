<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MenuResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\UserActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth,Validator};

class AuthController extends Controller
{
    use UserActivity;

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email', 
            'password' => 'required|string'
        ]);

        if ($validator->fails()) return response()->json(['status' => false, 'message' => $validator->errors()->first()]);

        if (!Auth::attempt($request->only(['email', 'password']))) return response()->json(['message' => 'Credentials not match']);

        return response()->json([
            'status' => true,
            'message' => 'login success',
            'access_token' =>  auth()->user()->createToken('API Token')->plainTextToken
        ]);
    }

    public function me()
    {
        $user = User::with('menus')->find(auth()->user()->id);

        $this->UserActivity([
            'menu' => 'Dashboard',
            'description' => 'User logged in',
            'status' => 'success'
        ]);

        return new UserResource($user);
    }
}
