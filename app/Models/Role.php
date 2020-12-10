<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'users_privilege';
    public function user()
    {
        return $this->hasMany('App\User');
    }
   
}
