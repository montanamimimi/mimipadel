<?php

namespace App\Http\Controllers;

use Throwable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class FirebaseLoginController extends Controller
{
    public function login(Request $request)
    {
        try {
            if (!$request->token) {
                Log::warning('Firebase login: token missing');

                return response()->json([
                    'message' => 'Firebase token is missing.',
                ], 422);
            }
            
            try {
                $verifiedIdToken = app('firebase.auth')->verifyIdToken(
                    $request->token
                );
            }
            catch (Throwable $e) {
                Log::error('Firebase login: token verification failed', [
                    'error' => $e->getMessage(),
                ]);

                return response()->json([
                    'message' => 'Invalid Firebase token.',
                ], 401);
            }

            $firebaseUid = $verifiedIdToken->claims()->get('sub');

            if (!$firebaseUid) {
                Log::error('Firebase login: UID missing');

                return response()->json([
                    'message' => 'Firebase UID is missing.',
                ], 401);
            }            

            $user = User::where('firebase_uid', $firebaseUid)->first();

            if (!$user) {
                $user = User::create([
                    'firebase_uid' => $firebaseUid,
                    'name' => '',
                    'email' => $verifiedIdToken->claims()->get('email'),
                ]);

                Log::info('Firebase login: user created', [
                    'user_id' => $user->id,
                    'firebase_uid' => $firebaseUid,
                ]);
            }

            Auth::login($user);

            return response()->json([
                'redirect' => route('dashboard'),
            ]);            
        }
        catch (Throwable $e) {
            Log::error('Firebase login: unexpected error', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            return response()->json([
                'message' => 'Login failed.',
            ], 500);
        }


    }
}
