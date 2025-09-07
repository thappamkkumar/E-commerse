<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Models\User;
class checkCustomerRole
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
			 if(auth()->user()->user_role == User::ADMIN_ROLE) {
				return redirect('/admin/dashboard');
			 }
			
		}
        return $next($request);
    }
}
