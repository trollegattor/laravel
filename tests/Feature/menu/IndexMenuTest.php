<?php

namespace Tests\Feature\menu;

use Tests\TestCase;

class IndexMenuTest extends TestCase
{
    /**
     * @return void
     */
    public function testMenuIndexGetSuccessfully()
    {
        $this->getJson('/api/menu')
            ->assertOk();
    }

    /**
     * @return void
     */
    public function testMenuIndexGetFailed()
    {
        $this->getJson('/api/error')
            ->assertNotFound();
    }
}
