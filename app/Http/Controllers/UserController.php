<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        try {
            $users = User::all();
            return response()->json([
                'success' => true,
                'message' => 'Users loaded successfully',
                'data' => $users
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error loading users',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     *
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * 
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'username' => 'required',
                'password' => 'required',
                'email' => 'required',
                'subscription' => 'required'
            ]);
            if ($validated) {
                $user = new User;
                $user->username = $request['username'];
                $user->password = $request['password'];
                $user->email = $request['email'];
                $user->subscription = $request['subscription'];
                if ($user->save()) {
                    return response()->json([
                        'success' => true,
                        'message' => 'User stored successfully',
                        'data' => $user
                    ], 200);
                }
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error storing users',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * 
     */
    public function show($id)
    {
        try {
            $user = User::where('id', $id)->get();
            return response()->json([
                'success' => true,
                'message' => 'User loaded successfully',
                'data' => $user
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error loading user',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * 
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * 
     */
    public function update(User $user, Request $request)
    {
        try {
            $validated = $request->validate([
                'username' => 'required',
                'password' => 'required',
                'email' => 'required',
                'subscription' => 'required'
            ]);
            if ($validated) {
                $user->username = $request['username'];
                $user->password = $request['password'];
                $user->email = $request['email'];
                $user->subscription = $request['subscription'];
                if ($user->save()) {
                    return response()->json([
                        'success' => true,
                        'message' => 'User modified successfully',
                        'data' => $user
                    ], 200);
                }
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error modifying user',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($user_id)
    {
        try {
            $user = User::where('id', $user_id)->first();
            if ($user->delete()) {
                return response()->json([
                    'success' => true,
                    'message' => 'User removed successfully'
                ], 200);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error removing user',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
