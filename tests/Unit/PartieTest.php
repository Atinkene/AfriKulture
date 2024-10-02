<?php

namespace Tests\Unit;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Partie;
use App\Events\PartieTerminee;
use Carbon\Carbon;
use Illuminate\Support\Facades\Event;

use PHPUnit\Framework\TestCase;

class PartieTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_checks_if_a_partie_is_finished()
    {
        $admin = User::factory()->create();

        $partie = Partie::factory()->create([
            'dateDebut' => Carbon::now()->subMinutes(31),
            'duree' => 30,
            'admin_id' => $admin->id,
        ]);

        $this->assertTrue($partie->isFinished());
    }

    /** @test */
    public function it_triggers_partie_terminee_event_when_partie_is_finished()
    {
        Event::fake();

        $admin = User::factory()->create();

        $partie = Partie::factory()->create([
            'dateDebut' => Carbon::now()->subMinutes(31),
            'duree' => 30,
            'admin_id' => $admin->id,
        ]);

        $partie->save();

        Event::assertDispatched(PartieTerminee::class);
    }
}
