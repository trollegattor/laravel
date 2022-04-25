<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Citie;

class CityController extends Controller
{
    public function show_table(){
        /*$users=DB::table('users')->get();
        foreach ($users as $hs){
            var_dump ($hs);
            print_r ('<br>');
        }*/
        $cities=Citie::all();
        foreach ($cities as $city){
            dump($city);
        }

    }
}
