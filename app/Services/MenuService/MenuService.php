<?php

namespace App\Services\MenuService;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Throwable;

class MenuService
{

    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return Menu::all();
    }

    /**
     * @param $data
     * @return Builder|Model
     */
    public function create($data): Model|Builder
    {
        return Menu::query()->create($data);
    }

    /**
     * @param $id
     * @param $data
     * @return Builder|Builder[]|Collection|Model|null
     */
    public function update($id, $data): Model|Collection|Builder|array|null
    {
        $model = Menu::query()->findOrFail($id);
        $model->update($data);

        return $model;
    }

    /**
     * @param int $id
     * @return Builder|Builder[]|Collection|Model|null
     */
    public function show(int $id): Model|Collection|Builder|array|null
    {
        return Menu::query()->findOrFail($id);
    }

    /**
     * @param int $id
     * @return bool|null
     * @throws Throwable
     */
    public function destroy(int $id): ?bool
    {
        $model = Menu::query()->findOrFail($id);

        return $model->deleteOrFail();
    }

}
