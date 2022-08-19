<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

class RegistrationComleted extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string[]  ...$guards
     * @return mixed
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    public function handle($request, Closure $next, ...$guards)
    {
        if (empty($guards)) {
            $guards = [null];
        }

        $auth_guard = NULL;
        foreach ($guards as $guard) {
            if ($this->auth->guard($guard)->check()) {
                $auth_guard = $guard;
                break;
            }
        }

        $user = $auth_guard ? Auth::guard($auth_guard)->user() : Auth::user();

        if( !$user->company()->exists() ) {
            return redirect()->route('organization.create');
        }

        return $next($request);
    }
}
