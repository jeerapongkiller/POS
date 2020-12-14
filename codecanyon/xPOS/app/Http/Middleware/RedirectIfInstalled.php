<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfInstalled
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(config('app.install') == 0){
            return $next($request);
        }else{
            if(auth()->check() && auth()->user()->role == 1){
                return $next($request);
            }else{
                return redirect()->to('/');
            }
        }

    }
}
