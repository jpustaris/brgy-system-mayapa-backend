<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Session\Middleware\StartSession;


class adminCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

     protected $startSession;

     public function __construct(StartSession $startSession)
     {
         $this->startSession = $startSession;
     }


    public function handle(Request $request, Closure $next): Response
    {
        // Call the StartSession middleware
        $response = $this->startSession->handle($request, function ($request) use ($next) {
            return $next($request);
        });

        // Your custom middleware logic
        // ...

        return $response;
    }
}
