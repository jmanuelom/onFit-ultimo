<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\User_TrainingController;
use App\Http\Controllers\Training_ExerciseController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::resource('/user', UserController::class);
Route::resource('/training', TrainingController::class);
Route::resource('/exercise', ExerciseController::class);
Route::resource('/user_training', User_TrainingController::class);
Route::get('/user_training/user/{id}', [User_TrainingController::class, 'trainingsByUserId']);
Route::resource('/training_exercise', Training_ExerciseController::class);
Route::get('/training_exercise/training/{id}', [Training_ExerciseController::class, 'exercisesByTrainingId']);
Route::delete('/training_exercise/exercise/{training_id}/{exercise_id}', [Training_ExerciseController::class, 'removeExercise']);
Route::post('/login', [LoginController::class, 'login']);
Route::post('/register', [RegisterController::class, 'register']);
