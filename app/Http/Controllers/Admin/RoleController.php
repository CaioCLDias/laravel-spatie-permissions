<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoleRequest;
use App\Http\Resources\Admin\RoleResource;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \Illuminate\Http\JsonResponse as JsonResponse;
use \Illuminate\Http\Resources\Json\AnonymousResourceCollection as AnonymousResourceCollection;

class RoleController extends Controller
{


    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {

        $limit = $request->query->get('limit') ?: 10;

        $roles = Role::with('permissions')->paginate($limit);

        return RoleResource::collection($roles);

    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {

        $role = Role::with('permissions')->findOrFail($id);

        return response()->json($role);

    }

    /**
     * @param RoleRequest $request
     * @return JsonResponse
     */
    public function store(RoleRequest $request): JsonResponse
    {

        DB::beginTransaction();

        try
        {
            $role = Role::create([
                'name' => $request->get('name'),
                'guard_name' => 'api',
            ]);

            $permissions = $request->get('permissions');

            $role->syncPermissions($permissions);

            DB::commit();

            return response()->json(['message' => 'Perfil Salvo com sucesso!'], 200);
        }catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Falha ao salvar o perfil!'], 500);
        }
    }

    /**
     * @param $id
     * @param RoleRequest $request
     * @return JsonResponse
     */
    public function update($id, RoleRequest $request): JsonResponse
    {
        DB::beginTransaction();

        try{

            $data = $request->all();

            $role = Role::findOrFail($id);

            if($role->name == 'Admin'){
                return response()->json(['message' => 'Perfil de Admin não pode ser editado'], 500);
            }

            $role->update($data);

            $permissions = $request->get('permissions');

            $role->syncPermissions($permissions);

            DB::commit();

            return response()->json(['message' => 'Pefil atualizado com sucesso'], 200);

        }catch (\Exception $e){
            DB::rollBack();
            return response()->json(['message' => 'Falha ao atualizar o perfil!'], 500);
        }
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $role = Role::findOrFail($id);

        if($role->name == 'Admin'){
            return response()->json(['message' => 'Perfil de Admin não pode ser excluido'], 500);
        }

        $res = $role->delete();

        if(!$res){
            return response()->json(['message' => 'Falha ao excluir perfil'], 500);
        }

        return response()->json(['message' => 'Perfil excluido com sucesso'], 500);

    }
}
