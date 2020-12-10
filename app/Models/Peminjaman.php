<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjaman';
    protected $fillable = ['kode_pinjam','nis','nip','buku_id', 'status_id', 'tanggal_peminjaman', 'tanggal_harus_kembali','keterlambatan','denda','created_at'];


    /**
     * Get the User that owns the Notes.
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'users_id');
    }

    /**
     * Get the Status that owns the Notes.
     */
    public function status()
    {
        return $this->belongsTo('App\Models\Status', 'status_id');
    }

    public function buku()
    {
        return $this->belongsTo('App\Models\Buku','buku_id');
    }

    public function siswa()
    {
        return $this->belongsTo('App\Models\Siswa', 'nis');
    }

    public function guru()
    {
        return $this->belongsTo('App\Models\Guru', 'nip');
    }


}
