<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'=>'Koenraad',
            'email'=>'decrooskoenraad@gmail.com',
            'password'=>bcrypt('12345678'),
            'is_admin'=>1,
        ]);
        DB::table('users')->insert([
            'name'=>'Trees',
            'email'=>'trees@gmail.com',
            'password'=>bcrypt('87654321'),
            'is_admin'=>0,
        ]);
        DB::table('users')->insert([
            'name'=>'Tom',
            'email'=>'Tom@gmail.com',
            'password'=>bcrypt('Hallo123'),
            'is_admin'=>1,
        ]);

        \App\Models\User::factory(10)->create();
        \App\Models\Task::factory(10)->create();
    }
}
