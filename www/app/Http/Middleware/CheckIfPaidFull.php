<?php

namespace App\Http\Middleware;

use Closure;

class CheckIfPaidFull
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
        $date = date('Y-m-d');

        if($date >= '2024-10-02') {

            return redirect()->route('cutOff');
        }
        return $next($request);
    }
}
