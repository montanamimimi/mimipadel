<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class FirebaseLoginController extends Controller
{
    public function login(Request $request)
    {
        $verifiedIdToken = app('firebase.auth')->verifyIdToken(
            $request->token
        );

        $firebaseUid = $verifiedIdToken->claims()->get('sub');

        $user = User::where('firebase_uid', $firebaseUid)->first();

        if (! $user) {
            return response()->json([
                'message' => 'User not found. Please contact support to link your account.',
            ], 404);
        }

        Auth::login($user);

        return response()->json([
            'redirect' => route('dashboard'),
        ]);
    }
}
