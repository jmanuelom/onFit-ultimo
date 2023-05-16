<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Exercise;
use App\Models\Training;
use App\Models\User_Training;

class User_TrainingController extends Controller
{
    public function index()
    {
        try {
            $user_training = User_Training::with(['user', 'training'])->get();

            return response()->json([
                'success' => true,
                'message' => 'user_trainings loaded successfully',
                'data' => $user_training
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error loading user-trainings',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'user_id' => 'required',
                'training_id' => 'required',
                'rating' => 'required'
            ]);
            if ($validated) {
                $user_training = new User_Training;
                $user_training->user_id = $request['user_id'];
                $user_training->training_id = $request['training_id'];
                $user_training->rating = $request['rating'];
                $user_training->date = $request['date'];
                if ($user_training->save()) {
                    return response()->json([
                        'success' => true,
                        'message' => 'User_training created successfully',
                        'data' => $user_training
                    ], 200);
                }
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating user_training',
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
            $user_training = User_training::where('id', $id)->with(['user', 'training'])->get();
            return response()->json([
                'success' => true,
                'message' => 'User_Training loaded successfully',
                'data' => $user_training
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error loading user_training',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function trainingsByUserId($user_id)
    {
        try {
            $user_trainings = User_training::where('user_id', $user_id)->with(['user', 'training'])->get();
            if ($user_trainings) {
                return response()->json([
                    'success' => true,
                    'message' => 'User_Trainings by user_id loaded successfully',
                    'data' => $user_trainings
                ], 200);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error loading user_trainings',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    /*public function update(User_Training $user_training)
    {
        try {
            $user_training_validated = $user_training->validate([
                'user_id' => 'required',
                'training_id' => 'required',
                'rating' => 'required'
            ]);


            if ($user_training_validated) {
                $user_training->training_id = $user_training['training_id'];
                $user_training->user_id = $user_training['user_id'];
                $user_training->rating = $user_training['rating'];
                if ($user_training->save()) {
                    return response()->json([
                        'success' => true,
                        'message' => 'User_training modified successfully',
                        'data' => $user_training
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
    }*/

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($user_training_id)
    {
        try {
            $user_training = User_Training::where('id', $user_training_id)->first();
            if ($user_training->delete()) {
                return response()->json([
                    'success' => true,
                    'message' => 'User_training removed successfully',
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
