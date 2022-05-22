<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Article;

use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Null_;

class CategoryController extends Controller
{
    public function show()
    {
        $category = Category::first();
        if (Category::first() == Null){
            echo 'nulll';
        }
        else{
            echo 'NOT NULL';
        }

        echo gettype($category);
        echo $category;

    }
    public function result(Request $request)
    {
        $title=$request->input('title');
        //echo $title;
        $slug=$request->input('slug');
        return view('code.result',[
             'title'=>$title,
            'slug'=>$slug
        ]);
    }
    public function form(Request $request)
    {
        if ($request->has('title') and $request->has('slug')) {
            //dump($request->input('title'));
            //dump($request->input('slug'));
            echo $request->method();
            print_r($request->all());
        }
        return view('code.form');

    }
}

