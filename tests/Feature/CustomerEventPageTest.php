<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CustomerEventPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_customer_event_page_renders_with_events(): void
    {
        \DB::table('events')->insert([
            [
                'name' => 'Pestapora',
                'category' => 'Festival',
                'price' => 200000,
                'description' => 'Festival musik seru',
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('Pestapora');
        $response->assertSee('Rp 200.000');
    }
}
