<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
protected $fillable = ['name','description','poster','image','path','year','rating','percent'];

    use HasFactory;


    public function categories()
    {
        return $this->belongsToMany(Category::class,'movie_category');
    } 


}
