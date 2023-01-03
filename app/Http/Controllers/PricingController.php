<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Pricing;
use App\Models\PricingDetails;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class PricingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $pricings = Pricing::all();

        // return $pricings[0]->prDetials;
        return View::make('pricing.default')
                ->with('pricings' , $pricings);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        $clients  = Client::all();
        return View::make('pricing.create')
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
                'client_id'      => 'required|integer'
            ]);
            $pricing                    = new Pricing();
            $pricing->client_id         = $request->client_id;
            $pricing->descount          = 0;
            $pricing->invoice_code      = 'NS54JdJ';
            $pricing->user_id           = Auth::user()->id;
            
            if(is_null($request->sele_quantities)){
                Session::flash('message' , "يجب عليك إختيار منتجات لكي تتم عملية التعديل"  );
                Session::flash('type' , 'error');
                return back();
            }



            if($pricing->save()){
                for($i =0 ; $i < count($request->sele_quantities) ; $i++){
                    $seleDetail                 = new PricingDetails();
                    $seleDetail->product_id     = $request->products_id[$i];
                    $seleDetail->quantity       = $request->sele_quantities[$i];
                    $seleDetail->product_price  = $request->expene_prices[$i];
                    $seleDetail->pricing_id     = $pricing->id ;
                    $seleDetail->save();

                    // i have created a trigger called --"decrease_quantity_when_sale_it"--
                    // to decrease the quantity automatically from stock 
                }
                Session::flash('message' , 'تم إنشاء التسعير  بنجاح');
            }else{
                Session::flash('message' , 'لقد حصل خطأ في  إنشاء التسعير');
            }
        }

        return Redirect::to('pricing');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pricing  $pricing
     * @return \Illuminate\Http\Response
     */
    public function show(Pricing $pricing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pricing  $pricing
     * @return \Illuminate\Http\Response
     */
    public function edit(Pricing $pricing)
    {
        $pricingDetails =  PricingDetails::where('pricing_id' , $pricing->id)->get();
        $clients    = Client::all();
        $products   = Product::all();

        $productsID = [];
        foreach($pricingDetails as $item){
            array_push($productsID , $item->product_id);
        }
        return View::make('pricing.edit')
            ->with('pricing' , $pricing)
            ->with('pricingDetails' , $pricingDetails)
            ->with('clients' , $clients)
            ->with('products' , $products)
            ->with('productsID' , $productsID);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pricing  $pricing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pricing $pricing)
    {
        if(session('_token') == $request->post('_token') ){
            $request->validate([
                'client_id'      => 'required|integer'
            ]);
            
            $pricing->client_id         = $request->client_id;
            $pricing->descount          = 0;
            $pricing->invoice_code      = 'NS54JdJ';
            $pricing->user_id           = Auth::user()->id;
            

            // if the admin doesn't select any product 
            if(is_null($request->sele_quantities)){
                Session::flash('message' , "يجب عليك إختيار منتجات لكي تتم عملية التعديل"  );
                Session::flash('type' , 'error');
                return back();
            }

            if($pricing->save()){
                // deleting the old deatils before insert the new records 
                $pricingDetails = PricingDetails::where('pricing_id' , $pricing->id)->delete();

                // inserting the new records to the details table and claculate the totalAmountShoudPay  
                for($i =0 ; $i < count($request->sele_quantities) ; $i++){
                    $pricingDetails                 = new PricingDetails();
                    $pricingDetails->product_id     = $request->products_id[$i];
                    $pricingDetails->quantity       = $request->sele_quantities[$i];
                    $pricingDetails->product_price  = $request->expene_prices[$i];
                    $pricingDetails->pricing_id     = $pricing->id ;
                    $pricingDetails->save();
                }
                Session::flash('message' , 'تم تعديل التسعير  بنجاح');
            }else{
                Session::flash('message' , 'لقد حصل خطأ في  تعديل التسعير');
            }
        }

        return Redirect::to('pricing');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pricing  $pricing
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pricing $pricing)
    {
        // i have created a trigger called --"delete_All_Data_Of_Sele"--
        // to delete all the related Data from the other tables
        if($pricing->delete()){
            Session::flash('message' , 'لقد تم حذف التسعير بنجاح');
        }else{
            Session::flash('message' , 'لقد حصل خطأ في  حذف التسعير');
        }

        return Redirect::to('pricing');
    }


    public function viewPricingInvoice($pricing_id)
    {
        $pricingDetails =  PricingDetails::where('pricing_id' , $pricing_id)->get();
        $type = 'view';
        return View::make('pricing.pdf')
            ->with('pricingDetails' , $pricingDetails)
            ->with('type' , $type);
    }

    public function dounload($pricing_id)
    {
        $pricingDetails =  PricingDetails::where('pricing_id' , $pricing_id)->get();
        $type = 'download';
        $pdf = Pdf::loadView('pricing.pdf', compact('pricingDetails' , 'type'));
        return $pdf->download('template'.time(). rand(90 , 9999).'.pdf');
    }

    public function sendMail($pricing_id){
        
        $pricingDetails =  PricingDetails::where('pricing_id' , $pricing_id)->get();
        $type = 'send';
        Mail::send('pricing.pdf',compact('pricingDetails' , 'type')  ,function ($message) use ($pricingDetails){
            $type = 'download';
            $pdf = Pdf::loadView('pricing.pdf', compact('pricingDetails' , 'type') );
            $message->to('anasenadir2001@gmail.com')
            ->from('anas@gmail.com')
            ->subject('Created At 2022-12-20')
            ->attachData($pdf->output() , 'texalume.pdf');
        });
        return back();
    }

}
