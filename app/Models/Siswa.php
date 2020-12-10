<?php

namespace  App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';
    protected $fillable = ['NIS','user_id','nama_siswa', 'alamat', 'gender', 'kelas', 'tempat_lahir', 'tanggal_lahir', 'no_telp', 'agama', 'email','tahun_angkatan','status'];


    public function gender()
    {
        return $this->belongsTo('App\Models\Gender', 'gender_id');
    }

    public function peminjaman()
    {
        return $this->hasMany('App\Models\Peminjaman');
    }
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
