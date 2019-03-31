<?php

namespace App\Http\Middleware;


use Closure;
use App\user;

class GuestUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$name)
    {
        // $user=user::find(1);
        // if($name==$user->name){
        //     throw new \Exception("You are not allowed");
        // }
        // return $next($request);
    }
}
