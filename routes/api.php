<?php

use Illuminate\Http\Request;
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



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login','AuthController@login')->name('login');
Route::get('/logout','AuthController@logout')->middleware('auth:sanctum')->name('logout');

Route::group(['middleware' => ['auth:sanctum', 'role:superadmin|rh']], function (){
    
    Route::patch('/collaborator/{id}','UserController@updateCollaborator');
    Route::delete('/collaborator/{id}','UserController@removeCollaborator');
    Route::delete('/archive-collaborator/{id}','UserController@archiveCollaborator');
    Route::post('/collaborator','UserController@addCollaborator');
    Route::get('/collaborators-archive','UserController@showArchive');

    Route::get('/training/{id}','TrainingController@show');
    Route::post('/training/{id}','TrainingController@addTraining');

    Route::get('/skill/{id}','SkillController@show');
    Route::post('/skill/{id}','SkillController@addSkill');

    Route::get('/eval/{id}','EvalController@show');
    Route::post('/eval/{id}','EvalController@addEval');
    }
);


    
Route::get('/collaborators','UserController@showAll')->middleware('auth:sanctum', 'role:superadmin|rh|projectmanager');
Route::get('/collaborator/{id}','UserController@show')->middleware('auth:sanctum');

