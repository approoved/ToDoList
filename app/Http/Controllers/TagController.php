<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Task;
use App\Models\User;
use App\Policies\TaskPolicy;
use Illuminate\Http\Response;
use App\Http\Requests\TagRequest;
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

    public function attach(TagRequest $request, Task $task): JsonResponse
    {
        $this->authorize(TaskPolicy::ATTACH_TAG, $task);

        $data = $request->validated();

        /** @var Tag $tag */
        $tag = Tag::query()->firstOrCreate($data);

        $task->tags()->syncWithoutDetaching($tag->id);
        $task->load('tags');

        return response()->json($task, Response::HTTP_CREATED);
    }

    public function detach(Task $task, Tag $tag): Response
    {
        $this->authorize(TaskPolicy::DETACH_TAG, $task);

        $task->tags()->detach($tag->id);

        return response()->noContent();
    }
}
