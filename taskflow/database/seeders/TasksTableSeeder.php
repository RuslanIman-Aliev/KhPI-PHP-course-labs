<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TasksTableSeeder extends Seeder
{
    public function run()
    {
        $tasks = [
            ['project_id'=>1,'author_id'=>1,'assignee_id'=>2,'title'=>'Create wireframes','description'=>'Initial wireframes for homepage','status'=>'open','priority'=>'high','due_date'=>'2025-02-15'],
            ['project_id'=>1,'author_id'=>2,'assignee_id'=>3,'title'=>'Implement header','description'=>'Responsive header component','status'=>'in_progress','priority'=>'normal','due_date'=>'2025-02-20'],
            ['project_id'=>2,'author_id'=>2,'assignee_id'=>4,'title'=>'Auth API','description'=>'Design authentication API endpoints','status'=>'open','priority'=>'high','due_date'=>'2025-03-01'],
            ['project_id'=>3,'author_id'=>3,'assignee_id'=>5,'title'=>'Ad creatives','description'=>'Create banner ads','status'=>'open','priority'=>'low','due_date'=>'2025-02-28'],
            ['project_id'=>4,'author_id'=>4,'assignee_id'=>4,'title'=>'Migrate DB','description'=>'Move legacy DB to new schema','status'=>'in_progress','priority'=>'high','due_date'=>'2025-02-10'],
            ['project_id'=>5,'author_id'=>1,'assignee_id'=>6,'title'=>'Onboarding emails','description'=>'Email sequence for onboarding','status'=>'open','priority'=>'normal','due_date'=>'2025-03-05'],
        ];

        DB::table('tasks')->insert($tasks);
    }
}
