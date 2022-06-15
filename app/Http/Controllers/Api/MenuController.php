<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMenuRequest;
use App\Http\Resources\MenuResource;
use App\Models\Menu;
use App\Services\MenuService\MenuService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Throwable;

class MenuController extends Controller
{
    /**
     * @param MenuService $menuService
     * @return AnonymousResourceCollection
     */
    public function index(MenuService $menuService): AnonymousResourceCollection
    {
        $menu = $menuService->getAll();

        return MenuResource::collection($menu);
    }

    /**
     * @param StoreMenuRequest $request
     * @param MenuService $menuService
     * @return MenuResource
     */
    public function store(StoreMenuRequest $request, MenuService $menuService): MenuResource
    {
        $data = [
            'category_id' => $request->input('category_id'),
            'title' => $request->input('title'),
        ];
        $newMenu = $menuService->create($data);

        return new MenuResource($newMenu);
    }

    /**
     * @param int $id
     * @param MenuService $menuService
     * @return MenuResource
     */
    public function show(int $id, MenuService $menuService): MenuResource
    {
        $model = $menuService->show($id);

        return new MenuResource($model);
    }

    /**
     * @param StoreMenuRequest $request
     * @param int $id
     * @param MenuService $menuService
     * @return MenuResource
     */
    public function update(StoreMenuRequest $request, int $id, MenuService $menuService): MenuResource
    {
        $data = [
            'category_id' => $request->input('category_id'),
            'title' => $request->input('title'),
        ];
        $updateMenu = $menuService->update($id, $data);

        return new MenuResource($updateMenu);
    }

    /**
     * @param int $id
     * @param MenuService $menuService
     * @return bool|null
     * @throws Throwable
     */
    public function destroy(int $id, MenuService $menuService): ?bool
    {
        return $menuService->destroy($id);
    }
}
