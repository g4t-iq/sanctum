<?php

namespace Harmony\Sanctum\Http\Middleware;

use G4T\Auth\AuthenticationException;
use Harmony\Sanctum\Exceptions\MissingAbilityException;

class CheckForAnyAbility
{
    /**
     * Handle the incoming request.
     *
     * @param  \G4T\Http\Request  $request
     * @param  \Closure  $next
     * @param  mixed  ...$abilities
     * @return \G4T\Http\Response
     *
     * @throws \G4T\Auth\AuthenticationException|\Harmony\Sanctum\Exceptions\MissingAbilityException
     */
    public function handle($request, $next, ...$abilities)
    {
        if (! $request->user() || ! $request->user()->currentAccessToken()) {
            throw new AuthenticationException;
        }

        foreach ($abilities as $ability) {
            if ($request->user()->tokenCan($ability)) {
                return $next($request);
            }
        }

        throw new MissingAbilityException($abilities);
    }
}
