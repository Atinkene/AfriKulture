<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Partie;

class PartieTerminee
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $partie;

    /**
     * Create a new event instance.
     *
     * @param Partie $partie
     * @return void
     */
    public function __construct(Partie $partie)
    {
        $this->partie = $partie;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
