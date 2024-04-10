<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Http\Requests\Common\LoginRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;



class AuthController extends Controller
{

    /**
     * @param LoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request) {

        $username = $request->username;
        $password = $request->password;


        // Validar email
        $field = filter_var($username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $user = User::where($field, '=', $username)->first();

        if(!$user) {

            return response()->json(['message' => 'Usuário não encontrado'], 404);

        }

        if (!password_verify($password, $user->password)) {

            return response()->json(['error' => 'Usuário ou senha incorreta'], 401);

        }

        if (!$user->active) {

            return response()->json(['message' => 'Usuário inativo'], 401);

        }

        $payload = [
            'username' => $user->username,
            'email' => $user->email,
        ];


        $token = Auth::claims($payload)->login($user);

        return $this->_respondWithToken($token);

    }

    /**
     * Formata o response da autenticação.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function _respondWithToken($token)
    {
        $user = Auth::user();

        $name = explode(' ', trim($user->name));
        $len = count($name);

        if ($len > 1) {
            $name = $name[0] . ' ' . $name[($len - 1)];
        } else {
            $name = $name[0];
        }

        $data = [
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => Carbon::now()->addMinutes(JWTAuth::factory()->getTTL())->toDateTimeString()
        ];

        return response()->json($data, 200);
    }
}
