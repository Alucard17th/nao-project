<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChatMessageEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $nickname;
    public $message;
    public $user;
    public $sendto;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(string $nickname, string $message, User $user, int $sendto)
    {
        //
        $this->user = $user;
        $this->sendto = $sendto;
        $this->nickname = $nickname;
        $this->message = $message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        // return new PrivateChannel('channel-name');
        // return new Channel('chat');
        return new PrivateChannel('user.'.$this->sendto);
    }

    public function broadcastAs()
    {
        return 'chat-message';
    }
}
