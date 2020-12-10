<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori_buku';
    public $timestamps = false; 
    
    /**
     * Get the notes for the status.
     */
    public function buku()
    {
        return $this->hasMany('App\Models\Buku');
    }
}
