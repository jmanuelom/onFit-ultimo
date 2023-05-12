<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExerciseRequest;
use App\Http\Requests\UpdateExerciseRequest;
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
            return response()->json($exercises);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error loading exercises'], 500);
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
                    return response()->json(['message' => 'Exercise created succesfully'], 201);
                }
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error creating exercise'], 500);
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(Exercise $exercise)
    {
        try {
            $exercise = Exercise::where('id', $exercise->id)->first();
            return response()->json($exercise);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error loading exercise'], 500);
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
                    return response()->json(['message' => 'Exercise modified succesfully'], 201);
                }
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error modifying exercise'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exercise $exercise)
    {
        try {
            if ($exercise->delete()) {
                return response()->json(['message' => 'Exercise removed succesfully'], 201);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error removing exercise'], 500);
        }
    }
}
