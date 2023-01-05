<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    

    public function  index()
    {
        return  view('profile.settings');
    }


    public function update(Request $request)
    {
        return $request;
    }


    protected function saveCompanyInfo(Request $request  , $form_image_name)
    {

        // return $request;
        $image_name = $this->imageUploader($request , 'profile' , $form_image_name);


        $company =  Company::find(1);

        $company->image_path = $image_name ?? $company->image_path;
        $company->address    = $request->c_address ?? $company->address;
        $company->email      = $request->c_email ?? $company->email;
        $company->phone      = $request->c_phone ?? $company->phone;
        

        // if there is an error
        if(!$company->save()){
            return false;
        }
        return true;
        // return dd($company->save());
    }


    protected function imageUploader(Request $request , string $destination_folder_name ,  string $form_iamge_name )
    {  
        if ($request->hasFile($form_iamge_name) && $request->file($form_iamge_name)->isValid())
        {
            // $this->validate($request, [
            //     $form_iamge_name => 'image|mimes:jpg,png,jpeg,gif,svg|max:4096',
            // ]);
            $image_extension =  $request->file($form_iamge_name)-> getClientOriginalExtension();

            // The folder where we will put the images
            $path  = 'images/' . $destination_folder_name;

            // create a random image name
            $image_name = 'logo' . "." . $image_extension;


            $request->file($form_iamge_name)->move($path , $image_name);

            return $image_name;
        }
        return null;
    }
}
