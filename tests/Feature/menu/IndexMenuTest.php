<?php

namespace Tests\Feature\menu;

use Tests\TestCase;

class IndexMenuTest extends TestCase
{
    /**
     * @return void
     */
    public function testMenuIndexGet()
    {
        $this->getJson('/api/menu')
            ->assertOk();
    }
}
