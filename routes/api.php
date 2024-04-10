<?php

use App\Http\Controllers\Admin\PermissionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Common\AuthController;
use \App\Http\Controllers\Admin\UserController;
use \App\Http\Controllers\Admin\RoleController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/login',                    [AuthController::class, 'login']);

//Atribuindo permissões as rotas

Route::post('/users',                    [UserController::class, 'store'])->middleware('can:create-user');
Route::put('/users/{id}',                [UserController::class, 'update'])->middleware('can:update-user');;
Route::delete('/users/{id}',             [UserController::class, 'destroy'])->middleware('can:delete-user');;
Route::get('/users',                     [UserController::class, 'index'])->middleware('can:read-user');;
Route::get('/users/{id}',                [UserController::class, 'show'])->middleware('can:read-user');;


Route::post('/roles',                    [RoleController::class, 'store'])->middleware('can:create-role');
Route::put('/roles/{id}',                [RoleController::class, 'update'])->middleware('can:update-role');
Route::delete('/roles/{id}',             [RoleController::class, 'destroy'])->middleware('can:delete-role');
Route::get('/roles',                     [RoleController::class, 'index'])->middleware('can:read-role');
Route::get('/roles/{id}',                [RoleController::class, 'show'])->middleware('can:read-role');


Route::get('permissions',                [PermissionController::class, 'combolist'])->middleware('can:read-permission');
