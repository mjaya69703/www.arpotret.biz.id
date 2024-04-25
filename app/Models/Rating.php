<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function book()
    {
        return $this->belongsTo(Booking::class, 'book_id');
    }
    public function pack()
    {
        return $this->belongsTo(User::class, 'pack_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
