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

        if($date >= '2026-10-02') {

            // License expired: show a friendly page instead of putting the whole
            // app into maintenance mode (which would require CLI access to recover).
            return response()->view('license', [], 403);
        }
        return $next($request);
    }
}
