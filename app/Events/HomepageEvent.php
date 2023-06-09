<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

use Illuminate\Support\Facades\Http;

class HomepageEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public string $message;

    public function __construct($data)
    {
        $this->message = $data['message'];

//        app('App\Http\Controllers\LandingPageController')->callNewsApiTopHeadlines();
//
        Http::withHeaders(['Content-type' => 'application/json'])->post(
            env('SLACK_WEBHOOK_JETSTORM'),
            ['text' => "🧑🏽‍💻 {$this->message}"]
        );
    }

    public function broadcastOn()
    {
        return new Channel('chat-channel');
    }
    public function broadcastAs()
    {
        return 'HomepageEvent';
    }
}
