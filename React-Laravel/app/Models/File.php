<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'message_text',
        'message_file',
    ];  

    public function post (){
        return $this->hasMany(Post::class);
    }
    public function message (){
        return $this->hasMany(Message::class);
    }

}
