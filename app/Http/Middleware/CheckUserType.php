<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUserType
{
    /**
     * Handle an incoming request. 
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$types)
    {
         $user = $request->user();
         if (!in_array($user->type ,$types)) {
             return abort(403,'You are not admin');
         }
        return $next($request);
    }
}
