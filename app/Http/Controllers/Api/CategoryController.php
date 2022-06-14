<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Services\CategoryService\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(CategoryService $categoryService)
    {
        $categories = $categoryService->getAll();

        return CategoryResource::collection($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request,CategoryService $categoryService): CategoryResource
    {
        $data = [
            'name' => $request->input('name'),
            'type' => $request->input('type'),
            'parent_id' => $request->input('parent_id'),
        ];
        $newCategory=$categoryService->create($data);

        return new CategoryResource($newCategory);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id, CategoryService $categoryService): CategoryResource
    {
        $model=$categoryService->show($id);

        return new CategoryResource($model);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCategoryRequest $request, Category $category,CategoryService $categoryService): CategoryResource
    {
        $data=[
            'name' => $request->input('name'),
            'type' => $request->input('type'),
            'parent_id' => $request->input('parent_id')
        ];
        $updateCategory=$categoryService->update($category,$data);

        return new CategoryResource($updateCategory);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return bool
     */
    public function destroy(Category $category, CategoryService $categoryService): bool
    {
        return $categoryService->destroy($category);
    }
}
