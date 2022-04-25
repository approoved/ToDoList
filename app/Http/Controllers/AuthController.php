<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Auth\Authenticatable;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

final class AuthController extends Controller
{
    public function verify(string|null $token): JsonResponse
    {
        /** @var User $user */
        $user = User::query()->where('token', $token)->firstOrFail();

        $user->token = null;
        $user->email_verified_at = Carbon::now();

        $user->save();

        return response()->json($user);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $data = $request->validated();

        /** @var User $user */
        $user = User::query()->where('email', $data['email'])->firstOrFail();

        if (! Hash::check($data['password'], $user->password)) {
            throw new HttpException(Response::HTTP_NOT_FOUND);
        }

        $token = $user->createToken('API Token')->accessToken;

        return response()->json(['user' => $user, 'token' => $token], 201);
    }

    /** 
    * @param Authenticatable&User $user
    */
    public function logout(Authenticatable $user)
    {
        $user->token()->revoke();

        return response()->noContent();
    }
}

