<?php 

use App\Models\Tournament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TournamentController;
use App\Http\Controllers\TournamentGameController;
use App\Http\Controllers\TournamentPlayerController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Log;

Route::middleware('firebase')->group(function () {
    Route::get('/me', [UserController::class, 'me']);

    Route::get('/tournaments', [TournamentController::class, 'index']);
    Route::post('/tournaments', [TournamentController::class, 'store']);
    Route::get('/tournaments/{id}', [TournamentController::class, 'show']);    
    Route::put('/tournaments/{tournament}', [TournamentController::class, 'update']);
    Route::delete('/tournaments/{tournament}', [TournamentController::class, 'destroy']);
    
    Route::post('/tournaments/{tournament}/games/bulk', [TournamentGameController::class, 'storeBulk']);
    Route::put('/tournaments/{tournament}/games/{game}', [TournamentGameController::class, 'update']);

    Route::post('/tournaments/{tournament}/players', [TournamentPlayerController::class, 'store']); 
    Route::delete('/tournaments/{tournament}/players/{player}', [TournamentPlayerController::class, 'destroy']);

    Route::post('/players', [PlayerController::class, 'create']);

});


