<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Laravel\Sanctum\Sanctum;

class ApiAuthenticate extends Middleware
{
    /**
     * Handle an incoming request.
     */
    public function handle($request, Closure $next, ...$guards)
    {
        // Primeiro tenta autenticar via Sanctum (token)
        if ($token = $request->bearerToken()) {
            $model = Sanctum::$personalAccessTokenModel;

            $accessToken = $model::findToken($token);
            if (!$accessToken || !$this->isValidToken($accessToken)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Acesso negado. Token inválido ou expirado.'
                ], 401);
            }

            // Autentica o usuário
            auth()->setUser($accessToken->tokenable);

            return $next($request);
        }

        // Se não há token, usa a lógica padrão
        return response()->json([
            'success' => false,
            'message' => 'Acesso negado. Nenhum token enviado.'
        ], 401);
    }

    /**
     * Verifica se o token é válido
     */
    protected function isValidToken($accessToken): bool
    {
        if (!$accessToken) {
            return false;
        }

        $isExpired = $accessToken->expires_at && now()->gte($accessToken->expires_at);

        return !$isExpired;
    }

    /**
     * Handle unauthenticated users for API.
     */
    protected function redirectTo($request): ?string
    {
        if ($request->expectsJson() || $request->is('api/*')) {
            abort(response()->json([
                'success' => false,
                'message' => 'Acesso negado. Token inválido ou expirado.'
            ], 401));
        }

        return null;
    }
}
