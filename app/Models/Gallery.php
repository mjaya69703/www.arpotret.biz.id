<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function cproduct()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function author()
    {
        return $this->belongsTo(Admin::class);
    }
}
