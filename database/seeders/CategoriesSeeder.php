<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    public function run()
    {
       DB::table('categories')->insert([
           ['name'=>'About us','type'=>'single'],
           ['name'=>'News','type'=>'multiple'],
           ['name'=>'Contacts','type'=>'single'],


       ]);
    }
}
