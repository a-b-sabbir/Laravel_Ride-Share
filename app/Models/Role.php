<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name'];

    public function user()
    {
        return $this->hasMany(User::class, 'role_id');  // 'role_id' is the foreign key in the users table
    }
    
}
