<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\IssueController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/options/projects', 'App\Http\Controllers\ProjectController@getOptions');
Route::get('/options/trackers', 'App\Http\Controllers\TrackerController@getOptions');
Route::get('/options/statuses', 'App\Http\Controllers\StatusController@getOptions');

Route::group([
    'prefix' => 'projects'
], function (){

    Route::controller(ProjectController::class)->group(function() {
        Route::get('/', 'list')->name('project.list');
        Route::get('/create', 'create')->name('project.create');
        Route::post('/add', 'add')->name('project.add');
        Route::delete('/{project}', 'remove');
    });

});

Route::group([
    'prefix' => 'issues'
], function (){

    Route::controller(IssueController::class)->group(function() {
        Route::get('/', 'list')->name('issue.list');
        Route::get('/create', 'create')->name('issue.create');
        Route::post('/add', 'add')->name('issue.add');
        Route::delete('/{issue}', 'remove');
    });

    Route::get('/options/categories/{projectIdentify}', 'App\Http\Controllers\CategoryController@getOptions');
    Route::get('/options/versions/{projectIdentify}', 'App\Http\Controllers\VersionController@getOptions');
});

