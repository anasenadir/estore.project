<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $products = Product::all();
        // $products = Product::with('productCategory')->get();


        // return Cache::get('products');
        // return Product::with('productCategory')->get();
        
        $products = Cache::remember('products'  , 60 , function(){
            return Product::with('productCategory')->get();
        });

        // return $products;
        // return $products->dd();
        return View::make('product.default')
            ->with('products' ,  $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productCategories  = ProductCategory::all();
        return View::make('product.create')
            ->with('productCategories' , $productCategories);
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
                'product_name'      => 'required|string|max:30',
                'product_quantity'  => 'required|integer',
                'category'          => 'required|integer',
                'buy_price'         => 'required|numeric',
                'sell_price'        => 'required|numeric',
                'product_code'      => 'required|string',
                'product_unit'      => 'required|integer',
            ]);

            $product = new Product();
            $product->name          = $request->product_name;
            $product->category_id   = $request->category;
            $product->quatity       = $request->product_quantity;
            $product->buy_price     = $request->buy_price;
            $product->sell_price    = $request->sell_price;
            $product->product_code  = $request->product_code;
            $product->unit          = $request->product_unit;
            if($product->save()){
                Session::flash('message' , 'لقد تم إضافة المنتج  بنجاح');
            }else{
                Session::flash('message' , 'لقد حصل خطأ في  إضافة المنتج');
            }
        }
        return Redirect::to('products');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {

        // update the notifications table and set read_at equal to now()
        DB::table('notifications')->where("data->id",$product->id )->update(['read_at'=> now()]);
        

        $productCategories  = ProductCategory::all();
        return View::make('product.edit')
            ->with('productCategories' , $productCategories)
            ->with('product', $product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $productCategories  = ProductCategory::all();
        return View::make('product.edit')
            ->with('productCategories' , $productCategories)
            ->with('product', $product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        if(session('_token') == $request->post('_token') ){
            $request->validate([
                'product_name'      => 'required|string|max:30',
                'product_quantity'  => 'required|integer',
                'category'          => 'required|integer',
                'buy_price'         => 'required|numeric',
                'sell_price'        => 'required|numeric',
                'product_code'      => 'required|string',
                'product_unit'      => 'required|integer',
            ]);

            $product->name          = $request->product_name;
            $product->category_id   = $request->category;
            $product->quatity       = $request->product_quantity;
            $product->buy_price     = $request->buy_price;
            $product->sell_price    = $request->sell_price;
            $product->product_code  = $request->product_code;
            $product->unit          = $request->product_unit;
            if($product->save()){
                Session::flash('message' , 'لقد تم تعديل المنتج  بنجاح');
            }else{
                Session::flash('message' , 'لقد حصل خطأ في  تعديل المنتج');
            }
        }
        return Redirect::to('products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if($product->delete()){
            Session::flash('message' , 'لقد تم حذف المنتج بنجاح');
        }else{
            Session::flash('message' , 'لقد حصل خطأ في  حذف المنتج');
        }

        return Redirect::to('products');
    }


    public function markAllAsRead()
    {
        DB::table('notifications')->where('read_at' , null)->update(['read_at' => now()]);
        return back();
    }

}
