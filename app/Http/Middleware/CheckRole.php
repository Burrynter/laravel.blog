<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
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
    public function handle($request, Closure $next, $role)
    {
        if($request->user = Auth::user()) {
            if (! $request->user()->hasRole($role)) {
                return redirect('/')->with('error', 'Вы не имеете достаточно прав для посещения данной страницы');
            }
            
            return $next($request);
        }
    }
}
