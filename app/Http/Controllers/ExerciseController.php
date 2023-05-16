<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use Illuminate\Http\Request;


class ExerciseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $exercises = Exercise::all();
            return response()->json([
                'success' => true,
                'message' => 'Exercises loaded successfully',
                'data' => $exercises
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error loading exercises',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required',
                'bodypart' => 'required',
                'level' => 'required',
                'description' => 'required',
            ]);

            if ($validated) {
                $exercise = new Exercise;
                $exercise->name = $request['name'];
                $exercise->bodypart = $request['bodypart'];
                $exercise->level = $request['level'];
                $exercise->description = $request['description'];

                if ($exercise->save()) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Exercises stored successfully',
                        'data' => $exercise
                    ], 200);
                }
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error storing exercise',
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
            $exercise = Exercise::where('id', $id)->first();
            return response()->json([
                'success' => true,
                'message' => 'Exercises loaded successfully',
                'data' => $exercise
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error loading exercise',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Exercise $exercise)
    {
        try {
            $validated = $request->validate([
                'name' => 'required',
                'bodypart' => 'required',
                'level' => 'required',
                'description' => 'required',
            ]);

            if ($validated) {
                $exercise->name = $request['name'];
                $exercise->bodypart = $request['bodypart'];
                $exercise->level = $request['level'];
                $exercise->description = $request['description'];
                if ($exercise->save()) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Exercise modified successfully',
                        'data' => $exercise
                    ], 200);
                }
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error modifying exercise',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($exercise_id)
    {
        try {
            $exercise = Exercise::where('id', $exercise_id)->first();
            if ($exercise->delete()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Exercise removed successfully',
                ], 200);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error removing exercise',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
