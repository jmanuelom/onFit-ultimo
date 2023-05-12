<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTrainingRequest;
use App\Http\Requests\UpdateTrainingRequest;
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
            $training = Training::all();
            return response()->json($training);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error loading trainings'], 500);
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
            ]);
            if ($validated) {
                $training = new Training;
                $training->name = $request['name'];
                $training->level = $request['level'];
                if ($training->save()) {
                    return response()->json(['message' => 'Training created succesfully'], 201);
                }
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error creating training'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Training $training)
    {
        try {
            $training = Training::where('id', $training->id)->first();
            return response()->json($training);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error loading training'], 500);
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
            $training->name = $request['name'];
            $training->level = $request['level'];
            if ($training->save()) {
                return response()->json(['message' => 'Exercise modified succesfully'], 201);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error modifying training'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Training $training)
    {
        try {
            $training->delete();
            return response()->json(['message' => 'Training removed succesfully'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error removing training'], 500);
        }
    }
}
