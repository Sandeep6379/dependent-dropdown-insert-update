<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [StudentController::class,'loadAddStudent']);
Route::post('/', [StudentController::class,'addStudent']);

Route::get('/get-plans/{id}', [StudentController::class,'getPlans']);

Route::get('/edit-student/{id}', [StudentController::class,'editStudentLoad']);

Route::post('/edit-student', [StudentController::class,'updateStudent'])->name('updateStudent');