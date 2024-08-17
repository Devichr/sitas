<?php

// middleware untuk role

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check() || Auth::user()->role !== $role) {
            if (Auth::user()->role == 'mahasiswa') {
                return redirect('/dashboard');
            }
            if (Auth::user()->role == 'dosen') {
                return redirect('/dosen/dashboard');
            }
            if (Auth::user()->role == 'admin') {
                return redirect('/kaprodi/dashboard');
            }else {
                abort(403, 'Unauthorized action.');
            }
        }

        return $next($request);
    }
}

