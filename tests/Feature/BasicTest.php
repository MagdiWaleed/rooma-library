<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BasicTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_createpg(): void
    {
        $response = $this->get('/');

        $response->assertSee('Username');
    }
}
