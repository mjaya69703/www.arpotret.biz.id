<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function book_product()
    {
        return $this->belongsTo(Product::class);
    }
    public function book_author()
    {
        return $this->belongsTo(User::class);
    }
    public function book_assign()
    {
        return $this->belongsTo(Admin::class, 'book_assign_to');
    }

    public function getBookStatAttribute($value)
    {
        $statuses = [
            0 => 'Proses Verifikasi Pembayaran',
            1 => 'Proses Perencanaan (Dengan Client)',
            2 => 'Menunggu Shooting',
            3 => 'Shooting',
            4 => 'Proses Editing',
            5 => 'Diterima Client'
        ];

        return isset($statuses[$value]) ? $statuses[$value] : null;
    }

    public function getRawBookStatAttribute()
    {
        return $this->attributes['book_stat'];
    }
}
