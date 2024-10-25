<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckTwoFactorAuth
{
public function handle(Request $request, Closure $next)
{
if (auth()->check() && auth()->user()->two_factor_enabled && !session('two_factor_authenticated')) {
return redirect()->route('2fa.verify');
}

return $next($request);
}
}
