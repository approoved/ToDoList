<?php

namespace App\Policies;

use App\Models\Task;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Access\HandlesAuthorization;

final class TaskPolicy
{
    use HandlesAuthorization;

    public const SHOW = 'show';
    public const UPDATE = 'update';
    public const DESTROY = 'destroy';
    public const ATTACH_TAG = 'attachTag';
    public const DETACH_TAG = 'detachTag';

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

    public function attachTag(Authenticatable $user, Task $task): bool
    {
        return $this->manage($user, $task);
    }

    public function detachTag(Authenticatable $user, Task $task): bool
    {
        return $this->manage($user, $task);
    }
  
    private function manage(Authenticatable $user, Task $task): bool
    {
        return $user->id === $task->category->user_id;
    }
}
