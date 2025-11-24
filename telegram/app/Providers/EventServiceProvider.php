<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Events\TaskCreated;
use App\Events\CommentCreated;
use App\Listeners\SendTelegramNotification;
use App\Listeners\SendTaskCreatedNotification;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        TaskCreated::class => [
            SendTelegramNotification::class,
        ],
        CommentCreated::class => [
            SendTelegramNotification::class,
        ],
    ];

    public function boot(): void
    {
        //
    }
}
