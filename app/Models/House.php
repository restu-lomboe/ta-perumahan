<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function blocks(){
        return $this->hasMany(HouseBlock::class, 'house_id', 'id');
    }
}
