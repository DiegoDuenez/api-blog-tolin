<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Comments extends Model
{
    use HasFactory;
    protected $table = 'comments';
    protected $fillable = [
        'description',
        'user_id',
        'post_id',
    ];
    public function User(){

        return $this->hasMany('App\Models\User');

    }
    public function Reply(){

        return $this->hasMany('App\Models\Reply');

    }

    public function getCreatedAtAttribute($value){
        return Carbon::parse($value)->format('d/m/Y H:i:s.A');
    }

    public function getUpdatedAtAttribute($value){
        return Carbon::parse($value)->format('d/m/Y H:i:s.A');
    }
}
