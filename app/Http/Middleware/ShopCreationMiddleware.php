<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;




class ShopCreationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Récupérer le token d'authentification de l'en-tête Authorization
        $token = $request->header('Authorization');

        if (!$token) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Extraire le token de l'en-tête Authorization (Bearer token)
        $token = str_replace('Bearer ', '', $token);

        // Vous pouvez maintenant utiliser le token dans votre middleware comme requis

        // Passer à la prochaine étape du middleware
        return $next($request);
    }
}

