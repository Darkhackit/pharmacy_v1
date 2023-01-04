<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Artisan;

class MachineInfo
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

          ob_start();
         system('ipconfig /all');
         $mycomsys=ob_get_contents();
         ob_clean();
         $find_mac = "Physical";
         $pmac = strpos($mycomsys, $find_mac);
         $macaddress=substr($mycomsys,($pmac+36),17);

          if($macaddress != "80-E8-2C-74-A7-FE") {


           return  redirect()->route('cutOff');
          }

        return $next($request);
    }
}
