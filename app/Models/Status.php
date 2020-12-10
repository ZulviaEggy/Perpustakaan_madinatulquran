<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'status';
    public $timestamps = false; 
    /**
     * Get the notes for the status.
     */
    public function peminjaman()
    {
        return $this->hasMany('App\Models\Peminjaman');
    }

    
}
