<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Connect extends Model
{
    use HasFactory;
    protected $guarded=[];


    public function book()
    {
        return $this->belongsTo(Booking::class);
    }
    public function send()
    {
        return $this->belongsTo(User::class, 'send_to');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
    public function users()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function getConnectStatAttribute($value)
    {
        $statuses = [
            0 => 'Menunggu Balasan',
            1 => 'Dibalas',
            2 => 'Selesai',
            3 => 'Dibatalkan',
        ];

        return $statuses[$value];
    }

    public function getRawConnectStatAttribute()
    {
        return $this->attributes['connect_stat'];
    }

}
