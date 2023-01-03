<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\PurchaseReciepts;
use App\Models\SeleReciepts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class PurchaseRecieptsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $purchase_id = $request->keys()[0];
        // // return $purchase_id;
        // $purchase = Purchase::find($purchase_id);
        // $paidDetails = PurchaseReciepts::where('purchase_id' ,$purchase_id)->get();

        // return View::make('purchasesreciptes.default')
        //     ->with('purchase' , $purchase)
        //     ->with('paidDetails' ,$paidDetails);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $key = $request->keys();
        $purchase_id =  array_shift($key);


        return View::make('purchasesrecipets.create')
            ->with('purchase_id',$purchase_id );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        // return $request;
        if(session('_token') == $request->post('_token') ){
            $request->validate([
                'amount'         => 'required|numeric',
                'type'           => 'required|integer',
                'purchase_id'        => 'required|integer',
            ]);


            $purchase                   = Purchase::find($request->purchase_id);
            $paidAmmountsArray          = PurchaseReciepts::where('purchase_id' ,$request->purchase_id)->get();
            $oldPaidAmmountTotal        = 0;

            foreach($paidAmmountsArray as $paidAmmountItem){
                $oldPaidAmmountTotal = $paidAmmountItem->pyment_amount+ $oldPaidAmmountTotal;
            }
            
            $totalShoudPay =  $purchase->getInvoiceTotal();
            if(($request->amount + $oldPaidAmmountTotal) > $totalShoudPay){
                Session::flash('message' , 'المبلغ المراد دفعة اعلى من المتبقي من قيمة الفاتورة');
                Session::flash('type' , 'danager');
                return Redirect::to(route('purchasesrecipets.create', $purchase->id));
                
            }
            if(($request->amount + $oldPaidAmmountTotal)  ==  $totalShoudPay){
                // payment completed successfuly 
                $purchase->pyment_status = true;
            }else{
                $purchase->pyment_status = false;
            }
            $purchase->save();

            // return $paidAmount;
            $purchaseReciept                            = new PurchaseReciepts();
            $purchaseReciept->pyment_type               = $request->type;
            $purchaseReciept->purchase_id               = $request->purchase_id;
            $purchaseReciept->pyment_amount             = $request->amount;
            $purchaseReciept->bank_name                 = 0;
            $purchaseReciept->bank_account_number       = 0;
            $purchaseReciept->check_number              = $request->check_number ?? '';
            $purchaseReciept->transfered_to             = '';
            $purchaseReciept->reciept_code              = 'AKJ45JD';
            $purchaseReciept->user_id                   =  Auth::user()->id;


            if($purchaseReciept->save()){
                Session::flash('message' , 'تم أداء الفاتورة  بنجاح');
            }else{
                Session::flash('message' , 'لقد حصل خطأ في  أداء الفاتورة');
            }
        }
        return Redirect::to('purchases');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PurchaseReciepts  $purchaseReciepts
     * @return \Illuminate\Http\Response
     */
    public function show( $purchase_id)
    {
        // $key = $request->keys();
        // $purchase_id =  array_shift($key);

        // return $purchase_id;

        $purchase = Purchase::find($purchase_id);
        $paidDetails = PurchaseReciepts::where('purchase_id' ,$purchase_id)->get();
        // return $paidDetails;

        return View::make('purchasesrecipets.default')
            ->with('purchase' , $purchase)
            ->with('paidDetails' ,$paidDetails);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PurchaseReciepts  $purchaseReciepts
     * @return \Illuminate\Http\Response
     */
    public function edit(PurchaseReciepts $purchaseReciepts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PurchaseReciepts  $purchaseReciepts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PurchaseReciepts $purchaseReciepts)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PurchaseReciepts  $purchaseReciepts
     * @return \Illuminate\Http\Response
     */
    public function destroy(PurchaseReciepts $purchaseReciepts)
    {
        //
    }
}
