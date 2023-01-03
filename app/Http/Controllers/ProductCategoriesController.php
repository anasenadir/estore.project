<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ProductCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $productCategory = ProductCategory::find(1);
        // return $productCategory->products; 
        // ProductCategory::get
        $productCategories = ProductCategory::all();
        return view('productCategories.default' , compact('productCategories'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('productCategories.create');
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
                'name' => 'required|max:40'
            ]);

            $productCategory = new ProductCategory();
            $productCategory->name = $request->name;
            if($productCategory->save()){
                Session::flash('message' , 'لقد تم إنشاء الصنف بنجاح');
            }else{
                Session::flash('message' , 'لقد حصل خطأ في  إنشاء الصنف');
            }
        }
        return Redirect::to('ProductCategories');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ProductCategory $productCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id , ProductCategory $productCategory)
    {
        $productCategory = ProductCategory::find($id);
        // return $productCategory;//$id;
        return view('productCategories.edit' , compact('productCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function update($id,Request $request, ProductCategory $productCategory)
    {
        if(session('_token') == $request->post('_token') ){
            $request->validate([
                'name' => 'required|max:40'
            ]);
            $productCategory = ProductCategory::find($id);
            $productCategory->name = $request->name;
            // return $productCategory;
            if($productCategory->save()){
                Session::flash('message' , 'لقد تم تعديل الصنف بنجاح');
            }else{
                Session::flash('message' , 'لقد حصل خطأ في  تعديل الصنف');
            }
        }

        return Redirect::to('ProductCategories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id , ProductCategory $productCategory)
    {
        
        $productCategory = ProductCategory::find($id);
        if($productCategory->delete()){
            Session::flash('message' , 'لقد تم حذف الصنف بنجاح');
        }else{
            Session::flash('message' , 'لقد حصل خطأ في  حذف الصنف');
        }

        return Redirect::to('ProductCategories');
    }
}
