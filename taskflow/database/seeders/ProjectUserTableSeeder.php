<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectUserTableSeeder extends Seeder
{
    public function run()
    {
        $relations = [
            ['project_id'=>1,'user_id'=>1,'role'=>'owner'],
            ['project_id'=>1,'user_id'=>2,'role'=>'member'],
            ['project_id'=>1,'user_id'=>3,'role'=>'member'],
            ['project_id'=>2,'user_id'=>2,'role'=>'owner'],
            ['project_id'=>2,'user_id'=>4,'role'=>'member'],
            ['project_id'=>3,'user_id'=>3,'role'=>'owner'],
            ['project_id'=>3,'user_id'=>5,'role'=>'member'],
            ['project_id'=>4,'user_id'=>4,'role'=>'owner'],
            ['project_id'=>5,'user_id'=>1,'role'=>'owner'],
            ['project_id'=>5,'user_id'=>6,'role'=>'member'],
        ];

        DB::table('project_user')->insert($relations);
    }
}
