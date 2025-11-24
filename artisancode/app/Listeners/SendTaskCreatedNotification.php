<?php

namespace App\Listeners;

use App\Events\TaskCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class SendTaskCreatedNotification implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(TaskCreated $event): void
    {
        Log::info("New task created: " . $event->task->title);
        Log::info("Assigned to User ID: " . $event->task->assignee_id);

        sleep(5);

        Log::info("Notification sent successfully.");
    }
}
