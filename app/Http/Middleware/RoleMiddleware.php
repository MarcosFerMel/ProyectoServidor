<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Maneja la solicitud entrante.
     */
    public function handle(Request $request, Closure $next, $role = null): Response
    {
        $user = $request->user();

        if (!$user) {
            return redirect('/')->with('error', 'Debes iniciar sesión para acceder a esta sección.');
        }

        // Si el middleware no recibe un rol, continuar sin restricciones
        if (!$role) {
            return $next($request);
        }

        // Verificar si el usuario tiene el rol adecuado
        if ($role === 'admin' && $user->isAdmin()) {
            return $next($request);
        }

        if ($role === 'user' && ($user->isUser() || $user->isAdmin())) {
            return $next($request);
        }

        // Si el usuario no tiene permisos, redirigir al dashboard
        return redirect('/dashboard')->with('error', 'No tienes permiso para acceder a esta sección.');
    }
}
