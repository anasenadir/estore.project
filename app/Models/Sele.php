<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sele extends Model
{
    use HasFactory;


    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    
    public function details()
    {
        return $this->hasMany(SeleDetails::class , 'sele_id');
    }

    public function getInvoiceTotal()
    {
        $total = 0;
        foreach ($this->details as $item){
            $total = ($item->quantity * $item->product_price) + $total;
        }
        return $total;

    }

    protected function seleReciepts(){
        return $this->hasMany(SeleReciepts::class , 'sele_id');
    } 
    
    public function totalPaidAmmount(){
        $totalPaidAmmount = 0;
        foreach($this->seleReciepts as $seleReciept){
            $totalPaidAmmount = $totalPaidAmmount + $seleReciept->pyment_amount;
        }
        return $totalPaidAmmount;
    }

    



}
