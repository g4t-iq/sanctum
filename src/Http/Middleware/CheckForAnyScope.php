<?php

namespace Harmony\Sanctum\Http\Middleware;

use Harmony\Sanctum\Exceptions\MissingScopeException;

/**
 * @deprecated
 * @see \Harmony\Sanctum\Http\Middleware\CheckForAnyAbility
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
     * @throws \G4T\Auth\AuthenticationException|\Harmony\Sanctum\Exceptions\MissingScopeException
     */
    public function handle($request, $next, ...$scopes)
    {
        try {
            return (new CheckForAnyAbility())->handle($request, $next, ...$scopes);
        } catch (\Harmony\Sanctum\Exceptions\MissingAbilityException $e) {
            throw new MissingScopeException($e->abilities());
        }
    }
}
