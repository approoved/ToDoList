<?php

namespace App\Policies;

use App\Models\Task;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Access\HandlesAuthorization;

final class TaskPolicy
{
    use HandlesAuthorization;

    public function manage(Authenticatable $user, Task $task): bool
    {
        return $user->id === $task->category->user_id;
    }

    public function show(Authenticatable $user, Task $task): bool
    {
        return $this->manage($user, $task);
    }

    public function update(Authenticatable $user, Task $task): bool
    {
        return $this->manage($user, $task);
    }

    public function destroy(Authenticatable $user, Task $task): bool
    {
        return $this->manage($user, $task);
    }
}
