<?php

namespace App\Events;

use App\Models\UserHistory;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ExchangeCreatedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $user_history;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(UserHistory $user_history)
    {
        $this->user_history = $user_history;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }

    public function getUserHistory(): UserHistory
    {
        return $this->user_history;
    }
}
