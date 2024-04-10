<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAccessControl
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param \Closure $next
     * @param mixed ...$roles
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles): mixed
    {
        // Busca pelo usuário logado
        $user = Auth::user();

        //Verifica se o usuário está ativo
        if (!$user->active) {
            $this->stopRequest('Este usuário foi desativado.');
        }

        // Verifica de foi passado uma restrição de acesso a nivel de usuário
        // Verifica se a permissão do usuário esta de acordo com a da rota
        if ($roles && !in_array($user->user_type, $roles)) {
            $this->stopRequest('Este usuário não possui privilégios para acessar este recurso.');
        }

        return $next($request);
    }

    /**
     * Lança uma excessão HTTP 403 com o a mensagem especificada
     *
     * @param string $message
     * @return void
     */
    protected function stopRequest($message): void
    {
        throw new HttpResponseException(response()->json(['code' => 403, 'message' => $message], 403));
    }
}
