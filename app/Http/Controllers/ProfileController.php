<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return company()->c_address;
        // return dd(password_verify('12345678'  , auth()->user()->password));
        return View::make('profile.default');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('profile.profile');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // return password_verify('12345678' , auth()->user()->password);
        
        // return $this->saveCompanyInfo($request , 'image');
        // 
        // return $this->saveCompanyInfo($request , 'image') ;
        return $request;

        
        switch($this->saveAdminInfo($request)){
            case 'password_error': 
                Session::flash('password' , 'the password is not correct');
                return back();
            break;
            case 'c_password_error':
                Session::flash('c_new_password' , 'Check Confirm Password if it matches your new password');
                return back();
            break;
            case 'save_error':
                Session::flash('message' , 'لقد حصل خطأ في حفظ البيانات الخاصة بمدير التطبيق');
                Session::flash('type'  , 'error');
                return back();
            break;
        }


        if($this->saveCompanyInfo($request , 'image') === false){
            Session::flash('message' , 'لقد حصل خطأ في حفظ البيانات الخاصة بالشركة');
            Session::flash('type'  , 'error');
            return back();
        }
        
        // if($this->saveAdminInfo($request)  == 'password_error'){
        //     return $this->saveAdminInfo($request);
        // }



        Session::flash('message' , 'the profile has been updated successfuly');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // return view('pro')
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function updateProfile()
    {
        return view('profile.profile');
    }



    protected function saveAdminInfo(Request $request)
    {
        $admin           = User::find(auth()->user()->id);
        $request->validate([
            'admin_name'      => 'required|string|max:30',
            'password'        => 'string|max:30',
            'new_password'    => 'string|max:30',
            'c_new_password'  => 'string|max:30',
        ]);
        $admin->name     = $request->admin_name;


        $hashed_password = $admin->password;
        if($request->password != '' &&  $request->new_password != '' && $request->c_new_password != ''){
            if(!password_verify($request->password, $hashed_password)){
                return 'password_error';
            }

            if($request->new_password  !==  $request->c_new_password){
                return 'c_password_error';
            }

            $admin->password = Hash::make($request->new_password);
        } 



        if(!$admin->save()){
            return 'save_error';
        }

        // return true;
    }
}
