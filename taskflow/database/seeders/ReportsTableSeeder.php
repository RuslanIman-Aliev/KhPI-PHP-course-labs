<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReportsTableSeeder extends Seeder
{
    public function run()
    {
        $reports = [
            ['period_start'=>'2025-01-01','period_end'=>'2025-01-31','payload'=>json_encode(['summary'=>'January report']),'path'=>null],
            ['period_start'=>'2025-02-01','period_end'=>'2025-02-28','payload'=>json_encode(['summary'=>'February report']),'path'=>null],
        ];

        DB::table('reports')->insert($reports);
    }
}
