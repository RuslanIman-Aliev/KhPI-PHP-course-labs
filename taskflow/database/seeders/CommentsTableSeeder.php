<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentsTableSeeder extends Seeder
{
    public function run()
    {
        $comments = [
            ['task_id'=>1,'author_id'=>2,'body'=>'Looks good, I suggest adjusting spacing.'],
            ['task_id'=>1,'author_id'=>3,'body'=>'I can take the responsive part.'],
            ['task_id'=>2,'author_id'=>2,'body'=>'Header component ready for review.'],
            ['task_id'=>3,'author_id'=>4,'body'=>'Auth endpoints documented.'],
            ['task_id'=>4,'author_id'=>5,'body'=>'Draft creatives uploaded.'],
            ['task_id'=>5,'author_id'=>4,'body'=>'Migration script in progress.'],
        ];

        DB::table('comments')->insert($comments);
    }
}
