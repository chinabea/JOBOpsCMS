<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class MICTStaff
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!Auth::check()){
            return redirect('welcome');
        }

        $user = Auth::user();
        
        if($user->role == 7 || $user->role == 8 || $user->role == 9){
            return $next($request);
        } else {
            return redirect()->route('mict-staff.dashboard');
        }
        
    }
}
