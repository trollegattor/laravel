<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenusSeeder extends Seeder
{

    public function run()
    {
        DB::table('menus')->insert([
            ['title'=>'About us','categories_id'=>1],
            ['title'=>'News','categories_id'=>2],
            ['title'=>'Contacts','categories_id'=>3],
        ]);
    }
}
