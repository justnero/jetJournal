<?php

namespace App\Http\Middleware;

use Closure;

class ShareView
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
        $dayOfWeek = function ($day) {
            switch($day) {
                default:
                case 1:
                    return 'Пн';
                case 2:
                    return 'Вт';
                case 3:
                    return 'Ср';
                case 4:
                    return 'Чт';
                case 5:
                    return 'Пт';
                case 6:
                    return 'Сб';
                case 7:
                    return 'Вс';
            }
        };
        \View::share('dayOfWeek', $dayOfWeek);

        return $next($request);
    }
}
