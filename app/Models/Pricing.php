<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pricing extends Model
{
    use HasFactory;

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function prDetials(){
        return $this->hasMany(PricingDetails::class  , 'pricing_id');
    }

    public function getPricingTotal()
    {
        $total = 0;
        foreach ($this->prDetials as $item){
            $total = ($item->quantity * $item->product_price) + $total;
        }
        return $total;
    }
}
