<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AdminAuth 
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
        if($request->session()->has("user")){
            if($request->session()->get("user")->IdRole==1){
                return $next($request);
            }
            else{
                return redirect("/home")->with("message","no");
            }
        } 
        else {
            return redirect("/")->with("message","no");
        }
    }
}
