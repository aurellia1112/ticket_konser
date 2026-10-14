<?php

namespace Tests\Feature;

use App\Models\Events;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EventsControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_open_event_management_pages(): void
    {
        $user = User::factory()->create();
        $event = Events::create($this->eventAttributes());

        $this->actingAs($user)
            ->get(route('events.index'))
            ->assertOk();

        $this->actingAs($user)
            ->get(route('events.create'))
            ->assertOk();

        $this->actingAs($user)
            ->get(route('events.edit', $event))
            ->assertOk();
    }

    public function test_admin_can_create_an_event(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post(route('events.store'), $this->eventAttributes())
            ->assertRedirect(route('events.index'));

        $this->assertDatabaseHas('events', [
            'name' => 'Festival Musik',
            'category' => 'Festival',
            'price' => 150000,
            'description' => 'Acara musik langsung.',
        ]);
    }

    public function test_admin_can_update_an_event(): void
    {
        $user = User::factory()->create();
        $event = Events::create($this->eventAttributes());

        $this->actingAs($user)
            ->put(route('events.update', $event), [
                'name' => 'Seminar Teknologi',
                'category' => 'Seminar',
                'price' => 200000,
                'description' => 'Seminar teknologi terbaru.',
            ])
            ->assertRedirect(route('events.index'));

        $this->assertDatabaseHas('events', [
            'id' => $event->id,
            'name' => 'Seminar Teknologi',
            'category' => 'Seminar',
            'price' => 200000,
            'description' => 'Seminar teknologi terbaru.',
        ]);
    }

    public function test_admin_can_delete_an_event(): void
    {
        $user = User::factory()->create();
        $event = Events::create($this->eventAttributes());

        $this->actingAs($user)
            ->delete(route('events.destroy', $event))
            ->assertRedirect(route('events.index'));

        $this->assertDatabaseMissing('events', ['id' => $event->id]);
    }

    /**
     * @return array{name: string, category: string, price: int, description: string}
     */
    private function eventAttributes(): array
    {
        return [
            'name' => 'Festival Musik',
            'category' => 'Festival',
            'price' => 150000,
            'description' => 'Acara musik langsung.',
        ];
    }
}
