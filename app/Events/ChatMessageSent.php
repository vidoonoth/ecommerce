<?php
namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\ChatMessage;

class ChatMessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $chatMessage;

    public function __construct(ChatMessage $chatMessage)
    {
        $this->chatMessage = $chatMessage;
    }

    public function broadcastOn()
    {
        // Private channel per user pair
        return new PrivateChannel('chat.' . $this->chatMessage->user_id . '.' . $this->chatMessage->recipient_id);
    }

    public function broadcastWith()
    {
        return [
            'id' => $this->chatMessage->id,
            'user_id' => $this->chatMessage->user_id,
            'recipient_id' => $this->chatMessage->recipient_id,
            'message' => $this->chatMessage->message,
            'created_at' => $this->chatMessage->created_at,
        ];
    }
}
