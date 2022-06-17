<?php

namespace Tests\Feature\article;

use Tests\TestCase;

class IndexArticleTest extends TestCase
{
    /**
     * @return void
     */
    public function testArticleIndexGet()
    {
        $this->getJson('/api/article')
            ->assertOk();
    }

    /**
     * @return void
     */
    public function testArticleIndexGetFailed()
    {
        $this->getJson('/api/error')
            ->assertNotFound();
    }
}
