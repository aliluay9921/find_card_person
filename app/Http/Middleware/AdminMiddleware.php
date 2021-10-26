<?php

namespace App\Http\Middleware;

use Closure;
use App\Traits\SendResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    use SendResponse;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->status == 0) {
            return $next($request);
        } else {
            Auth::logout();
            return $this->send_response(403, 'unauthrized', [], []);
        }
    }
}