<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected function unauthenticated($request, array $guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            $route = match ($guard) {
                'web' => 'login',
                default => 'login',
            };
        }

        throw new AuthenticationException(
            'Unauthenticated.',
            $guards,
            $this->redirect($request, $route),
        );
    }

    protected function redirect(Request $request, string $route): ?string
    {
        return $request->expectsJson() ? null : route($route);
    }
}
