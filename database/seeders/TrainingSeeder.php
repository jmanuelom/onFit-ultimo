<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TrainingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $training = [
            'name' => 'entrenamiento 1',
            'level' =>  2,
            'unique' => true
        ];
        DB::table('trainings')->insert($training);
    }
}
