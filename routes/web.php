<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MenuController;
/*
Route::get('/',[CategoryController::class,'show'] );
/*Route::any('/comments',function (){
    print_r($_POST);
});*/
Route::get('/',[CategoryController::class,'show']);
Route::get('/menu/{id}',[MenuController::class,'show']);
