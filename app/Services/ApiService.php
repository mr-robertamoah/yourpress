<?php

namespace App\Services;

use App\DTOs\UserDTO;
use App\Exceptions\ApiException;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ApiService
{
    public function login(UserDTO $userDTO)
    {
        if (is_null($userDTO->username) && is_null($userDTO->email)) {
            throw ValidationException::withMessages([
                'username' => "username should be provided if you don't provide email",
                'email' => "email should be provided if you don't provide username"
            ]);
        }

        $query = User::query();

        $query->when($userDTO->username, function($q) use ($userDTO) {
            $q->where('username', $userDTO->username);
        });

        $query->when($userDTO->email, function($q) use ($userDTO) {
            $q->where('email', $userDTO->email);
        });

        $user = $query->first();

        if (! $user) {
            throw new ApiException(
                "username/email does not exist 😕",
            );
        }

        if (! Hash::check($userDTO->password, $user->password)) {
            throw new ApiException(
                "username/email and password combination provided could not be found 😕",
            );
        }

        Auth::login($user);

        return Auth::user();
    }

    public function register(UserDTO $userDTO)
    {
        $user = User::create([
            'first_name' => $userDTO->firstName,
            'last_name' => $userDTO->lastName,
            'other_names' => $userDTO->otherNames,
            'username' => $userDTO->username,
            'email' => $userDTO->email,
            'password' => Hash::make($userDTO->password),
        ]);

        Auth::login($user);

        return $user;
    }
}
