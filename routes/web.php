<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CandidatesController;
use App\Http\Controllers\SkillsController;
use App\Http\Controllers\JobsController;
use App\Http\Controllers\SkillSetController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('kandidat', CandidatesController::class);
Route::resource('skills', SkillsController::class);
Route::resource('job', JobsController::class);
Route::resource('skill-set', SkillSetController::class);