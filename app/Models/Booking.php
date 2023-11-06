<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function perumahan(){
        return $this->belongsTo(House::class, 'house_id', 'id');
    }

    public function perumahanBlok(){
        return $this->belongsTo(HouseBlock::class, 'house_block_id', 'id');
    }
}
