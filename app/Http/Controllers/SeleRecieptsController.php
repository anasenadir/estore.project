<?php

namespace App\Http\Controllers;

use App\Models\Sele;
use App\Models\SeleReciepts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class SeleRecieptsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sele_id = $request->keys()[0];
        $sele = Sele::find($sele_id);
        $paidDetails = SeleReciepts::where('sele_id' ,$sele_id)->get();

        return View::make('selesrecipets.default')
            ->with('sele' , $sele)
            ->with('paidDetails' ,$paidDetails);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $key = $request->keys();
        $sele_id =  array_shift($key);


        return View::make('selesrecipets.create')
            ->with('sele_id',$sele_id );
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
        if(session('_token') == $request->post('_token') ){
            $request->validate([
                'amount'         => 'required|numeric',
                'type'           => 'required|integer',
                'sele_id'        => 'required|integer',
            ]);


            $sele = Sele::find($request->sele_id);
            $paidAmmountsArray = SeleReciepts::where('sele_id' ,$request->sele_id)->get();
            $oldPaidAmmountTotal  = 0;

            foreach($paidAmmountsArray as $paidAmmountItem){
                $oldPaidAmmountTotal = $paidAmmountItem->pyment_amount+ $oldPaidAmmountTotal;
            }
            
            $totalShoudPay =  $sele->getInvoiceTotal();
            if(($request->amount + $oldPaidAmmountTotal) > $totalShoudPay){
                Session::flash('message' , 'المبلغ المراد دفعة اعلى من المتبقي من قيمة الفاتورة');
                Session::flash('type' , 'danager');
                return Redirect::to(route('selesrecipets.create', $sele->id));
                
            }
            if(($request->amount + $oldPaidAmmountTotal)  ==  $totalShoudPay){
                // payment completed successfuly 
                $sele->pyment_status = true;
            }else{
                $sele->pyment_status = false;
            }
            $sele->save();

            // return $paidAmount;
            $seleReciept                            = new SeleReciepts();
            $seleReciept->pyment_type               = $request->type;
            $seleReciept->sele_id                   = $request->sele_id;
            $seleReciept->pyment_amount             = $request->amount;
            $seleReciept->bank_name                 = 0;
            $seleReciept->bank_account_number       = 0;
            $seleReciept->chack_number              = $request->check_number ?? '';
            $seleReciept->transfered_to             = '';
            $seleReciept->reciept_code              = 'AKJ45JD';
            $seleReciept->user_id                   =  Auth::user()->id;


            if($seleReciept->save()){
                Session::flash('message' , 'تم أداء الفاتورة  بنجاح');
            }else{
                Session::flash('message' , 'لقد حصل خطأ في  أداء الفاتورة');
            }
        }
        return Redirect::to('seles');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SeleReciepts  $seleReciepts
     * @return \Illuminate\Http\Response
     */
    public function show(SeleReciepts $seleReciepts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SeleReciepts  $seleReciepts
     * @return \Illuminate\Http\Response
     */
    public function edit(SeleReciepts $seleReciepts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SeleReciepts  $seleReciepts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SeleReciepts $seleReciepts)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SeleReciepts  $seleReciepts
     * @return \Illuminate\Http\Response
     */
    public function destroy(SeleReciepts $seleReciepts)
    {
        //
    }
}
