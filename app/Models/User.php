<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    //Name Attributes
    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }

    // scope ---------------------------------
    public function ScopeWhereSearch($query, $search)
    {

        return $query->when($search, function ($q) use ($search) {
            return $q->where('name', 'like', "%$search%");
        });
    }
    // Scope Role ---------------------------------------------
    public function scopeWhereRole($qyery, $role_name)
    {
        return $qyery->whereHas('roles', function ($q)  use ($role_name) {
            return $q->whereIn('name', (array)$role_name)
                ->orWhereIn('id', (array)$role_name);
        });
    }
    public function scopeWhereRoleNot($qyery, $role_name)
    {
        return $qyery->whereHas('roles', function ($q)  use ($role_name) {
            return $q->whereNotIn('name', (array)$role_name)
                ->orWhereNotIn('id', (array)$role_name);
        });
    }
    public function scopeWhenRole($query, $role_id)
    {
        return $query->when('role_id', function ($q) use ($role_id) {

            return $this->scopeWhereRole($q, $role_id);
        });
    }
}//End Model ------------------------
