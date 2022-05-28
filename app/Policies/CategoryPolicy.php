<?php

namespace App\Policies;

use App\Models\Category;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Access\HandlesAuthorization;

final class CategoryPolicy
{
    use HandlesAuthorization;

    public const SHOW = 'show';
    public const UPDATE = 'update';
    public const DESTROY = 'destroy';

    public function show(Authenticatable $user, Category $category): bool
    {
        return $this->manage($user, $category);
    }

    public function update(Authenticatable $user, Category $category): bool
    {
        return $this->manage($user, $category);
    }

    public function destroy(Authenticatable $user, Category $category): bool
    {
        return $this->manage($user, $category);
    }

    private function manage(Authenticatable $user, Category $category): bool
    {
        return $user->id === $category->user_id;
    }
}
