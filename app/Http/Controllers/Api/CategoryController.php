<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Services\CategoryService\CategoryService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Throwable;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param CategoryService $categoryService
     * @return AnonymousResourceCollection
     */
    public function index(CategoryService $categoryService): AnonymousResourceCollection
    {
        $categories = $categoryService->getAll();

        return CategoryResource::collection($categories);
    }

    /**
     * @param StoreCategoryRequest $request
     * @param CategoryService $categoryService
     * @return CategoryResource
     */
    public function store(StoreCategoryRequest $request, CategoryService $categoryService): CategoryResource
    {
        $data = [
            'name' => $request->input('name'),
            'type' => $request->input('type'),
            'parent_id' => $request->input('parent_id'),
        ];
        $newCategory = $categoryService->create($data);

        return new CategoryResource($newCategory);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @param CategoryService $categoryService
     * @return CategoryResource
     */
    public function show(int $id, CategoryService $categoryService): CategoryResource
    {
        $model = $categoryService->show($id);

        return new CategoryResource($model);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreCategoryRequest $request
     * @param int $id
     * @param CategoryService $categoryService
     * @return CategoryResource
     */
    public function update(StoreCategoryRequest $request, int $id, CategoryService $categoryService): CategoryResource
    {
        $data = [
            'name' => $request->input('name'),
            'type' => $request->input('type'),
            'parent_id' => $request->input('parent_id')
        ];
        $updateCategory = $categoryService->update($id, $data);

        return new CategoryResource($updateCategory);
    }

    /**
     * @param int $id
     * @param CategoryService $categoryService
     * @return bool|null
     * @throws Throwable
     */
    public function destroy(int $id, CategoryService $categoryService): ?bool
    {
        return $categoryService->destroy($id);
    }
}
