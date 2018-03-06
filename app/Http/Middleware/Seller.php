<?php

namespace App\Http\Middleware;
use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class Seller
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

//        dd($request->route('parameter_name'));
//        if (Auth::check()){
//
        if (!Auth::user()->isSeller()) {

          //  if (Auth::user()->isAdmin()) {
          //      return $next($request);
          // }else{
                return redirect('/');           
            }





      //  }

        return $next($request);
    }
}
