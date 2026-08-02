<?php 

use App\Models\Tournament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TournamentController;
use App\Http\Controllers\UserController;

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

    Route::post('/tournaments', function (Request $request) {
        return Tournament::create([
            'name' => $request->name,
            'date' => now()->toDateString(),
            'finished' => false,
        ]);
    });    
});


