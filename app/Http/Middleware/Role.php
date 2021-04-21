<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if(auth()->user()->hasRole($role)){
            return $next($request);
        }
        $request->session()->invalidate();
        return redirect()->back()->with(['status'=> 'error', 'message' => 'Sorry! Credentials is not right.']);
    }
}
