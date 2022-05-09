<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Article;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show()
    {
        //$categoryName = $request->input('name');
        $category = Category::all();
      /*  foreach ($category as $a) {
            print($a);
            echo '<br>';
        }*/
        return view('home.index',[
            'category'=>$category,
        ]);
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

