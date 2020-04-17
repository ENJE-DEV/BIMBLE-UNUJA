<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;


class Pendaftar extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    protected $table = "pendaftar";

    protected $fillable = [
        'nama_pendaftar', 'jenis_kelamin', 'alamat', 'foto', 'email', 'username', 'password', 'status'
    ];

    protected $hidden = [
        'password',
    ];

    // public function getAuthPassword()
    // {
    //  return $this->password;
    // }

    // public function nilai()
    // {
    //     return $this->hasMany('App\Nilai');
    // }

    // public function temp_detail()
    // {
    //     return $this->hasMany('App\TempDetail');
    // }

    // public function detail_komentar()
    // {
    //     return $this->hasMany('App\DetailKomentar');
    // }
 
    protected $dates = ['deleted_at'];

}