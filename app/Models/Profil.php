<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{
    protected $table = 'nama_sekolah';
   
    public function user()
    {
        return $this->hasMany('App\User');
    }

    public static function sekolah(){

        $sekolah = Profil::all();

        foreach($sekolah as $s){
            echo $s->deskripsi;
        }

    }
}
