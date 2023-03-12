<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'by_user_id',
        'to_user_id',
        'file_id'
    ];  

    public function user (){
        return $this->hasOne(User::class);
    }
    public function file (){
        return $this->hasOne(File::class);
    }
}
