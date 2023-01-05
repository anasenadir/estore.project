<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
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
        return View::make('profile.default');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return dd($request->file('image'));
        
        // $image_path = $request->file('image')->store('image', 'public');
        // return  $request->file('image')->getRealPath();
        
        // return $request->hasFile('image')? 'Yes' : 'no';
        
        // return $image_name;
        // echo  $request->photo->path();
        // return $image_path;
        
        // echo $request->file('image')->getClientOriginalExtension();
        // return 'no';

        return $this->companyInfo($request , 'image');
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
        //
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



    protected function companyInfo(Request $request  , $form_image_name)
    {
        $image_name = $this->imageUploader($request , 'profile' , $form_image_name);

        $company =  Company::select('image_path' , 'address' ,'email' , 'phone' )->where(['id'=>1])->first();

        $company->image_path = $image_name ?? $company->image_path;
        $company->address    = $request->address ?? $company->address;
        $company->email      = $request->c_email ?? $company->email;
        $company->phone      = $request->c_phone ?? $company->phone;
        

        if($company->save()){
            Session::flash('message' , 'لقد تم تعديل العميل  بنجاح');
        }else{
            Session::flash('message' , 'لقد حصل خطأ في  تعديل العميل');
        }


    }


    protected function imageUploader(Request $request , string $destination_folder_name ,  string $form_iamge_name )
    {  
        if ($request->hasFile($form_iamge_name) && $request->file($form_iamge_name)->isValid())
        {
            $this->validate($request, [
                $form_iamge_name => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:4096',
            ]);
            $image_extension =  $request->file($form_iamge_name)-> getClientOriginalExtension();

            // The folder where we will put the images
            $path  = 'images/' . $destination_folder_name;

            // create a random image name
            $image_name = Str::random(10) . "." . $image_extension;


            $request->file($form_iamge_name)->move($path , $image_name);

            return $image_name;
        }
        return null;
    }


    protected function adminInfo(Request $request)
    {

    }
}
