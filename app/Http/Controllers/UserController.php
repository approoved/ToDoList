<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Notifications\Verification;
use App\Http\Requests\CreateUserRequest;
use Symfony\Component\HttpFoundation\JsonResponse;

final class UserController extends Controller
{
    public function store(CreateUserRequest $request): JsonResponse
    {
        $data = $request->validated();
        
        $data['password'] = bcrypt($data['password']);
        $data['token'] = Str::random(73);

        $user = new User();
        $user->fill($data)->save();
        
        $user->notify(new Verification($user));

        return response()->json($user, 201);
    }
}
