<?php

namespace App\Http\Middleware;

use App\Model\Outlet;
use Closure;

class CheckValidOutletUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $outlet_id = $request->route('outlet_id');
        $user = auth()->user();
        if ($user->role == 1) {
            return $next($request);
        } else {
            if ($user->role > 2) {
                if ($user->role == 3) {
                    //Outlet manager
                    $outlet = Outlet::where('id', $outlet_id)->where('owner_id', $user->id)->first();
                    if ($outlet) {
                        return $next($request);
                    } else {
                        return redirect()->to('/not-permitted');
                    }
                } else {

                }
                return $next($request);
            }
        }

    }
}
