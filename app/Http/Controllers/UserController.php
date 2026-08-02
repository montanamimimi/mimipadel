<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function me(Request $request)
    {

        // Log::debug('An informational message.');
        // Log::debug($request);
        // Log::debug(Auth::user());

        return response()->json([
            'user' => Auth::user(),
        ]);
    }
}