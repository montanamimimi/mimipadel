<?php 

use App\Models\Task;
use Illuminate\Support\Facades\Route;

Route::get('/tasks', function () {
    return Task::all();
});