<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Noted extends Model
{
    protected $table = 'noted';
    protected $fillable = ['status'];

   
    public static function totalUsulan(){

        return Noted::where('status','=','Diproses')->count();
    }

    public function buku()
    {
        return $this->belongsTo('App\Models\Buku','buku_id');
    }

}
