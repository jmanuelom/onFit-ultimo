<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;



class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'username' => 'prueba',
                'password' => '1234',
                'email' => 'a@a.com',
                'subscription' => true

            ]
        ];
        DB::table('users')->insert($users);
    }
}
