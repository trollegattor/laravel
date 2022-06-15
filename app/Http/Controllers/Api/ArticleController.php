<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use App\Services\ArticleService\ArticleService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Throwable;


class ArticleController extends Controller
{

    /**
     * @param ArticleService $articleService
     * @return AnonymousResourceCollection
     */
    public function index(ArticleService $articleService): AnonymousResourceCollection
    {
        $articles = $articleService->getAll();

        return ArticleResource::collection($articles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreArticleRequest $request
     * @param ArticleService $articleService
     * @return ArticleResource
     */
    public function store(StoreArticleRequest $request, ArticleService $articleService): ArticleResource
    {
        $data = [
            'category_id' => $request->input('category_id'),
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'author' => $request->input('author'),
        ];
        $newArticle = $articleService->create($data);

        return new ArticleResource($newArticle);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @param ArticleService $articleService
     * @return ArticleResource
     */
    public function show(int $id, ArticleService $articleService): ArticleResource
    {
        $model = $articleService->show($id);

        return new ArticleResource($model);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreArticleRequest $request
     * @param int $id
     * @param ArticleService $articleService
     * @return ArticleResource
     */
    public function update(StoreArticleRequest $request, int $id, ArticleService $articleService): ArticleResource
    {
        $data = [
            'category_id' => $request->input('category_id'),
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'author' => $request->input('author'),
        ];
        $updateArticle = $articleService->update($id, $data);

        return new ArticleResource($updateArticle);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @param ArticleService $articleService
     * @return bool
     * @throws Throwable
     */
    public function destroy(int $id, ArticleService $articleService): ?bool
    {
        return $articleService->destroy($id);
    }
}
