<?php

namespace App\Policies;

use App\Models\Category;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Access\HandlesAuthorization;

final class CategoryPolicy
{
    use HandlesAuthorization;

    public function manage(Authenticatable $user, Category $category): bool
    {
        return $user->id === $category->user_id;
    }

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

    public function attachTask(Authenticatable $user, Category $category): bool
    {
        return $this->manage($user, $category);
    }

    public function viewAny(Authenticatable $user, Category $category): bool
    {
        return $this->manage($user, $category);
    }
}
