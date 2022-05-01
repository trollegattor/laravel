<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Article;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(int $categoryId)
    {
        //$categoryName = $request->input('name');
        $category = Category::find($categoryId);
      /*  foreach ($category as $a) {
            print($a);
            echo '<br>';
        }*/

        return $category;
    }
}

