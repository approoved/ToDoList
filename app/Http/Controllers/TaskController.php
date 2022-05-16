<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\EditTaskRequest;
use App\Http\Requests\CreateTaskRequest;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Contracts\Auth\Authenticatable;

class TaskController extends Controller
{
    /**
     * @param Authenticatable&User $user
     */
    public function index(Category $category, Authenticatable $user): JsonResponse
    {
        $this->authorize('viewAny', $category);

        $tasks = $category->tasks()->paginate(10);

        return response()->json($tasks);
    }

    /**
     * @param Authenticatable&User $user
     */
    public function store(Category $category, Authenticatable $user, CreateTaskRequest $request): JsonResponse
    {
        $this->authorize('attachTask', $category);

        $data = $request->validated();

        $data['category_id'] = $category->id;

        $task = new Task();
        $task->fill($data)->save();
        
        return response()->json($task, 201);
    }

    public function show(Category $category, Task $task): JsonResponse
    {
        $this->authorize('show', $task);

        return response()->json($task);
    }

    public function update(Category $category, Task $task, EditTaskRequest $request): JsonResponse
    {
        $this->authorize('update', $task);

        $data = $request->validated();

        $task->update($data);

        return response()->json($task, 201);
    }

    public function destroy(Category $category, Task $task): HttpResponse
    {
        $this->authorize('destroy', $task);

        $task->delete();

        return response()->noContent();
    }
}
