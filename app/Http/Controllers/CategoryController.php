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
}

