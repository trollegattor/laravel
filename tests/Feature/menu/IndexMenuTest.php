<?php

namespace Tests\Feature\menu;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IndexMenuTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testMenuIndexGet()
    {
        $response = $this->getJson('/api/menu');
        $response->assertOk();
    }
}
