<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $roles)
    {
        if (! $request->user()->hasAnyRole($roles)) {

            $response = [
                'message' => 'Sorry, your role doesnt allow you!'
            ];
                
            return response($response, 401);
        }

        return $next($request);
    }
}
