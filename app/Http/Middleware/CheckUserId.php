<?php

namespace App\Http\Middleware;

use Closure;
use App\UserOrder;
use Illuminate\Support\Facades\Auth;

class CheckUserId
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $id = null)
    {
        $url = $request->path();
        $url = explode('/', $url);
        if ($id == null)
        {
            $id = (int)$url[count($url) - 1];
        }
        elseif ($id == 'userOrder')
        {
            $id = UserOrder::find((int)$url[count($url) - 1])->user;
        }
        if (Auth::user()->role != 0 && Auth::id() != $id)
            return back();
        return $next($request);
    }
}
