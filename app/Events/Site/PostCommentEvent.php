<?php

namespace App\Events\Site;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PostCommentEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $commentId;
    private $productId;
    public $userSend;

    /**
     * Create a new event instance.
     */
    public function __construct($productId, $commentId, $userSend)
    {
        $this->productId = $productId;
        $this->commentId = $commentId;
        $this->userSend = $userSend;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel("product-{$this->productId}"),
            new Channel("comment-{$this->commentId}")
        ];
    }

    public function broadcastAs()
    {
        return 'comment-update';
    }
}
