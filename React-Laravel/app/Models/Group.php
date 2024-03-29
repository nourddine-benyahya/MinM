<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    
    
    protected $fillable = [
        'group_name',
        'group_creator',
        'description',
        'image'
    ];  

    public function users()
    {
        return $this->belongsToMany(User::class, 'group_users', 'group_id', 'user_id');
    }
    public function creator()
    {
        return $this->belongsTo(User::class, 'group_creator');
    }
}
