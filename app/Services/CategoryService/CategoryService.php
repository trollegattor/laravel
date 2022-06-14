<?php

namespace App\Services\CategoryService;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Client\Request;
use phpDocumentor\Reflection\Types\Object_;

class CategoryService
{

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll(): \Illuminate\Database\Eloquent\Collection
    {
        return Category::all();
    }

    /**
     * @param $data
     * @return Category
     */
    public function create($data): Category
    {
        return Category::create($data);
    }

    /**
     * @param $model
     * @param $data
     * @return mixed
     */
    public function update($model, $data): mixed
    {
        $model->update($data);

        return $model;
    }

    /**
     * @param $id
     * @return object
     */
    public function show($id): object
    {
        return Category::query()->findOrFail($id);
    }

    /**
     * @param $model
     * @return bool
     */
    public function destroy($model): bool
    {
        return $model->delete();
    }

}
