<?php

namespace App\Http\Middleware;

use Closure;

class Cors
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
        //Here we put our client domains
        $trusted_domains = ["http://localhost:4200"];//, "Anotherdomain.com"];

        if(isset($request->server()['HTTP_ORIGIN'])) {
            $origin = $request->server()['HTTP_ORIGIN'];

            if(in_array($origin, $trusted_domains)) {
                header('Access-Control-Allow-Origin: ' . $origin);
                header('Access-Control-Allow-Headers: Origin, Content-Type, Authorization');
            }
        }

        return $next($request);
    }
}
