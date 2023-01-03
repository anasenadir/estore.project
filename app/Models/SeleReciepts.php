<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeleReciepts extends Model
{
    use HasFactory;


    public function sele()
    {
        return $this->belongsTo(Sele::class , 'sele_id');
    }
}
