<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;



    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    
    public function details()
    {
        return $this->hasMany(PurchaseDetails::class , 'purchase_id');
    }

    public function getInvoiceTotal()
    {
        $total = 0;
        foreach ($this->details as $item){
            $total = ($item->quantity * $item->product_price) + $total;
        }
        return $total;

    }

    public function purchaseReciepts(){
        return $this->hasMany(PurchaseReciepts::class , 'purchase_id');
    } 
    
    public function totalPaidAmmount(){
        $totalPaidAmmount = 0;
        foreach($this->purchaseReciepts as $purchaseReciepts){
            $totalPaidAmmount = $totalPaidAmmount + $purchaseReciepts->pyment_amount;
        }
        return $totalPaidAmmount;
    }
}
