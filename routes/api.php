<?php 

use App\Models\Tournament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TournamentController;

Route::get('/tournaments', function () {
    return Tournament::all();
});

Route::get('/tournament/{id}', function (Request $request) {
    return Tournament::findOrFail($request->id);
});

Route::middleware('api.password')->group(function () {    
    Route::post('/tournaments', function (Request $request) {
        return Tournament::create([
            'name' => $request->name,
            'date' => now()->toDateString(),
            'finished' => false,
        ]);
    });
});

Route::middleware('api.password')->group(function() {
    Route::put('/tournaments/{tournament}', [TournamentController::class, 'update']);
});

Route::middleware('api.password')->group(function() {
    Route::delete('/tournaments/{tournament}', [TournamentController::class, 'delete']);
});