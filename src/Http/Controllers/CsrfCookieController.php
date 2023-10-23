<?php

namespace Tune\Sanctum\Http\Controllers;

use G4T\Http\JsonResponse;
use G4T\Http\Request;
use G4T\Http\Response;

class CsrfCookieController
{
    /**
     * Return an empty response simply to trigger the storage of the CSRF cookie in the browser.
     *
     * @param  \G4T\Http\Request  $request
     * @return \G4T\Http\Response|\G4T\Http\JsonResponse
     */
    public function show(Request $request)
    {
        if ($request->expectsJson()) {
            return new JsonResponse(null, 204);
        }

        return new Response('', 204);
    }
}
