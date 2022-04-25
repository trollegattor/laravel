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
            ['title'=>'About us','category_id'=>1],
            ['title'=>'News','category_id'=>2],
            ['title'=>'Contacts','category_id'=>3],
        ]);
    }
}
