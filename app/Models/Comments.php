<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;
    protected $table = 'comments';
    protected $fillable = [
        'description',
        'users',
        'posts',
    ];
    public function User(){

        return $this->hasMany('App\Models\User');

    }
    public function Reply(){

        return $this->hasMany('App\Models\Reply');

    }
}
