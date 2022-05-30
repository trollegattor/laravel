<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudyController;

Route::get('/',[StudyController::class,'show']);

