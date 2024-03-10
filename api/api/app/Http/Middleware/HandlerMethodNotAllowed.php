<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

class HandlerMethodNotAllowed
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            return $next($request);
        } catch (MethodNotAllowedHttpException $exception) {
            return response()->json([
                'status' => 403,
                'message' => 'No estás logueado, loguéate'
            ], 403);
        }
    }
}
