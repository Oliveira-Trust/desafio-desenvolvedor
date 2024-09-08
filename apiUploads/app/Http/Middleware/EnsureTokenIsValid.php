<?php
 
namespace App\Http\Middleware;
 
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Token;
 
class EnsureTokenIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $authHeader = $request->header('Authorization');
        
        if ($authHeader) {
            // Remover o prefixo Bearer se estiver presente
            $parts = explode(' ', $authHeader);
            $token = isset($parts[1]) ? $parts[1] : null;
            
            // Verificar se o token existe no banco de dados
            if ($token && Token::where('token', $token)->exists()) {
                return $next($request);
            }
        }

        return response()->json(['message' => 'Token inválido.'], 401);

    }
}