<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;

class StudentMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    public function handle($request, Closure $next)
    {
        $user = auth()->user();
        if(!is_null($user) && !is_null($user->student)) {
            \View::share('student', $user->student);
            return $next($request);
        }
        abort(403, 'К вам не подключен студент');
    }
}
