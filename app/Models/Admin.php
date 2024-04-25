<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;

    protected $guard = "admin";
    protected $guarded=[];


    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getTypeAttribute($value)
    {
        $types = [
            0 => 'General Manager',
            1 => 'General Admin',
            2 => 'General Fotografer',
        ];

        return isset($types[$value]) ? $types[$value] : 'Unknown';
    }

    public function getRawTypeAttribute()
    {
        return $this->attributes['type'];
    }

    public function getPhoneAttribute($value)
    {
        // Periksa apakah nomor telepon dimulai dengan "0"
        if (strpos($value, '0') === 0) {
            // Jika ya, ubah menjadi "+62" dan hapus angka "0" di awal
            return '+62' . substr($value, 1);
        }

        // Jika tidak dimulai dengan "0", biarkan seperti itu
        return $value;
    }

}
