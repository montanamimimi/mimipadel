<?php 

use App\Models\Tournament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TournamentController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Log;

Route::middleware('firebase')->group(function () {
    Route::get('/me', [UserController::class, 'me']);
    Route::put('/tournaments/{tournament}', [TournamentController::class, 'update']);
    Route::delete('/tournaments/{tournament}', [TournamentController::class, 'delete']);
    Route::get('/tournaments', function () {
        return Tournament::all();
    });

    Route::get('/tournament/{id}', function (Request $request) {
        return Tournament::findOrFail($request->id);
    });
    
    Route::post('/tournaments', [TournamentController::class, 'create']);

    Route::post('/players', [PlayerController::class, 'create']);

});


