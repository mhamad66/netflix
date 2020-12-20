<?php

namespace App\Models;

use Laratrust\Models\LaratrustRole;

class Role extends LaratrustRole
{
    public $guarded = [];
protected $fillable = ['name'];

// scope-----------------------------------------
public function scopeWhenSearch($query, $search)
{
    return $query->when($search, function ($q) use ($search) {
        return $q->where('name', 'like', "%$search%");
    });
}

// scope---------------------------------------------
public function scopeWhereroleNot($query,$role_name){
    return $query->whereNotIn('name',(array)$role_name);
}
}
