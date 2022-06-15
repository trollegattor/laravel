<?php

namespace App\Services\ArticleService;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Throwable;

class ArticleService
{

    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return Article::all();
    }

    /**
     * @param $data
     * @return Builder|Model
     */
    public function create($data): Model|Builder
    {
        return Article::query()->create($data);
    }

    /**
     * @param $id
     * @param $data
     * @return Builder|Builder[]|Collection|Model|null
     */
    public function update($id, $data): Model|Collection|Builder|array|null
    {
        $model = Article::query()->findOrFail($id);
        $model->update($data);

        return $model;
    }

    /**
     * @param int $id
     * @return Builder|Builder[]|Collection|Model|null
     */
    public function show(int $id): Model|Collection|Builder|array|null
    {
        return Article::query()->findOrFail($id);
    }

    /**
     * @param int $id
     * @return bool|null
     * @throws Throwable
     */
    public function destroy(int $id): ?bool
    {
        $model = Article::query()->findOrFail($id);

        return $model->deleteOrFail();
    }

}
