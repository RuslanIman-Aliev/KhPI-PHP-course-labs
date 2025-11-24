<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Task;
use App\Models\SchedulerLog;
use App\Jobs\SendTelegramNotification;
use Carbon\Carbon;

class CheckExpiredTasks extends Command
{
    protected $signature = 'app:check-expired-tasks';
    protected $description = 'Перевіряє задачі in_progress понад 7 днів';

    public function handle()
    {
        $this->info('Початок перевірки задач...');
        try {
            $tasks = Task::where('status', 'in_progress')
                         ->where('updated_at', '<', Carbon::now()->subDays(7))
                         ->get();
            $count = 0;
            foreach ($tasks as $task) {
                $task->update(['status' => 'expired']);
                SendTelegramNotification::dispatch($task);
                $count++;
            }
            $message = "Оброблено задач: {$count}";
            $this->info($message);
            SchedulerLog::create([
                'command_name' => 'app:check-expired-tasks',
                'status' => 'success',
                'message' => $message,
                'executed_at' => now(),
            ]);
        } catch (\Exception $e) {
            SchedulerLog::create([
                'command_name' => 'app:check-expired-tasks',
                'status' => 'failed',
                'message' => $e->getMessage(),
                'executed_at' => now(),
            ]);
            $this->error('Помилка: ' . $e->getMessage());
        }
    }
}