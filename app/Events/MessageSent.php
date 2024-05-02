<?php

namespace App\Events;

use App\Models\Message;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, SerializesModels;

    public $content;
    public $sender;
    public $timestamp;

    public $user;
    public $message;

    public function __construct(User $user, Message $message)
    {
        $this->user = $user;
        $this->content = $message->message;
        $this->sender = $message->user->name; // Assuming you have a 'name' field in your user table
        $this->timestamp = $message->created_at->toDateTimeString();
    }



    public function broadcastOn()
    {
        return new PrivateChannel('chat');
    }
}
