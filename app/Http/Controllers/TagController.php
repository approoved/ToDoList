<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Auth\Authenticatable;

final class TagController extends Controller
{
    /**
     * @param Authenticatable&User $user
     */
    public function index(Authenticatable $user): JsonResponse
    {
        $tags = $user->tags()->get()->unique();

        return response()->json($tags);
    }
}
