<?php

namespace App\Http\Controllers;

use App\Models\ExpensesCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class ExpensesCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expensesCategories = ExpensesCategory::all();
        return view('expensesCategories.default')->with('expensesCategories' , $expensesCategories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('expensesCategories.create');
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
                    'E_category_name' => 'required|string',
                    'E_category_minimum_amount' => 'required|numeric'
                ]
            );  

            $expensesCategory = new ExpensesCategory();

            $expensesCategory->name             = $request->E_category_name;
            $expensesCategory->minimum_amount   = $request->E_category_minimum_amount;
            if($expensesCategory->save()){
                Session::flash('message' , trans('expensesCategories/create.creation_success_message'));
            }else{
                Session::flash('message' , trans('expensesCategories/create.creation_error_message'));
            } 
        }
        return redirect('expensesCategories');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ExpensesCategory  $expensesCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ExpensesCategory $expensesCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ExpensesCategory  $expensesCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(ExpensesCategory $expensesCategory)
    {
        return view('expensesCategories.edit') -> with('expensesCategory' , $expensesCategory);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ExpensesCategory  $expensesCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExpensesCategory $expensesCategory)
    {
        if(session('_token') == $request->post('_token') ){
            $request->validate([
                    'E_category_name' => 'required|string',
                    'E_category_minimum_amount' => 'required|numeric'
                ]
            );  
            $expensesCategory->name             = $request->E_category_name;
            $expensesCategory->minimum_amount   = $request->E_category_minimum_amount;
            if($expensesCategory->save()){
                Session::flash('message' , trans('expensesCategories/edit.editing_success_message'));
            }else{
                Session::flash('message' , trans('expensesCategories/edit.editing_error_message'));
            } 
        }
        return redirect('expensesCategories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExpensesCategory  $expensesCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExpensesCategory $expensesCategory)
    {
        if($expensesCategory->delete()){
            Session::flash('message' , trans('expensesCategories/default.deleting_success_message'));
        }else{
            Session::flash('message' , trans('expensesCategories/default.deleting_error_message'));
        } 
        return redirect('expensesCategories');
    }
}
