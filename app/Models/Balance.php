<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function bal_admin()
    {
        return $this->belongsTo(Admin::class, 'bal_admin_id');
    }

    public function getBalTypeAttribute($value)
    {
        $statuses = [
            0 => 'Balance Pending',
            1 => 'Balance Income',
            2 => 'Balance Expense',
        ];

        return isset($statuses[$value]) ? $statuses[$value] : null;
    }

    public function getRawBalTypeAttribute()
    {
        return $this->attributes['bal_type'];
    }

    public function setBalValueAttribute($value)
    {
        // Hapus mutator ini jika Anda ingin menyimpan nilai tanpa menghapus format tambahan
        $this->attributes['bal_value'] = str_replace(['Rp.', ' ', '.'], '', $value);
    }

    // Fungsi untuk mengembalikan nilai harga dalam format yang diinginkan
    public function getBalValueAttribute($value)
    {
        // Hapus aksesor ini jika Anda ingin mengakses nilai asli tanpa format tambahan
        return 'Rp. ' . number_format($value, 0, ',', '.');
    }
    public function getRawBalValueAttribute()
    {
        return $this->attributes['bal_value'];
    }
}
