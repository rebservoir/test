<?php

namespace TuFracc\Http\Controllers;

use Illuminate\Http\Request;
use TuFracc\Http\Requests;
use TuFracc\Http\Requests\UtilCreateRequest;
use TuFracc\Http\Controllers\Controller;
use TuFracc\Utiles;

class UtilesController extends Controller
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
        return view('admin.utiles_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UtilCreateRequest $request)
    {
        if($request->ajax()){
            
            $id_site = \Session::get('id_site');
            $newUtil = Utiles::create($request->all());
            $util = Utiles::find($newUtil->id);
            $util->id_site = $id_site;
            $util->save();

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
        $util = Utiles::find($id);

        return response()->json(
            $util->toArray()
            );
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
        $util = Utiles::find($id);
        $util->fill($request->all());
        $util->save();

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
        $util = Utiles::find($id);
        $util->delete();

        return response()->json([
            "mensaje"=>'eliminado'
            ]);
    }
}
