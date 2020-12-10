<?php

namespace App;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    
    use Notifiable;
 

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama', 'email', 'password','role_id','last_login_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    protected $dates = [
        'deleted_at',
    ];

    public function role()
    {
        return $this->belongsTo('App\Models\Role', 'role_id');
    }
    public function guru()
    {
        return $this->hasOne('App\Models\Guru');
    }

    public function siswa()
    {
        return $this->hasOne('App\Models\Siswa');
    }
    public function sekolah()
    {
        return $this->hasOne('App\Models\Profil');
    }

}
