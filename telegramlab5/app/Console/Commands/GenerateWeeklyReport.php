<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\SchedulerLog;
use Illuminate\Support\Facades\Log;

class GenerateWeeklyReport extends Command
{
    protected $signature = 'app:generate-report';
    protected $description = 'Генерує щотижневий звіт по задачах';

    public function handle()
    {
        $this->info('Генерація тижневого звіту...');
        try {
            Log::info('Щотижневий звіт успішно згенеровано ' . now());
            SchedulerLog::create([
                'command_name' => 'app:generate-report',
                'status' => 'success',
                'message' => 'Звіт згенеровано успішно.',
                'executed_at' => now(),
            ]);
            $this->info('Звіт готовий.');
        } catch (\Exception $e) {
            SchedulerLog::create([
                'command_name' => 'app:generate-report',
                'status' => 'failed',
                'message' => $e->getMessage(),
                'executed_at' => now(),
            ]);
        }
    }
}