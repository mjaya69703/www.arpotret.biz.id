<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMe extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function sendto()
    {
        return $this->belongsTo(Admin::class);
    }

    public function getContactTypeAttribute($value)
    {
        $statuses = [
            0 => 'Email Masuk',
            1 => 'Email Reply',
            2 => 'Email Keluar',
        ];

        return isset($statuses[$value]) ? $statuses[$value] : null;
    }

    public function getRawContactTypeAttribute()
    {
        return $this->attributes['contact_type'];
    }
}
