<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check() || auth()->user()->email !== 'admin@petshop.com') {
            abort(403, 'Accès refusé. Seuls les administrateurs peuvent accéder à cette page.');
        }

        return $next($request);
    }
}