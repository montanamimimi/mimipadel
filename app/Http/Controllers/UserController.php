<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $fillable = [
        'firebase_uid',
        'name',
        'email',
    ];

    public function me(Request $request)
    {

        return response()->json([
            'user' => Auth::user(),
        ]);
    }
}