<?php

namespace Database\Seeders;
use App\Models\Article;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticlesSeeder extends Seeder
{

    public function run()
    {
        /*DB::table('articles')->insert([
            ['category_id'=>1,'title'=>'About us','content'=>'Our company produce pub','author'=>'admin','created_at'=> Carbon::now(),'updated_at'=> Carbon::now()],
            ['category_id'=>3,'title'=>'Contacts','content'=>'Tel:88 88 88','author'=>'admin','created_at'=> Carbon::now(),'updated_at'=> Carbon::now()],
            ['category_id'=>2,'title'=>'We create a dream','content'=>'Today we create...','author'=>'admin','created_at'=> Carbon::now(),'updated_at'=> Carbon::now()],
            ['category_id'=>2,'title'=>'New hernya yakas','content'=>'Our decision to make... ','author'=>'user','created_at'=> Carbon::now(),'updated_at'=> Carbon::now()],
            ['category_id'=>2,'title'=>'New produkt','content'=>'We have a new pub','author'=>'admin','created_at'=> Carbon::now(),'updated_at'=> Carbon::now()],
        ]);*/
        Article::factory()->count(5)->create();
    }
}
