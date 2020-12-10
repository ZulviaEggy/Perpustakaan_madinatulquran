<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $table = 'guru';
    protected $fillable = ['user_id','NIP', 'nama_lengkap', 'alamat', 'gender', 'tempat_lahir', 'tanggal_lahir', 'no_telp', 'agama', 'email','status'];

    public function transaksi()
    {
        return $this->belongsTo('App\Models\Peminjaman');
    }
    
 
    public function user()
    {
        return $this->hasMany('App\User','user_id');
    }

}
