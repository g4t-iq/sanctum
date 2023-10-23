<?php

namespace Tune\Sanctum\Http\Middleware;

use Tune\Sanctum\Exceptions\MissingScopeException;

/**
 * @deprecated
 * @see \Tune\Sanctum\Http\Middleware\CheckForAnyAbility
 */
class CheckForAnyScope
{
    /**
     * Handle the incoming request.
     *
     * @param  \G4T\Http\Request  $request
     * @param  \Closure  $next
     * @param  mixed  ...$scopes
     * @return \G4T\Http\Response
     *
     * @throws \G4T\Auth\AuthenticationException|\Tune\Sanctum\Exceptions\MissingScopeException
     */
    public function handle($request, $next, ...$scopes)
    {
        try {
            return (new CheckForAnyAbility())->handle($request, $next, ...$scopes);
        } catch (\Tune\Sanctum\Exceptions\MissingAbilityException $e) {
            throw new MissingScopeException($e->abilities());
        }
    }
}
