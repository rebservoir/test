<?php

namespace TuFracc\Http\Controllers;

use Illuminate\Http\Request;
use TuFracc\Http\Requests;
use TuFracc\Http\Controllers\Controller;
use TuFracc\Documentos;
use TuFracc\Http\Requests\DocumentosCreateRequest;
use TuFracc\Http\Requests\DocumentosUpdateRequest;
use Session;
use Redirect;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Routing\Route;
use File;
use DB;

class DocumentosController extends Controller
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
    public function store(DocumentosCreateRequest $request)
    {
        if($request->ajax()){
            $id_site = \Session::get('id_site');
            $newDoc = Documentos::create($request->all());
            $doc = Documentos::find($newDoc->id);
            $doc->id_site = $id_site;
            $doc->save();

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
        $documentos = Documentos::find($id);

        return response()->json(
            $documentos->toArray()
            );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DocumentosUpdateRequest $request, $id)
    {
        $id = $request->id_doc;
        $documento = Documentos::find($id);
        $documento->titulo = $request->titulo;

            if($request->hasFile('path')){
                $oldFile = $documento->path;
                $file = $request->file('path');
                $destinationPath = 'file/';

                if(File::isFile($oldFile)){
                    unlink($destinationPath.$oldFile);
                }
                $documento->path = $file;
            }

            $documento->save();

            \Session::flash('update', 'Documento actualizado exitosamente.');

            return redirect()->to('/admin/contenidos'); 

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $documentos = Documentos::find($id);
        $file = 'file/'.$documentos->path;
        $documentos->delete();

        if(File::exists($file)){
            unlink($file);
        }

        \Session::flash('update', 'Documento eliminado exitosamente.');

            return response()->json([
                "mensaje"=>'eliminado'
                ]);
    }
}
