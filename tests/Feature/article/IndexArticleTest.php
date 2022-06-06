<?php

namespace Tests\Feature\article;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IndexArticleTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testArticleIndexGet()
    {
        $this->getJson('/api/article')
        ->assertOk();
    }
}
