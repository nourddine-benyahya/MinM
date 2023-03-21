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

    public function touser()
    {
        return $this->belongsTo(User::class, 'to_user_id');
    }
    
    public function byuser()
    {
        return $this->belongsTo(User::class, 'by_user_id');
    }
    public function file (){
        return $this->belongsTo(File::class);
    }
}
