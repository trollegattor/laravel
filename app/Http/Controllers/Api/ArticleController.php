<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ArticleResource::collection(Article::query()->paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreArticleRequest $request
     *
     * @return ArticleResource
     */
    public function store(StoreArticleRequest $request): ArticleResource
    {
        $article = Article::query()->create([
            'category_id' => $request->input('category_id'),
            //..
        ]);

        return new ArticleResource($article);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return ArticleResource
     */
    public function show(int $id): ArticleResource
    {
       return new ArticleResource(Article::query()->findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
