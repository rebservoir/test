<?php

namespace TuFracc\Http\Controllers;

use Illuminate\Http\Request;
use TuFracc\Http\Requests;
use TuFracc\Http\Controllers\Controller;
use TuFracc\Http\Requests\SitioUpdateRequest;
use TuFracc\Sites;
use Session;
use Redirect;
use File;
use Illuminate\Routing\Route;

class SitesController extends Controller
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
        //
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
    public function edit($id_sitio)
    {
        $sitio = Sites::find($id_sitio);

        return response()->json(
            $sitio->toArray()
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

        $sitio = Sites::find($id_sitio);
        $sitio->name = $request->name;

        if($request->hasFile('path')){

            $oldFile = $sitio->path;
            $file = $request->file('path');
            $destination_path = public_path().'/file/';
            $name = 'sitio_' . time() . '.' . $file->getClientOriginalName();
            \Storage::disk('local')->put($name, \File::get($file));

            if(!empty($oldFile)){
                if (File::exists($destination_path.$oldFile)) {
                unlink($destination_path.$oldFile);
                }
            }
            $sitio->path = $name;
        }

        $sitio->save();

        \Session::flash('success', 'Sitio actualizado exitosamente.');

        return redirect()->to('/admin/home'); 
    }

    public function finanzas(SitioUpdateRequest $request){

        $id_site = \Session::get('id_site');
        $sitio = Sites::find($id_site);
        $sitio->fill($request->all());
        $sitio->save();
        
        Session::flash('update','Cambios realizados exitosamente');

        return Redirect::to('/admin/contenidos');
    }

    public function morosos(SitioUpdateRequest $request){

        $id_site = \Session::get('id_site');
        $sitio = Sites::find($id_site);
        $sitio->fill($request->all());
        $sitio->save();
        
        Session::flash('update','Cambios realizados exitosamente');

        return Redirect::to('/admin/contenidos');
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
