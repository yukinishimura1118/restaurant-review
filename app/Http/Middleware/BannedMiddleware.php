<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BannedMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->is_banned) {
            auth()->logout();

            return redirect('/login')
                ->with('error', 'このアカウントはBANされています。');
        }

        return $next($request);
    }
}
