<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'user_id',
        'body',
    ];  

    public function user (){
        return $this->hasOne(User::class);
    }
    public function post (){
        return $this->hasOne(Post::class);
    }

}
