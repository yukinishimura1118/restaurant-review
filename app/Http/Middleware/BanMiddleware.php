<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BanMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->is_banned) {
            auth()->logout();

            abort(403, 'このアカウントはBANされています。');
        }

        return $next($request);
    }
}
