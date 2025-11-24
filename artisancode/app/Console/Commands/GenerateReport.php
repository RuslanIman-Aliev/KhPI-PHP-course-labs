<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Project;
use App\Models\Report;
use Illuminate\Support\Facades\Storage;

class GenerateReport extends Command
{
    protected $signature = 'app:generate-report';
    protected $description = 'Generate task statistics report';

    public function handle()
    {
        $stats = Project::withCount([
            'tasks as total',
            'tasks as new_count' => function ($query) {
                $query->where('status', 'new');
            },
            'tasks as in_progress_count' => function ($query) {
                $query->where('status', 'in_progress');
            },
            'tasks as done_count' => function ($query) {
                $query->where('status', 'done');
            }
        ])->get()->map(function ($project) {
            return [
                'project_id' => $project->id,
                'name' => $project->name,
                'stats' => [
                    'total' => $project->total,
                    'new' => $project->new_count,
                    'in_progress' => $project->in_progress_count,
                    'done' => $project->done_count,
                ]
            ];
        });

        $json = $stats->toJson(JSON_PRETTY_PRINT);

        $filename = 'report_' . now()->format('Y_m_d_H_i_s') . '.json';
        Storage::put('reports/' . $filename, $json);

        Report::create([
            'period_start' => now()->subDay(),
            'period_end' => now(),
            'payload' => $stats->toArray(),
            'path' => 'reports/' . $filename
        ]);

        $this->info('Report generated successfully: ' . $filename);
    }
}
