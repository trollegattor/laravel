<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
/*
Route::get('/',[CategoryController::class,'show'] );
/*Route::any('/comments',function (){
    print_r($_POST);
});*/
Route::get('/',[CategoryController::class,'show']);
