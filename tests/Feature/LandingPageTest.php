<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LandingPageTest extends TestCase
{
    public function test_landing_page_is_displayed()
    {
        $response = $this->get('/');

        $response->assertOk();
        $response->assertViewIs('welcome');
    }
}