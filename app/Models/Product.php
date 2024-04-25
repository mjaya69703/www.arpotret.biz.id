<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function cproduct()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function author()
    {
        return $this->belongsTo(Admin::class);
    }

    public function setProductPriceAttribute($value)
    {
        // Hapus mutator ini jika Anda ingin menyimpan nilai tanpa menghapus format tambahan
        $this->attributes['product_price'] = str_replace(['Rp.', ' ', '.'], '', $value);
    }

    // Fungsi untuk mengembalikan nilai harga dalam format yang diinginkan
    public function getProductPriceAttribute($value)
    {
        // Hapus aksesor ini jika Anda ingin mengakses nilai asli tanpa format tambahan
        return 'Rp. ' . number_format($value, 0, ',', '.');
    }
    public function getRawProductPriceAttribute()
    {
        return $this->attributes['product_price'];
    }
    // public function getRawProductPriceAttribute()
    // {
    //     return $this->getOriginal('product_price');
    // }
}
