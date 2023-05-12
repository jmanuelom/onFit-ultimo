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
            return response()->json($users);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error loading users'], 500);
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

            $user = new User;
            $user->name = $request['username'];
            $user->price = $request['password'];
            $user->country = $request['email'];
            $user->category_id = $request['subscription'];
            if ($user->save()) {
                return response()->json(['message' => 'User created succesfully'], 201);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error creating user'], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * 
     */
    public function show(User $user)
    {
        try {
            $user = User::where('id', $user->id)->get();
            return response()->json($user);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error loading user'], 500);
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
    public function update(Request $request, User $user)
    {
        try {
            $validated = $request->validate([
                'username' => 'required',
                'password' => 'required',
                'email' => 'required',
                'subscription' => 'required'
            ]);

            $user->username = $request['username'];
            $user->password = $request['password'];
            $user->email = $request['email'];
            $user->subscription = $request['subscription'];
            if ($user->save()) {
                return response()->json(['message' => 'User modified succesfully'], 201);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error modifying user'], 500);
        }
    }

    public function destroy(User $user)
    {
        try {
            if ($user->delete()) {
                return response()->json(['message' => 'User removed succesfully'], 201);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error removing user'], 500);
        }
    }
}
