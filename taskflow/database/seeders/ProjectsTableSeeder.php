<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectsTableSeeder extends Seeder
{
    public function run()
    {
        $projects = [
            ['owner_id'=>1,'name'=>'Website Redesign','description'=>'Redesign corporate website.'],
            ['owner_id'=>2,'name'=>'Mobile App','description'=>'Develop mobile version of product.'],
            ['owner_id'=>3,'name'=>'Marketing Campaign','description'=>'Q3 marketing push.'],
            ['owner_id'=>4,'name'=>'Internal Tools','description'=>'Productivity improvements.'],
            ['owner_id'=>1,'name'=>'Client Onboarding','description'=>'Onboarding flows for new clients.'],
        ];

        DB::table('projects')->insert($projects);
    }
}
