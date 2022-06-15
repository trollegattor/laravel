<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenusSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run()
    {
        Menu::factory()->count(3)->create();
    }
}
