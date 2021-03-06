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
        $clientRememberToken = $request->header("Authorization");
        $staffId = $request->header("StaffId");

        /**ValidateHeaders */
        if (!$clientRememberToken) {
            return response()->json("No headers for Token", 401);
        }
        if (!$staffId) {
            return response()->json("No headers for Staff Id", 401);
        }

        /**Get staffs remember token from database */
        $rememberTokenAgainst = Staff::where("id", $staffId)->value(
            "remember_token"
        );

        if ($clientRememberToken == $rememberTokenAgainst) {
            return $next($request);
        } else {
            return response()->json("Unauthorized.", 401);
        }
    }
}
