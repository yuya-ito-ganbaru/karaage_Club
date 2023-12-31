<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $table = 'articles';

    protected $fillable = ['user_id', 'title', 'tag', 'image', 'body', 'recommend','store', 'address'];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function comments()
{
    return $this->hasMany('App\Comment');
}

}
