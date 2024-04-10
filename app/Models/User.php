<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'created-at',
        'updated_at',
        'deleted_at'
    ];

    public static function boot()
    {
        parent::boot();

        // Quando um registro está sendo salvo
        self::saving(function ($model) {

            // Criptografa a senha (quando existir) para salvar no banco
            // Ou remove se ela for vazia significa para que ela não deve ser alterada
            if ($model->password) {
                $model->password = Hash::make($model->password);
            } else {
                unset($model->password);
            }
        });
    }
}
