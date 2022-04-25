<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Auth\Authenticatable;

class AuthController extends Controller
{
    public function verify(string $token)
    {
        /** @var User $user */
        $user = User::query()->where('token', $token)->firstOrFail();
        $user->token = null;
        $user->email_verified_at = Carbon::now();
        $user->save();

        return response()->json($user);
    }

    public function login(LoginRequest $request)
    {
        $data = $request->validated();
        /** @var User $user */
        $user = User::query()->where('email', $data['email'])->firstOrFail();

        if (! Hash::check($data['password'], $user->password)) {
            return response(404);
        }

        $token = $user->createToken('API Token')->accessToken;

        return response()->json(['user' => $user, 'token' => $token], 201);
    }

    /** 
    * @param Authenticatable|User $user
    */
    public function logout(Authenticatable $user)
    {
        $user->token()->revoke();

        return response()->noContent(404);
    }
}

