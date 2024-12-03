<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if (! $request->expectsJson()) {
            $response = [
                'success' => false,
                'status' =>401,
                'message' => 'Unauthenticated .',
                'data' => [],

            ];

            return abort(response()->json($response , 401));

        }
    }
}
