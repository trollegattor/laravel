<?php

namespace App\Http\Controllers;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function showtitle(){
        /*$title=Article::paginate(15);
        foreach ($title as $a){
            echo 'id: '.$a->id.'; title: '.$a->title.'; content: '.$a->content;
            echo '<p>';
        }
        print($title);*/
        return Article::all();
    }
    public function articles(){
        $url=route('id');
        echo $url;
        return redirect()->route('id');
        /*
        $articles=Article::find(1);
        echo url("/articles/{$articles->id}");*/

    }
}
