<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FirebaseLoginController;
use App\Livewire\Login;
use App\Livewire\Welcome;
use App\Livewire\Dashboard;
use App\Livewire\TournamentsList;
use App\Livewire\Tournaments\BaseTournamentPage;
use App\Livewire\Tournaments\AdminTournamentPage;
use App\Livewire\TournamentGamePage;
use App\Livewire\PlayersList;
use App\Livewire\PlayerPage;

Route::get('/', Welcome::class);
Route::get('/login', Login::class)->name('login')->middleware('guest');

Route::post('/login/firebase', [FirebaseLoginController::class, 'login']);

Route::get('/tournaments/{tournament}', BaseTournamentPage::class)
    ->name('tournaments.show');
Route::get('/players', PlayersList::class)->name('players.index');
Route::get('/player/{player}', PlayerPage::class)->name('players.show');   

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');


    Route::get('/players/create', PlayerPage::class)->name('players.create');
    Route::get('/player/{player}/edit', PlayerPage::class)->name('players.edit');    
    
    Route::get('/my/tournaments', TournamentsList::class)->name('admin.tournaments.index');
    Route::get('/my/tournaments/create', AdminTournamentPage::class)->name('admin.tournaments.create');
    Route::get('/my/tournaments/{tournament}/edit', AdminTournamentPage::class)->name('admin.tournaments.edit');

    Route::get('/tournaments/{tournament}/games/{game}', TournamentGamePage::class)->name('tournaments.games.show');
    Route::get('/tournaments/{tournament}/games/{game}/edit', TournamentGamePage::class)->name('tournaments.games.edit');

});