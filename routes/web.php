<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FirebaseLoginController;
use App\Livewire\Login;
use App\Livewire\Welcome;
use App\Livewire\Dashboard;
use App\Livewire\TournamentsList;
use App\Livewire\TournamentPage;
use App\Livewire\TournamentGamePage;
use App\Livewire\PlayersList;
use App\Livewire\PlayerPage;

Route::get('/', Welcome::class);
Route::get('/login', Login::class)->name('login')->middleware('guest');

Route::post('/login/firebase', [FirebaseLoginController::class, 'login']);

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');

    Route::get('/players', PlayersList::class)->name('players.index');
    Route::get('/players/create', PlayerPage::class)->name('players.create');
    Route::get('/players/{player}', PlayerPage::class)->name('players.show');
    Route::get('/players/{player}/edit', PlayerPage::class)->name('players.edit');    
    
    Route::get('/tournaments', TournamentsList::class)->name('tournaments.index');
    Route::get('/tournaments/create', TournamentPage::class)->name('tournaments.create');
    Route::get('/tournaments/{tournament}', TournamentPage::class)->name('tournaments.show');
    Route::get('/tournaments/{tournament}/edit', TournamentPage::class)->name('tournaments.edit');

    Route::get('/tournaments/{tournament}/games/{game}', TournamentGamePage::class)->name('tournaments.games.show');
    Route::get('/tournaments/{tournament}/games/{game}/edit', TournamentGamePage::class)->name('tournaments.games.edit');

});