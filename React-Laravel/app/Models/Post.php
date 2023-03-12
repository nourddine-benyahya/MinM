<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'file_id'
    ];  

    public function user (){
        return $this->hasOne(User::class);
    }
    public function file (){
        return $this->hasOne(File::class);
    }
}
