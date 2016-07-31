<?php

namespace TuFracc\Http\Controllers;

use Illuminate\Http\Request;
use TuFracc\Http\Requests;
use TuFracc\Http\Requests\CuotasCreateRequest;
use TuFracc\Http\Controllers\Controller;
use TuFracc\Cuotas;
use TuFracc\User;
use DB;

class CuotasController extends Controller
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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CuotasCreateRequest $request)
    {
        if($request->ajax()){

            $id_site = \Session::get('id_site');

            DB::table('cuotas')->insert(
                ['concepto' => $request->concepto,
                 'amount' => $request->amount,
                 'id_site' => $id_site
                ]);

            return response()->json([
                    "message" => "creado"
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
        $cuotas = Cuotas::find($id);

        return response()->json(
            $cuotas->toArray()
            );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CuotasCreateRequest $request, $id)
    {
        $cuotas = Cuotas::find($id);
        $cuotas->fill($request->all());
        $cuotas->save();

        return response()->json([
            "mensaje"=>'listo'
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id_site = \Session::get('id_site');
        $cuotas = Cuotas::find($id);
        $users = DB::table('sites_users')->where('id_site',$id_site)->where('type', $id)->get();

        if(empty($users)){
            $cuotas->delete();

            return response()->json([
                "tipo" => 'success',
                "message"=>'Cuota eliminada exitosamente.'
            ]);
        }else{

            return response()->json([
                "tipo" => 'warning',
                "message"=>'Atención: Esta cuota no puede ser eliminada porque ha sido asignada a usuarios.'
            ]);
        }

    }
}


