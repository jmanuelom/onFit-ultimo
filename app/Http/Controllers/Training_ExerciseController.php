<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exercise;
use App\Models\Training;

class Training_ExerciseController extends Controller
{

    public function deleteExercise($trainingId, $exerciseId)
    {
        $selectedTraining = Training::where('id', $trainingId)->first();
        $selectedExercise = Exercise::where('id', $exerciseId)->first();
        if ($selectedTraining && $selectedExercise && $selectedTraining->$selectedExercise) {
            $selectedTraining->$selectedExercise->delete();
        }
    }

    public function addExercise($exerciseId, $trainingId)
    {
        $selectedTraining = Training::where('id', $trainingId)->first();
        $selectedExercise = Exercise::where('id', $exerciseId)->first();
        if ($selectedTraining && $selectedExercise && !$selectedTraining->$selectedExercise)
            $selectedTraining->$selectedExercise->store();
    }



    public function getTraining($id)
    {
        $training = Training::where('id', $id)->first();
        return response()->json($training);
    }
}
