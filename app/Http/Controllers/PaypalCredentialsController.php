<?php

namespace TuFracc\Http\Controllers;

use Illuminate\Http\Request;
use TuFracc\Http\Requests;
use TuFracc\Http\Controllers\Controller;
use TuFracc\Sites;
use TuFracc\Paypal_credentials;
use Session;
use Redirect;
use File;
use Illuminate\Routing\Route;
use Illuminate\Database\Eloquent;
use Crypt;
use DB;

class PaypalCredentialsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $id_site = \Session::get('id_site');
        $credentials = Paypal_credentials::where('id_site', $id_site)->get();
        $credentials = collect($credentials);

        if(count($credentials) === 0) {
            
            DB::table('paypal_credentials')->insert(
                ['client_id' => $request->client_id,
                 //'secret' => Crypt::encrypt($request->secret),
                 'secret' => $request->secret,
                 'id_site' => $id_site
                ]);

            return response()->json([
                "message" => "creado"
            ]);

        }else{

            $id = Paypal_credentials::where('id_site', $id_site)->value('id');

            $sitio = Paypal_credentials::find($id);
            $sitio->client_id = $request->client_id;
            //$sitio->secret = Crypt::encrypt($request->secret);
            $sitio->secret = $request->secret;
            $sitio->save();

            return response()->json([
                    "message" => "actualizado"
                ]);

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $credentials = Paypal_credentials::where('id_site', $id)->get();

        return response()->json(
            $credentials->toArray()
            );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SitioUpdateRequest $request, $id_sitio)
    { 

       
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
}
