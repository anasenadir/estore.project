<?php

namespace App\Http\Controllers;

use App\Models\supplier;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use PhpParser\Node\Expr\Cast\Array_;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return User::all();
        // $suppliers  = Supplier::select('id', 'phone_number' , 'name' ,'name', 'email' , 'address' )->get();
        // $suppliers = Supplier::all();
        $suppliers = Cache::remember('suppliers' , 60 , function(){
            return Supplier::select('id', 'phone_number' , 'name' ,'name', 'email' , 'address' )->get();
        });
        // return $suppliers;
        return View::make('suppliers.default')
        ->with('suppliers', $suppliers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('suppliers.create');
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
                'name'             => 'required|string|max:30',
                'email'            => 'required|email',
                'address'          => 'required|string',
                'phone_number'     => 'required',
            ]);

            $supplier = new Supplier();
            $supplier->name          = $request->name;
            $supplier->email         = $request->email;
            $supplier->address       = $request->address;
            $supplier->phone_number  = $request->phone_number;
            if($supplier->save()){
                Session::flash('message' , 'لقد تم إضافة المورد  بنجاح');
            }else{
                Session::flash('message' , 'لقد حصل خطأ في  إضافة المورد');
            }
        }
        return Redirect::to('suppliers');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        // return $request;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        return View::make('suppliers.edit')
            ->with('supplier',  $supplier);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        if(session('_token') == $request->post('_token') ){

            $request->validate([
                'name'             => 'required|string|max:30',
                'email'            => 'required|email',
                'address'          => 'required|string',
                'phone_number'     => 'required',
            ]);

            $supplier->name          = $request->name;
            $supplier->email         = $request->email;
            $supplier->address       = $request->address;
            $supplier->phone_number  = $request->phone_number;
            if($supplier->save()){
                Session::flash('message' , 'لقد تم تعديل المورد  بنجاح');
            }else{
                Session::flash('message' , 'لقد حصل خطأ في  تعديل المورد');
            }
        }
        return Redirect::to('suppliers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        if($supplier->delete()){
            Session::flash('message' , 'لقد تم حذف المورد بنجاح');
        }else{
            Session::flash('message' , 'لقد حصل خطأ في  حذف المورد');
        }

        return Redirect::to('suppliers');
    }
}
