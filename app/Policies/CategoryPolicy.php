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
    public const ATTACH_TASK = 'attachTask';
    public const VIEW_ANY = 'viewAny';

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

    private function manage(Authenticatable $user, Category $category): bool
    {
        return $user->id === $category->user_id;
    }
}
