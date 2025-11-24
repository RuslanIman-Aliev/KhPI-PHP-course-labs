<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TaskUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $projectId;
    public $title;
    public $status;

    /**
     * Create a new event instance.
     */
    public function __construct($projectId, $title, $status)
    {
        $this->projectId = $projectId;
        $this->title = $title;
        $this->status = $status;
    }

    /**
     * Get the channels the event should broadcast on.
     */
    public function broadcastOn(): array
    {
        // Транслюємо у приватний канал проекту
        return [
            new PrivateChannel('project.' . $this->projectId),
        ];
    }

    /**
     * Ім'я події для клієнта (щоб слухати як .task.updated)
     */
    public function broadcastAs(): string
    {
        return 'task.updated';
    }
}