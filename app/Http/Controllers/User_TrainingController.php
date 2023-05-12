<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Exercise;
use App\Models\Training;

class User_TrainingController extends Controller
{
    public function index(User $user)
    {
        $user = User::where('id', $user->id)->first();
        $trainings = $user->trainings;
        return response()->json($user, $trainings);
    }
}
