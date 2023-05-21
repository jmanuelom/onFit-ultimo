<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Training_Exercise;
use Exception;

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
                'trainingId' => 'required',
                'exerciseId' => 'required',
            ]);
            $duplicated = Training_Exercise::where('trainingId', $request['trainingId'])->where('exerciseId', $request['exerciseId'])->first();
            if ($duplicated) {
                throw new Exception('Error: The exerciseId already exists for this trainingId.');
            }
            if ($validated) {
                $training_exercise = new Training_Exercise;
                $training_exercise->trainingId = $request['trainingId'];
                $training_exercise->exerciseId = $request['exerciseId'];
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

    public function exercisesByTrainingId($trainingId)
    {
        try {
            $training_exercises = Training_Exercise::where('trainingId', $trainingId)->with(['training', 'exercise'])->get();
            if ($training_exercises) {
                return response()->json([
                    'success' => true,
                    'message' => 'Training_exercises by trainingId loaded successfully',
                    'data' => $training_exercises
                ], 200);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error loading user_trainings by trainingId',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    /**
     * Update the specified resource in storage.
     */
    /*public function update($id, $exerciseId)
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
                if ($request['trainingId'] && $request['exerciseId']) {
                    $training_exercise->trainingId = $request['trainingId'];
                    $training_exercise->exerciseId = $request['exerciseId'];
                } else if ($request['trainingId']) {
                    $training_exercise->trainingId = $request['trainingId'];
                } else {
                    $training_exercise->exerciseId = $request['exerciseId'];
                }
                if ($training_exercise->exercise->contains('id', $exerciseId)) {
                    
                } else {
                    // $exerciseId no existe en la instancia $training_exercise
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
    public function destroy($trainingId)
    {
        try {
            $training_exercise = Training_exercise::where('trainingId', $trainingId)->get();
            foreach ($training_exercise as $value) {
                $value->delete();
            }

            return response()->json([
                'success' => true,
                'message' => 'Training_exercise removed successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error removing user_training',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
