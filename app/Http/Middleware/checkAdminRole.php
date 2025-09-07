<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Models\User;
class checkAdminRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
		if(auth()->user()==null)
		{
			return redirect('/');
		}
		else
		{
			 if(auth()->user()->user_role != User::ADMIN_ROLE) {
				return redirect()->route('home', [], 301);
			 }
			  
		}
        return $next($request);
		
    }
}
