<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Staff;
use Illuminate\Contracts\Auth\Factory as Auth;

class Authenticate
{
    /**
     * The authentication guard factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

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
        $rememberTokenAgainst = Staff::where('id', $request->header('Staff_id'))->value('remember_token');

        if ($clientRememberToken == $rememberTokenAgainst) 
        {
            return $next($request);
        }
        else {
            return response('Unauthorized.', 401);
        }

    }
}
