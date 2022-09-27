<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Task;
use App\Models\Category;
use App\Policies\TaskPolicy;
use Illuminate\Http\Response;
use App\Policies\CategoryPolicy;
use App\Http\Requests\TagRequest;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\EditTaskRequest;
use App\Http\Requests\CreateTaskRequest;


class TaskController extends Controller
{
    public function index(Category $category): JsonResponse
    {
        $this->authorize(CategoryPolicy::VIEW_ANY, $category);

        $tasks = $category->tasks()->paginate(10);

        return response()->json($tasks);
    }

    public function store(CreateTaskRequest $request, Category $category): JsonResponse
    {
        $this->authorize(CategoryPolicy::ATTACH_TASK, $category);

        $data = $request->validated();

        $data['category_id'] = $category->id;

        $task = new Task();
        $task->fill($data)->save();
      
        return response()->json($task, Response::HTTP_CREATED);
    }

    public function show(Task $task): JsonResponse
    {
        $this->authorize(TaskPolicy::SHOW, $task);

        return response()->json($task);
    }

    public function update(EditTaskRequest $request, Task $task): JsonResponse
    {
        $this->authorize(TaskPolicy::UPDATE, $task);

        $data = $request->validated();

        $task->update($data);

        return response()->json($task, Response::HTTP_CREATED);
    }

    public function destroy(Task $task): Response
    {
        $this->authorize(TaskPolicy::DESTROY, $task);

        $task->delete();

        return response()->noContent();
    }

    public function attachTag(TagRequest $request, Task $task): JsonResponse
    {
        $this->authorize(TaskPolicy::ATTACH_TAG, $task);

        $data = $request->validated();

        /** @var Tag $tag */
        $tag = Tag::query()->firstOrCreate($data);

        $task->tags()->syncWithoutDetaching($tag->id);
        $task->load('tags');

        return response()->json($task, Response::HTTP_CREATED);
    }

    public function detachTag(Task $task, Tag $tag): Response
    {
        $this->authorize(TaskPolicy::DETACH_TAG, $task);

        $task->tags()->detach($tag->id);

        return response()->noContent();
    }
}
