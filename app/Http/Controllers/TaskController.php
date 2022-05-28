<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Category;
use App\Policies\TaskPolicy;
use App\Policies\CategoryPolicy;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\EditTaskRequest;
use App\Http\Requests\CreateTaskRequest;
use Illuminate\Http\Response;

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
}
