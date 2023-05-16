<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exercise;
use App\Models\Training;
use App\Models\Training_Exercise;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class Training_ExerciseController extends Controller
{

    public function index()
    {
        try {
            $training_exercises = Training_Exercise::with(['training', 'exercise'])->get();
            return response()->json([
                'success' => true,
                'message' => 'Training_exercises loaded successfully',
                'data' => $training_exercises
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error loading training_exercises',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'training_id' => 'required',
                'exercise_id' => 'required',
            ]);
            if ($validated) {
                $training_exercise = new Training_Exercise;
                $training_exercise->training_id = $request['training_id'];
                $training_exercise->exercise_id = $request['exercise_id'];
                if ($training_exercise->save()) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Training_exercise created successfully',
                        'data' => $training_exercise
                    ], 200);
                }
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating training_exercise',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $training_exercises = Training_exercise::where('id', $id)->with(['training', 'exercise'])->get();
            return response()->json([
                'success' => true,
                'message' => 'Training_exercise loaded successfully',
                'data' => $training_exercises
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error loading training_exercise',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function exercisesByTrainingId($training_id)
    {
        try {
            $training_exercises = Training_Exercise::where('training_id', $training_id)->with(['training', 'exercise'])->get();
            if ($training_exercises) {
                return response()->json([
                    'success' => true,
                    'message' => 'Training_exercises by training_id loaded successfully',
                    'data' => $training_exercises
                ], 200);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error loading user_trainings by training_id',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    /**
     * Update the specified resource in storage.
     */
    /*public function update($id, $exercise_id)
    {
        try {
            $validator = Validator::make(['id' => $id], [
                'id' => [
                    'required',
                    'integer',
                    Rule::exists('training_exercise', 'id')
                ],
            ]);

            $training_exercise = Training_exercise::where('id', $id)->first();
            if ($validator->passes()) {
                if ($request['training_id'] && $request['exercise_id']) {
                    $training_exercise->training_id = $request['training_id'];
                    $training_exercise->exercise_id = $request['exercise_id'];
                } else if ($request['training_id']) {
                    $training_exercise->training_id = $request['training_id'];
                } else {
                    $training_exercise->exercise_id = $request['exercise_id'];
                }
                if ($training_exercise->exercise->contains('id', $exercise_id)) {
                    
                } else {
                    // $exercise_id no existe en la instancia $training_exercise
                }
                    
                 
                


                if ($training_exercise->save()) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Training_exercise modified successfully',
                        'data' => $training_exercise
                    ], 200);
                }
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error modifying training_exercise',
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
            ], 500);
        }
    }*/

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($training_exercise_id)
    {
        try {
            $training_exercise = Training_exercise::where('id', $training_exercise_id)->first();
            if ($training_exercise->delete()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Training_exercise removed successfully',
                ], 200);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error removing user_training',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
