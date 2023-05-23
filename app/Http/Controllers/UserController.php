<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Database\QueryException;

class UserController extends Controller
{

    public function login(Request $request)
    {
        try {
            if ($request['email'] && $request['password']) {
                $user = User::where('email', $request['email'])->first();

                if (!$user) {
                    // No se encontró ningún usuario con las credenciales proporcionadas
                    return response()->json([
                        'success' => false,
                        'message' => 'Credenciales inválidas',
                    ], 422);
                }
                if ($user->password == $request['password']) {
                    unset($user->password);

                    return response()->json([
                        'success' => true,
                        'message' => 'User verified.',
                        'data' => $user
                    ], 200);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => "Passwords don't match",
                    ], 500);
                }
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error validating user',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function index()
    {
        try {
            $users = User::all();
            return response()->json([
                'status' => 'ok',
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
                'name' => 'required',
                'password' => 'required',
                'email' => 'required',
                'level' => 'required',
                'subscription' => 'required'
            ]);
            if ($validated) {
                $user = new User;
                $user->name = $request['name'];
                $user->lastName = $request['lastName'];
                $user->password = $request['password'];
                $user->email = $request['email'];
                $user->level = $request['level'];
                $user->subscription = $request['subscription'];
                $user->birthdate = $request['birthdate'];
                $user->image = $request['image'];
                if ($user->save()) {
                    return response()->json([
                        'success' => true,
                        'message' => 'User stored successfully',
                        'data' => $user
                    ], 200);
                }
            }
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                // El campo "email" ya existe en la base de datos
                return response()->json(['message' => 'El correo electrónico ya está registrado.'], 422);
            } else {
                // Otro error de la base de datos
                return response()->json([
                    'success' => false,
                    'message' => 'Error al crear el usuario.'
                ], 500);
            }
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
    public function update($id, Request $request)
    {
        try {
            $user = $request->input('user');
            $newPassword = $request->input('newPassword');

            $userModel = User::find($id);
            $userModel->name = $user['name'];
            $userModel->lastName = $user['lastName'];
            // Verifica y actualiza la contraseña solo si se proporciona una nueva contraseña válida
            if (!empty($newPassword) && $userModel->password == $user['password']) {
                $userModel->password = $newPassword;
            }
            $userModel->email = $user['email'];
            $userModel->level = $user['level'];
            $userModel->subscription = $user['subscription'];
            $userModel->birthdate = $user['birthdate'];
            $userModel->image = $user['image'];
            if ($userModel->save()) {
                return response()->json([
                    'success' => true,
                    'message' => 'User modified successfully',
                    'data' => $user
                ], 200);
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
