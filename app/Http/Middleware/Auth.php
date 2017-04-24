<?php

namespace App\Http\Middleware;

use Closure;

class Auth
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
        if (auth()->guest()){
            session()->flash('Modal',true);
            session()->flash('Title',trans('Post.errorOpinionTitle'));
            session()->flash('Message',trans('Post.opinionMessage'));
            return redirect()->back();
        }else{
            return $next($request);
        }
        return $next($request);
    }
}
