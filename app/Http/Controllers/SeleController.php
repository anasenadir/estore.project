<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Pricing;
use App\Models\Product;
use App\Models\Sele;
use App\Models\SeleDetails;
use App\Models\SeleReciepts;
use App\Models\User;
use App\Notifications\ProductLessThenTenItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class SeleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return auth()->user()->unreadNotifications[0]['data'][''];
        // $sele = Sele::find(2);/
        // return $sele->getInvoiceTotal();
        // return Sele::where('created_at', '>=' , now()->month())->get();
        // return Sele::all();

        // $seles = Sele::all();
        // $seles = Sele::with('client' , 'seleRciepts'  ,'details' )->get();
        
        $seles = Cache::remember('seles', 120, function () {
            return Sele::with('client' , 'seleRciepts'  ,'details' )->get();
        });
        // return implode($seles[0]->created_at , 'T') ;
        // return explode(' ' , $seles[0]->created_at)[0];


        //  send a notification to tell the admin whech procuct Close to completion
        // $this->sendProductNotification(10);
        
        return View::make('seles.default')
            ->with('seles' , $seles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients    = Cache::remember('clients' , 60 , function(){
            return Client::all();
        }) ;
        $products   = Cache::remember('products' , 60 , function(){
            return Product::all();
        }) ;
        return View::make('seles.create')
            ->with('clients' , $clients)
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
        if(session('_token') == $request->post('_token') ){
            $request->validate([
                'pyment_type'    => 'required|integer',
                'client_id'      => 'required|integer'
            ]);
            $sele                    = new Sele();
            $sele->client_id         = $request->client_id;
            $sele->pyment_type       = $request->pyment_type;
            $sele->pyment_status     = 0;
            $sele->descount          = 0;
            $sele->invoice_code      = 'NS54JdJ';
            $sele->user_id           = Auth::user()->id;
            

            if(is_null($request->sele_quantities)){
                Session::flash('message' , trans('seles/create.products_are_required')  );
                Session::flash('type' , 'error');
                // return Redirect::to('seles/create') ;
                // $clients    = Client::all();
                // $products   = Product::all();

                // return $products;
                return back();
            }

            // // check if the quantity in stock is enough
            for($i = 0 ; $i < count($request->sele_quantities) ; $i++){

                $product_id = $request->products_id[$i];
                $product = Product::find($product_id);
                
                // // check if the quantity in stock is enough
                if($request->sele_quantities[$i] > $product->quatity ){
                    Session::flash('message' , "المنتج  " . $product->name ." لا يوجد منه إلى ". $product->quatity."  عينة في المخزن "  );
                    Session::flash('type' , 'error');
                    return back();
                }
            }


            if($sele->save()){
                for($i =0 ; $i < count($request->sele_quantities) ; $i++){
                    $seleDetail                 = new SeleDetails();
                    $seleDetail->product_id     = $request->products_id[$i];
                    $seleDetail->quantity       = $request->sele_quantities[$i];
                    $seleDetail->product_price  = $request->expene_prices[$i];
                    $seleDetail->sele_id        = $sele->id ;
                    $seleDetail->save();

                    // i have created a trigger called --"decrease_quantity_when_sale_it"--
                    // to decrease the quantity automatically from stock 
                }
                Session::flash('message' , trans('seles/create.creation_success_message'));
            }else{
                Session::flash('message' , trans('seles/create.creation_error_message'));
            }
        }


        //  send a notification to tell the admin whech procuct Close to completion
        $this->sendProductNotification(10 , $request->products_id);

        return Redirect::to('seles');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sele  $sele
     * @return \Illuminate\Http\Response
     */
    public function show(Sele $sele)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sele  $sele
     * @return \Illuminate\Http\Response
     */
    public function edit(Sele $sele)
    {
        
        $seleDetails =  SeleDetails::where('sele_id' , $sele->id)->get();
        $clients    = Cache::remember('clients' , 60 , function(){
            return Client::all();
        }) ;
        $products   = Cache::remember('products' , 60 , function(){
            return Product::all();
        }) ;

        $productsID = [];
        foreach($seleDetails as $item){
            array_push($productsID , $item->product_id);
        }
        return View::make('seles.edit')
            ->with('sele' , $sele)
            ->with('seleDetails' , $seleDetails)
            ->with('clients' , $clients)
            ->with('products' , $products)
            ->with('productsID' , $productsID);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sele  $sele
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sele $sele)
    {
        if(session('_token') == $request->post('_token') ){
            $request->validate([
                'pyment_type'    => 'required|integer',
                'client_id'      => 'required|integer'
            ]);
            

            $sele->client_id         = $request->client_id;
            $sele->pyment_type       = $request->pyment_type;
            $sele->pyment_status     = 0;
            $sele->descount          = 0;
            $sele->invoice_code      = 'NS54JdJ';
            $sele->user_id           = Auth::user()->id;
            

            if(is_null($request->sele_quantities)){
                Session::flash('message' , trans('seles/edit.products_are_required')  );
                Session::flash('type' , 'error');
                // return Redirect::to('seles/create') ;
                // $clients    = Client::all();
                // $products   = Product::all();

                // return $products;
                return back();
            }

            // check if the quantity in stock is enough
            for($i = 0 ; $i < count($request->sele_quantities) ; $i++){

                $product_id = $request->products_id[$i];
                $product = Product::find($product_id);
                $seleDetail =  SeleDetails::where('sele_id' , $sele->id)->where('product_id' , $product_id)->first();
                // get the old quantity for checking quantity
                // DB::table('')
                // check if the quantity in stock is enough
                if($request->sele_quantities[$i] -  $seleDetail->quantity >  $product->quatity){
                    Session::flash('message' , "المنتج  " . $product->name ." لا يوجد منه إلى ". $product->quatity."  عينة في المخزن "  );
                    Session::flash('type' , 'error');
                    
                    
                    // return $products;
                    return back();
                }
            }

            
            if($sele->save()){
                // deleting all the old details from the details automatically table
                // using a trigger called --"deleting_old_details"--- 
                // ==================================== old way
                $seleDetails = SeleDetails::where('sele_id' , $sele->id)->delete();
                // =========================================================
                // after deleting the old details we added its quantity to the stock again using 
                // a trigger called --"add_deleted_quantity_to_stock"--  
                // =======================================================


                // inserting the new records to the details table and claculate the totalAmountShoudPay  
                $totalAmountShoudPay = 0;
                for($i =0 ; $i < count($request->sele_quantities) ; $i++){
                    $seleDetail                 = new SeleDetails();
                    $seleDetail->product_id     = $request->products_id[$i];
                    $seleDetail->quantity       = $request->sele_quantities[$i];
                    $seleDetail->product_price  = $request->expene_prices[$i];
                    $seleDetail->sele_id        = $sele->id ;
                    $seleDetail->save();

                    // i have created a trigger called --"decrease_quantity_when_sale_it"--
                    // to decrease the quantity automatically from stock 
                    // ============================================= old way
                    // $product = Product::find($request->products_id[$i]);
                    // $product->quatity = $product->quatity -  $request->sele_quantities[$i];
                    // $product->save();
                    // ==================================================

                    // $seleDetails ; 
                    $totalAmountShoudPay =  $totalAmountShoudPay + ($seleDetail->product_price  * $seleDetail->quantity );
                }

                // if what i have paid grater then the totalAmountShoudPay I will make a single record 
                // in the SeleReciepts tablecontains the totalAmountShoudPay as a pyment amount 
                if($sele->totalPaidAmmount() > $totalAmountShoudPay){
                    SeleReciepts::where('sele_id' , $sele->id )->delete();
                    $seleReciept                            = new SeleReciepts();
                    $seleReciept->pyment_type               = $request->pyment_type;
                    $seleReciept->sele_id                   = $sele->id;
                    $seleReciept->pyment_amount             = $totalAmountShoudPay;
                    $seleReciept->bank_name                 = '';
                    $seleReciept->bank_account_number       = '';
                    $seleReciept->chack_number              = '';
                    $seleReciept->transfered_to             = '';
                    $seleReciept->reciept_code              = 'AKJ45JD';
                    $seleReciept->user_id                   =  Auth::user()->id;
                    $seleReciept->save();
                }

                
                // i have created a trigger called --"changePaymentStatus"-- for chicking this conditions
                // ===============================================================old way
                // if($totalAmountShoudPay == $sele->totalPaidAmmount() || $totalAmountShoudPay < $sele->totalPaidAmmount()){
                //     // Payment completed successfully
                //     $sele->pyment_status = true;
                // }else{
                //     // Payment is made 
                //     $sele->pyment_status = false;
                // }
                // $sele->save();
                // ===================================================================
                
                Session::flash('message' , trans('seles/edit.editing_success_message'));
            }else{
                Session::flash('message' , trans('seles/edit.editing_error_message'));
            }
        }

        //  send a notification to tell the admin whech procuct Close to completion
        $this->sendProductNotification(10 , $request->products_id);
        return Redirect::to('seles');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sele  $sele
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sele $sele)
    {
        // i have created a trigger called --"delete_All_Data_Of_Sele"--
        // to delete all the related Data from the other tables
        // ============================================= old way 
        // SeleDetails::where('sele_id' , $sele->id)->delete();
        // SeleReciepts::where('sele_id' , $sele->id )->delete();
        // ===================================================
        if($sele->delete()){
            Session::flash('message' , trans('seles/create.deleting_success_message'));
        }else{
            Session::flash('message' , trans('seles/create.deleting_error_message'));
        }

        return Redirect::to('seles');
    }



    public function seleInvoiceDounload($id){
        // $data = [1];

        // $data = Sele::find($id);
        $seleDetails =  SeleDetails::where('sele_id' , $id)->get();
        $type = 'download';
        $pdf = Pdf::loadView('seles.pdf', compact('seleDetails' , 'type'));
        return $pdf->download('template'.time(). rand(90 , 9999).'.pdf');
        // return View::make('seles.pdf')
        //     ->with('seleDetails' , $seleDetails);
    }

    public function viewSeleInvoice($id){
        $seleDetails =  SeleDetails::where('sele_id' , $id)->get();
        $type = 'view';
        return View::make('seles.pdf')
            ->with('seleDetails' , $seleDetails)
            ->with('type' , $type);
    }

    public function sendSeleByMail($id){
        $seleDetails =  SeleDetails::where('sele_id' , $id)->get();
        
        $type = 'send';
        Mail::send('seles.pdf',compact('seleDetails' , 'type') ,function ($message) use ($seleDetails) {
            $type = 'download';
            $pdf = Pdf::loadView('seles.pdf', compact('seleDetails' , 'type'));
            $message->to('khadija@alumaco.com')
                    ->from('anas@gmail.com')
                    ->subject('Created At 2022-12-20')
                    ->attachData($pdf->output() , 'text.pdf');
        });
        return back();


    }

    // when a client take his products and invoice
    public function invoiceTooked($id){
        $seleDetails =  SeleDetails::where('sele_id' , $id)->get();
        $sele = Sele::find($id);

        $totalAmountShoudPay = 0;
        foreach($seleDetails as $seleDetail){
            $totalAmountShoudPay = $totalAmountShoudPay  + ($seleDetail->product_price * $seleDetail->quantity);
        }

        if($sele->totalPaidAmmount() == $totalAmountShoudPay){
            $sele->is_client_received = true;
            $sele->save();
            Session::flash('message' , 'لقد تم تسليم البضاعة للزبون بنجاح');
            
        }else{
            Session::flash('type' , 'error');
            Session::flash('message' , 'لا يمكن  تسليم البضاعة للزبون حتى يكمل الدفع');
        }
        
        return Redirect::to('seles');
    }


    //  convert a pricing invoice to a sele invoice using pricing_id 
    public function convertPrInvoiceToSeleContract(int $pricing_id)
    {
        // return $pricing_id;
        $pricing_invoice =  Pricing::find($pricing_id);

        if($pricing_invoice){
            $sele                    = new Sele();
            $sele->client_id         = $pricing_invoice->client_id;
            // by default payment type is cash 
            $sele->pyment_type       = 1;
            $sele->pyment_status     = 0;
            $sele->descount          = $pricing_invoice->descount;
            $sele->invoice_code      = 'NS54JdJ';
            $sele->user_id           = Auth::user()->id;


            // // check if the quantity in stock is enough
            foreach($pricing_invoice->prDetials as $prDetail)
            {
                // return $prDetail->product_id;
                $product_id = $prDetail->product_id;
                $product = Product::find($product_id);

                if(isset($product) && $prDetail->quantity > $product->quatity ){
                    Session::flash('message' , "المنتج  " . $product->name ." لا يوجد منه إلى ". $product->quatity."  عينة في المخزن "  );
                    Session::flash('type' , 'error');
                    // return Redirect::to('seles/create') ;
    
                    // return $products;
                    return back();
                }
            }

            $products_id = [];
            if($sele->save()){
                foreach($pricing_invoice->prDetials as $prDetail)
                {
                    $seleDetail                 = new SeleDetails();
                    $seleDetail->product_id     = $prDetail->product_id;
                    $seleDetail->quantity       = $prDetail->quantity;
                    $seleDetail->product_price  = $prDetail->product_price;
                    $seleDetail->sele_id        = $sele->id ;
                    $seleDetail->save();
                    
                    array_push($products_id , $prDetail->product_id);
                    // $products_id = [$prDetail->product_id];
                    // i have created a trigger called --"decrease_quantity_when_sale_it"--
                    // to decrease the quantity automatically from stock 
                }

                Session::flash('message' , trans('seles/create.creation_success_message'));
            }else{
                Session::flash('message' , trans('seles/create.creation_error_message'));
            }
            //  send a notification to tell the admin whech procuct Close to completion
            $this->sendProductNotification(10 , $products_id);
        }

        return back();

    }
    /**
     * @param int $quantity         -- The quantity at which I want to send the notification
     * @param array $products_id    -- the products that i want check there quantities before send 
     */
    private function sendProductNotification(int $quantity)
    {
        // before send a new notification delete the old one
        DB::table('notifications')->where('type',ProductLessThenTenItems::class)->delete(); 

        $users       = User::all();
        $products    = Product::where('quatity' , '<=' ,$quantity )->select('id','quatity' ,'name' , 'product_code')->get();

        foreach($products as $product){
            Notification::send($users,new ProductLessThenTenItems($product));
        }
    }




    
}
