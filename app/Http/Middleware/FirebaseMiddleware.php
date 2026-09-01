<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;
use Kreait\Firebase\Contract\Auth as FirebaseAuth;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FirebaseMiddleware
{
    public function __construct(
        private FirebaseAuth $firebaseAuth
    ) {}

    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $token = $request->bearerToken();

        if (!$token) {
            return response()->json([
                'message' => 'No token'
            ], 401);
        }

        $verifiedToken = $this->firebaseAuth->verifyIdToken($token);

        $firebaseUid = $verifiedToken->claims()->get('sub');
        $email = $verifiedToken->claims()->get('email');
        
        $user = User::updateOrCreate(
            [
                'firebase_uid' => $firebaseUid,
            ],
            [
                'email' => $email,
            ]
        );

        Auth::login($user);   

        return $next($request);
    }
}
