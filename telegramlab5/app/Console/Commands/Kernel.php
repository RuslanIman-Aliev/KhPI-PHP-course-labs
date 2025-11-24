<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
        protected function schedule(Schedule $schedule): void
    {
        $schedule->command('app:check-expired-tasks')
                 ->daily();

        $schedule->command('app:generate-report')
                 ->weeklyOn(1, '09:00');
    }

   
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
