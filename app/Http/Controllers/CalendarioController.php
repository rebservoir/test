<?php

namespace TuFracc\Http\Controllers;

use Illuminate\Http\Request;
use TuFracc\Http\Requests;
use TuFracc\Http\Requests\CalendarioCreateRequest;
use TuFracc\Http\Requests\CalendarioUpdateRequest;
use TuFracc\Http\Controllers\Controller;
use TuFracc\Calendario;
use Session;
use DB;
use Redirect;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Routing\Route;

class CalendarioController extends Controller
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
    public function store(CalendarioCreateRequest $request)
    {
        

        if($request->ajax()){

            $id_site = \Session::get('id_site');

            DB::table('calendario')->insert(
                ['title' => $request->title,
                 'start' => $request->start,
                 'end' =>   $request->end,
                 'id_site' => $id_site
                ]);

            return response()->json([
                    "message" => "creado"
                ]);
        }

        \Session::flash('update', 'Evento creado exitosamente.');
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
        $calendario = Calendario::find($id);

        return response()->json(
            $calendario->toArray()
            );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CalendarioUpdateRequest $request,$id)
    { 

        $calendario = Calendario::find($id);

        if($request->end === 0000-00-00){
            $calendario->end = '';
        }

        $calendario->start = $request->start;
        $calendario->end = $request->end;
        $calendario->save();

        \Session::flash('update', 'Evento actualizado exitosamente.');

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
        $calendario = Calendario::find($id);
        $calendario->delete();

        \Session::flash('update', 'Evento eliminado exitosamente.');

            return response()->json([
                "mensaje"=>'eliminado'
                ]);
    }
}
