<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExerciseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $exercise = [
            'name' => 'Push Up',
            'bodypart' => 'legs',
            'level' => 1,
            'description' => 'hola'
        ];
        DB::table('exercises')->insert($exercise);
    }
}
