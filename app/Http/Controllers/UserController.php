<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Models\User;
use App\Notifications\Verification;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function store(CreateUserRequest $request)
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
