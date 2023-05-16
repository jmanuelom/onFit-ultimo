<?php

namespace App\Http\Controllers;

use App\Models\Training;
use Illuminate\Http\Request;



class TrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $trainings = Training::all();
            return response()->json([
                'success' => true,
                'message' => 'Trainings loaded successfully',
                'data' => $trainings
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error loading trainings',
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
                'level' => 'required',
                'unique' => 'required'
            ]);

            if ($validated) {
                $training = new Training;
                $training->name = $request['name'];
                $training->level = $request['level'];
                $training->unique = $request['unique'];
                if ($training->save()) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Training created successfully',
                        'data' => $training
                    ], 200);
                }
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating training',
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
            $training = Training::where('id', $id)->first();
            return response()->json([
                'success' => true,
                'message' => 'Training loaded successfully',
                'data' => $training
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error loading training',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Training $training)
    {
        try {

            $validated = $request->validate([
                'name' => 'required',
                'level' => 'required'
            ]);
            if ($validated) {
                $training->name = $request['name'];
                $training->level = $request['level'];
                if ($training->save()) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Training modified successfully',
                        'data' => $training
                    ], 200);
                }
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error modifying training',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($training_id)
    {
        try {
            $training = Training::where('id', $training_id)->first();
            $training->delete();
            return response()->json([
                'success' => true,
                'message' => 'Training removed successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error removing training',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
