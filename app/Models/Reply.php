<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;
    protected $table = 'reply';
    protected $fillable = [
        'description',
        'users',
        'comments',
    ];
    public function User(){

        return $this->hasMany('App\Models\User');

    }
    public function Comments(){
        return $this->belongsTo('App\Models\Comments');

    }
}
