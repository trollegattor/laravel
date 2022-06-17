<?php

namespace Tests\Feature\category;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IndexCategoryTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * @return void
     */
    public function testCategoryIndexGetSuccessfully()
    {
         $this->getJson('/api/category')
             ->assertOk();
    }

    /**
     * @return void
     */
    public function testCategoryIndexGetFailed()
    {
        $this->getJson('/api/error')
            ->assertNotFound();
    }
}
