<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Login;
use App\Livewire\Welcome;

Route::get('/', Welcome::class);
Route::get('/login', Login::class)->name('login');