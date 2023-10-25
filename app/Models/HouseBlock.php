<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HouseBlock extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function booking(){
        return $this->hasOne(Booking::class, 'house_block_id');
    }
}
