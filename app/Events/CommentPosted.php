<?php

namespace App\Events;

use App\Models\GrievanceComment;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CommentPosted implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $comment;

    public function __construct(GrievanceComment $comment)
    {
        $this->comment = $comment->load('user'); 
    }

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('grievance.' . $this->comment->grievance_id),
        ];
    }
}