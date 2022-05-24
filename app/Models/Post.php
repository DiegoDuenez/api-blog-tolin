<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table = 'post';
    protected $fillable = [
        'title',
        'description',
        'users',
    ];
    public function User(){

        return $this->hasMany('App\Models\User');

    }
    public function PostCategories(){

        return $this->hasMany('App\Models\Post_categories');

    }
}
