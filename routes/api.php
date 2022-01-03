<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SkillsController;
use App\Http\Controllers\InterestsController;
use App\Http\Controllers\ExperienceController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/', [Controller::class, 'routes'])
    ->name('route information')
    ->withoutMiddleware('api');
Route::get('/example', [Controller::class, 'example'])->name('example route');
Route::get('/error', [Controller::class, 'error'])->name('error route');

//User
Route::get('/users/index', [UserController::class, 'index'])->name('Get All Users');
Route::get('/users/get/{id}', [UserController::class, 'show'])->name('Get Specific User');
Route::post('/users/store', [UserController::class, 'store'])->name('Store New User');
Route::put('/users/save/{id}', [UserController::class, 'update'])->name('Update User');
Route::delete('/user/delete/{id}', [UserController::class, 'destroy'])->name('Delete User');

//Experience
Route::get('/experience/index', [ExperienceController::class, 'index'])->name('Get All Experience');
Route::get('/experience/get/{id}', [ExperienceController::class, 'show'])->name('Get Specific Experience');
Route::post('/experience/store', [ExperienceController::class, 'store'])->name('Store New Experience');
Route::put('/experience/save/{id}', [ExperienceController::class, 'update'])->name('Update Experience');
Route::delete('/experience/delete/{id}', [ExperienceController::class, 'destroy'])->name('Delete Experience');

//Skills
Route::get('/skills/index', [SkillsController::class, 'index'])->name('Get All Skills');
Route::get('/skills/get/{id}', [SkillsController::class, 'show'])->name('Get Specific Skills');
Route::post('/skills/store', [SkillsController::class, 'store'])->name('Store New Skills');
Route::put('/skills/save/{id}', [SkillsController::class, 'update'])->name('Update Skills');
Route::delete('/skills/delete/{id}', [SkillsController::class, 'destroy'])->name('Delete Skills');

//Interests
Route::get('/interests/index', [InterestsController::class, 'index'])->name('Get All Interests');
Route::get('/interests/get/{id}', [InterestsController::class, 'show'])->name('Get Specific Interests');
Route::post('/interests/store', [InterestsController::class, 'store'])->name('Store New Interests');
Route::put('/interests/save/{id}', [InterestsController::class, 'update'])->name('Update Interests');
Route::delete('/interests/delete/{id}', [InterestsController::class, 'destroy'])->name('Delete Interests');
