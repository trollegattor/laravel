<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function show($id){
        $menu=Menu::where('id',$id)->first();
        return view('menu.menu',[
            'menu'=>$menu
        ]);

    }
}
