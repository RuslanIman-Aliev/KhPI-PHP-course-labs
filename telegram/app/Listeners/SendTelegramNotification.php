<?php

namespace App\Listeners;

use App\Events\TaskCreated;
use App\Events\CommentCreated;
use App\Jobs\SendTelegramMessageJob;

class SendTelegramNotification
{
    public function handle($event): void
    {
        $message = '';

        if ($event instanceof TaskCreated) {
            $message = "🆕 New Task Created: " . $event->task->title;
        } elseif ($event instanceof CommentCreated) {
            $message = "💬 New Comment on Task #{$event->comment->task_id}: " . $event->comment->body;
        }

        if ($message) {
            SendTelegramMessageJob::dispatch($message);
        }
    }
}
