<?php

namespace App\Http\Controllers;

use App\DTOs\UserDTO;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\LogoutRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Services\ApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    public function getUser(Request $request)
    {
        $user = $request->user();

        return response()->json([
            'message' => 'successful',
            'user' => $user ? new UserResource($user) : null
        ]);
    }

    public function login(LoginRequest $request)
    {
        $user = (new ApiService)->login(
            UserDTO::createFromRequest($request)
        );

        return response()->json([
            'message' => 'successful',
            'user' => new UserResource($user)
        ]);
    }

    public function register(RegisterRequest $request)
    {   
        $user = (new ApiService)->register(
            UserDTO::createFromRequest($request, false)
        );

        return response()->json([
            'message' => 'successful',
            'user' => new UserResource($user)
        ]);
    }

    public function logout(LogoutRequest $request)
    {
        Auth::logout();

        return response()->json([
            'message' => 'successful'
        ]);
    }
}
