<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect('/signin');
        }

        $user = Auth::user();

        if ($user->role != $role) {
            abort(403, 'Unauthorized action.');
        }


        return $next($request);

        // if (Auth::check()) {
        //     // User is already authenticated
        //     $user = Auth::user();
        //     if ($user->role = $role) {
        //         // User has the appropriate role, so continue with the request
        //         return $next($request);
        //     } else {
        //         // User does not have the appropriate role, so redirect to an error page
        //         return redirect('/error');
        //     }
        // } else {
        //     // User is not authenticated, so redirect to the login page
        //     return redirect('/signin');
        // }


    }
}
