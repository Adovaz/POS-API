<?php

namespace App\Http\Middleware;

use App\Models\Staff;
use Closure;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $clientRememberToken = $request->header('Authorisation');
        $staffId = $request->header('StaffId');

        if(!($clientRememberToken)){

            return response()->json('No headers for Token', 401);
        }
        if(!($staffId)){

            return response()->json('No headers for Staff Id', 401);
        }

        $rememberTokenAgainst = Staff::where('id', $staffId)->value('remember_token');

        if ($clientRememberToken == $rememberTokenAgainst) 
        {
            return $next($request);
        }
        else {
            return response()->json('Unauthorized.', 401);
        }

    }
}
