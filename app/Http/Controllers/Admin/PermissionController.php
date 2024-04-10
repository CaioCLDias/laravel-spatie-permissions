<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function combolist(Request $request)
    {
        $permissions = Permission::select('id', 'name')->get();

        return empty($permissions)
            ? response()->json(['message' => 'Sem registros'], 204)
            : response()->json($permissions, 200);
    }
}
