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
        ]);
        \App\Models\User::factory(100)->create();
    }
}
