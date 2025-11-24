<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            ['name'=>'Alice Johnson','email'=>'alice@example.com','password'=>Hash::make('password')],
            ['name'=>'Bob Smith','email'=>'bob@example.com','password'=>Hash::make('password')],
            ['name'=>'Carol White','email'=>'carol@example.com','password'=>Hash::make('password')],
            ['name'=>'David Brown','email'=>'david@example.com','password'=>Hash::make('password')],
            ['name'=>'Eve Black','email'=>'eve@example.com','password'=>Hash::make('password')],
            ['name'=>'Frank Green','email'=>'frank@example.com','password'=>Hash::make('password')],
        ];

        DB::table('users')->insert($users);
    }
}
