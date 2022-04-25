<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Article;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(){
    $category= Category::find(2)->articles;
        dump($category);

    }
}

