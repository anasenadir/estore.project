<?php

namespace App\Http\Controllers;

use App\Classes\AppPdf;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseDetails;
use App\Models\PurchaseReciepts;
use App\Models\Supplier;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return fake()->randomFloat(2 , 500 , 3000);
        // $purchases = Purchase::all();

        $purchases = Cache::remember('purchases', 120, function () {
            return Purchase::with('supplier' , 'details' , 'purchaseReciepts')->get();
        });
        return View::make('purchases.default')
            ->with('purchases'  ,$purchases );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $suppliers  = Cache::remember('suppliers' , 60 , function(){
            return Supplier::all();
        });


        $products   = Cache::remember('products' , 60 , function(){
            return Product::all();
        });
        return View::make('purchases.create')
            ->with('suppliers' , $suppliers)
            ->with('products' , $products);
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
                'supplier_id'      => 'required|integer'
            ]);
            $purchase                    = new Purchase();
            $purchase->supplier_id         = $request->supplier_id;
            $purchase->pyment_status     = 0;
            $purchase->purchases_received     = 0;
            $purchase->descount          = 0;
            $purchase->invoice_code      = Str::random(15);
            $purchase->user_id           = Auth::user()->id;
            

            if(is_null($request->sele_quantities)){
                Session::flash('message' , trans('purchases/create.products_are_required') );
                Session::flash('type' , 'error');
                return back();
            }



            if($purchase->save()){
                for($i =0 ; $i < count($request->sele_quantities) ; $i++){
                    $purchaseDetails                 = new PurchaseDetails();
                    $purchaseDetails->product_id     = $request->products_id[$i];
                    $purchaseDetails->quantity       = $request->sele_quantities[$i];
                    $purchaseDetails->product_price  = $request->expene_prices[$i];
                    $purchaseDetails->purchase_id        = $purchase->id ;
                    $purchaseDetails->save();

                    // i have created a trigger called --"decrease_quantity_when_sale_it"--
                    // to decrease the quantity automatically from stock 
                }
                Session::flash('message' ,trans('purchases/create.creation_success_message')  );
            }else{
                Session::flash('message' , trans('purchases/create.creation_error_message') );
            }
        }

        return Redirect::to('purchases');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase)
    {
        $purchaseDetails =  PurchaseDetails::where('purchase_id' , $purchase->id)->get();
        $suppliers    = Supplier::all();
        $products   = Product::all();

        $productsID = [];
        foreach($purchaseDetails as $item){
            array_push($productsID , $item->product_id);
        }
        return View::make('purchases.edit')
            ->with('purchase' , $purchase)
            ->with('purchaseDetails' , $purchaseDetails)
            ->with('suppliers' , $suppliers)
            ->with('products' , $products)
            ->with('productsID' , $productsID);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purchase $purchase)
    {
        // return $request;
        if(session('_token') == $request->post('_token') ){
            $request->validate([
                'supplier_id'      => 'required|integer'
            ]);
            

            $purchase->supplier_id          = $request->supplier_id;
            $purchase->pyment_status        = 0;
            $purchase->descount             = 0;
            $purchase->user_id              = Auth::user()->id;
            

            if(is_null($request->sele_quantities)){
                Session::flash('message' , trans('purchases/edit.products_are_required'));
                Session::flash('type' , 'error');
                return back();
            }


            
            if($purchase->save()){
                $purchaseDetail = PurchaseDetails::where('purchase_id' , $purchase->id)->delete();

                // inserting the new records to the 'purchasedetails' table and claculate the totalAmountShoudPay  
                $totalAmountShoudPay = 0;
                for($i =0 ; $i < count($request->sele_quantities) ; $i++){
                    $purchaseDetail                 = new PurchaseDetails();
                    $purchaseDetail->product_id      = $request->products_id[$i];
                    $purchaseDetail->quantity        = $request->sele_quantities[$i];
                    $purchaseDetail->product_price   = $request->expene_prices[$i];
                    $purchaseDetail->purchase_id         = $purchase->id ;
                    $purchaseDetail->save();


                    // ===========
                    $totalAmountShoudPay =  $totalAmountShoudPay + ($purchaseDetail->product_price  * $purchaseDetail->quantity );
                }

                // if what i have paid grater then the totalAmountShoudPay I will make a single record 
                // in the PurchaseReciepts table contains the totalAmountShoudPay as a pyment amount 
                if($purchase->totalPaidAmmount() > $totalAmountShoudPay){
                    $purchaseRecipets   = PurchaseReciepts::where('purchase_id' , $purchase->id )->get();
                    $pyment_type        = $purchaseRecipets->first()->pyment_type;
                    $reciept_code        = $purchaseRecipets->first()->reciept_code;
                    PurchaseReciepts::where('purchase_id' , $purchase->id )->delete();
                    //=============================================== 

                    $seleReciept                            = new PurchaseReciepts();
                    $seleReciept->pyment_type               = $pyment_type;
                    $seleReciept->purchase_id               = $purchase->id;
                    $seleReciept->pyment_amount             = $totalAmountShoudPay;
                    $seleReciept->bank_name                 = '';
                    $seleReciept->bank_account_number       = '';
                    $seleReciept->chack_number              = '';
                    $seleReciept->transfered_to             = '';
                    // ==============================
                    // this line of code i have to update it 
                    $seleReciept->reciept_code              = $reciept_code;
                    // ==============================
                    $seleReciept->user_id                   =  Auth::user()->id;
                    $seleReciept->save();
                }

                
                // i have created a trigger called --"changePaymentStatus"-- for chicking this conditions
                // ===============================================================old way
                if($totalAmountShoudPay == $purchase->totalPaidAmmount() || $totalAmountShoudPay < $purchase->totalPaidAmmount()){
                    // Payment completed successfully
                    $purchase->pyment_status = true;
                }else{
                    // Payment is made 
                    $purchase->pyment_status = false;
                }
                $purchase->save();
                // ===================================================================
                Session::flash('message' ,trans('purchases/create.editing_success_message')  );
            }else{
                Session::flash('message' , trans('purchases/create.editing_error_message') );
            }
        }

        //  send a notification to tell the admin whech procuct Close to completion
        // $this->sendProductNotification(10 , $request->products_id);
        return Redirect::to('purchases');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase)
    {
        // ============================================= old way 
        // SeleDetails::where('sele_id' , $sele->id)->delete();
        // SeleReciepts::where('sele_id' , $sele->id )->delete();
        // ===================================================
        if($purchase->delete()){
            Session::flash('message' ,trans('purchases/create.deleting_success_message'));
        }else{
            Session::flash('message' ,trans('purchases/create.deleting_error_message'));
        }

        return Redirect::to('purchases');
    }


    

    public function dounload($purchase_id)
    {
        // $data = [1];

        // $data = Sele::find($id);
        $purchaseDetails =  PurchaseDetails::where('purchase_id' , $purchase_id)->get();
        // $type = 'download';
        // $pdf = Pdf::loadView('purchases.pdf', compact('purchaseDetails' , 'type'));
        // return $pdf->download(Str::random().'.pdf');



        return  AppPdf::make(AppPdf::ImageForDownload ,'purchases.pdf' ,  $purchaseDetails)->download();
        
    }

    public function viewPurchaseInvoice($purchase_id)
    {
        $purchaseDetails =  PurchaseDetails::where('purchase_id' , $purchase_id)->get();
        $type = 'view';
        // $pdf = Pdf::loadView('seles.pdf', compact('seleDetails'));
        // return $pdf->download('template'.time(). rand(90 , 9999).'.pdf');
        return View::make('purchases.pdf')
            ->with('purchaseDetails' , $purchaseDetails)
            ->with('type' , $type);
    }

    public function sendPurchaseByMail($purchase_id)
    {
        $purchaseDetails =  PurchaseDetails::where('purchase_id' , $purchase_id)->get();
        $type = AppPdf::ImageForSend;

        Mail::send('purchases.pdf',compact('purchaseDetails' , 'type') ,function ($message) use ($purchaseDetails) {
            $pdf = AppPdf::make(AppPdf::ImageForDownload ,'purchases.pdf' ,  $purchaseDetails);
            $message->to('khadija@alumaco.com')
                    ->from('anas@gmail.com')
                    ->subject('Created At 2022-12-20')
                    ->attachData($pdf->output() , 'text.pdf');
        });
        return back();
    }

    // // when a client take his products and invoice
    public function purchasesReceived($purchase_id)
    {


        // return $purchase_id;
        $purchaseDetails =  PurchaseDetails::where('purchase_id' , $purchase_id)->get();
        $purchase = Purchase::find($purchase_id);

        // $totalAmountShoudPay = 0;
        // foreach($purchaseDetails as $purchaseDetail){
        //     $totalAmountShoudPay = $totalAmountShoudPay  + ($purchaseDetail->product_price * $purchaseDetail->quantity);
        // }

        $purchase->purchases_received = true;
        if($purchase->save()){
            Session::flash('message' , 'لقد تم وضع المنتجات في المخزن بنجاح');
        
        }else{
            Session::flash('type' , 'error');
            Session::flash('message' , 'لا يمكن  تسليم البضاعة للزبون حتى يكمل الدفع');
        }
        
        return Redirect::to('purchases');
    }


    
    /**
     * @param int $quantity         -- The quantity at which I want to send the notification
     * @param array $products_id    -- the products that i want check there quantities before send 
     */
    // private function sendProductNotification(int $quantity)
    // {
    //     // before send a new notification delete the old one
    //     // DB::table('notifications')->where('type',ProductLessThenTenItems::class)->delete(); 

    //     // $users       = User::all();
    //     // $products    = Product::where('quatity' , '<=' ,$quantity )->select('id','quatity' ,'name' , 'product_code')->get();

    //     // foreach($products as $product){
    //     //     Notification::send($users,new ProductLessThenTenItems($product));
    //     // }
    // }



}
