<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Response;
use App\Policies\CategoryPolicy;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\EditCategoryRequest;
use App\Http\Requests\CreateCategoryRequest;
use Illuminate\Contracts\Auth\Authenticatable;

final class CategoryController extends Controller
{
    /** 
     * @param Authenticatable&User $user
     */
    public function index(Authenticatable $user): JsonResponse
    {
        $categories = $user->catergories()
            ->paginate(10);

        return response()->json($categories);
    }

    /**
     * @param Authenticatable&User $user
     */
    public function store(Authenticatable $user, CreateCategoryRequest $request): JsonResponse
    {
        $data = $request->validated();

        $data['user_id'] = $user->id;

        $category = new Category();
        $category->fill($data)->save();

        return response()->json($category, Response::HTTP_CREATED);
    }

    public function show(Category $category): JsonResponse
    {
        $this->authorize(CategoryPolicy::SHOW, $category);

        return response()->json($category);
    }

    public function update(Category $category, EditCategoryRequest $request): JsonResponse
    {
        $this->authorize(CategoryPolicy::UPDATE, $category);

        $data = $request->validated();

        $category->update($data);

        return response()->json($category, Response::HTTP_CREATED);
    }

    public function destroy(Category $category): Response
    {
        $this->authorize(CategoryPolicy::DESTROY, $category);

        $category->delete();

        return response()->noContent();
    }
}
