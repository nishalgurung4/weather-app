<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NoWeatherFound
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var boolean
     */
    public bool $async;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($async = true)
    {
        $this->async = $async;
    }
}
