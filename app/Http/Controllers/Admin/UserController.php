<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Http\Resources\Admin\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse as JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \Illuminate\Http\Resources\Json\AnonymousResourceCollection as AnonymousResourceCollection;


class UserController extends Controller
{
    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $limit = $request->query->get('limit') ?: 10;

        $users = User::with('roles')->paginate($limit);

        return UserResource::collection($users);
    }

    /**
     * @param UserRequest $request
     * @return JsonResponse
     */
    public function store(UserRequest $request): JsonResponse
    {
        DB::beginTransaction();
        try {

            $data = $request->all();

            $roles = $request->getUser('roles');

            unset($data['roles']);

            $user = User::create($data);

            $user->assignRole($roles);

            DB::commit();

            return response()->json(['message' => 'Usuário cadastrado com sucesso!'], 201);

        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['message' => "Falha ao registrar Usuário. ERROR: {$th->getMessage()}"], 500);
        }
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        //Logica para exibir user

        return response()->json(['message' => 'Show User'], 200);
    }

    /**
     * @param UserRequest $request
     * @param $id
     * @return JsonResponse
     */
    public function update(UserRequest $request, $id) : JsonResponse
    {
        //Logica para atualizar user

        return response()->json(['message' => 'Update User'], 200);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {

        //Logica para excluir user

        return response()->json(['message' => 'Delete User'], 200);

    }
}
