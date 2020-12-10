<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
   
    protected $table = 'users';

    /**
     * Get the notes for the users.
     */
    public function peminjaman()
    {
        return $this->hasMany('App\Models\Peminjaman');
    }

    public function role()
    {
        return $this->belongsTo('App\Models\Role', 'role_id');
    }

    public function guru()
    {
        return $this->belongsTo('App\Models\Guru');
    }

    public function isNIPExist($nip)
    {
        $user = Users::where('nip', $nip)
            ->first();

        if ($user) {
            return true;
        }

        return false;
    }

}
