<?php

namespace App\Http\Controllers;

use App\Models\client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::all();
        return View::make('clients.default')
        ->with('clients' , $clients);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('clients.create');
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

            $client = new Client();
            $client->name          = $request->name;
            $client->email         = $request->email;
            $client->address       = $request->address;
            $client->phone_number  = $request->phone_number;
            if($client->save()){
                Session::flash('message' , 'لقد تم إضافة العميل  بنجاح');
            }else{
                Session::flash('message' , 'لقد حصل خطأ في  إضافة العميل');
            }
        }
        return Redirect::to('clients');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        return View::make('clients.edit')
            ->with('client' , $client);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        if(session('_token') == $request->post('_token') ){

            $request->validate([
                'name'             => 'required|string|max:30',
                'email'            => 'required|email',
                'address'          => 'required|string',
                'phone_number'     => 'required',
            ]);

            $client->name          = $request->name;
            $client->email         = $request->email;
            $client->address       = $request->address;
            $client->phone_number  = $request->phone_number;
            if($client->save()){
                Session::flash('message' , 'لقد تم تعديل العميل  بنجاح');
            }else{
                Session::flash('message' , 'لقد حصل خطأ في  تعديل العميل');
            }
        }
        return Redirect::to('clients');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        if($client->delete()){
            Session::flash('message' , 'لقد تم حذف العميل بنجاح');
        }else{
            Session::flash('message' , 'لقد حصل خطأ في  حذف العميل');
        }

        return Redirect::to('clients');
    }
}
