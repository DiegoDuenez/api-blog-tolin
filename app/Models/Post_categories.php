<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post_categories extends Model
{
    use HasFactory;
    protected $table = 'post_categories';
    protected $fillable = [
        'categories_id',
        'post_id',
    ];
    public function Categories(){
        return $this->belongsTo('App\Models\Categories');

    }
    public function Post(){
        return $this->belongsTo('App\Models\Post');

    }
}
