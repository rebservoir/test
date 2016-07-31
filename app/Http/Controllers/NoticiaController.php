<?php

namespace TuFracc\Http\Controllers;

use Illuminate\Http\Request;
use TuFracc\Http\Requests;
use TuFracc\Http\Requests\NoticiaCreateRequest;
use TuFracc\Http\Requests\NoticiaUpdateRequest;
use TuFracc\Http\Controllers\Controller;
use TuFracc\Noticia;
use TuFracc\Sites;
use TuFracc\Sites_users;
use Illuminate\Contracts\Auth\Guard;
use Session;
use Redirect;
use File;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Input;

class NoticiaController extends Controller
{

    protected $auth;

    public function __construct(Guard $auth){
        $this->middleware('auth', ['only' => ['show']]);
    
        $this->auth = $auth;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('noticia.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(NoticiaCreateRequest $request)
    {
        if($request->ajax()){

            $id_site = \Session::get('id_site');
            $new = Noticia::create($request->all());
            $noticia = Noticia::find($new->id);
            $noticia->id_site = $id_site;
            $noticia->save();

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
        $id_site = \Session::get('id_site');
        $id_user = $this->auth->user()->id;
        $noti_show = Noticia::where('id', $id)->get();
        $sitios = Sites::where('id', $id_site)->get();
        $sites = Sites_users::where('id_user', $id_user)->count();
        $user_role = Sites_users::where('id_site',$id_site)->where('id_user',$id_user)->value('role');

        if($user_role == 1){
            return view('admin.noticia.show',['noti_show'=>$noti_show, 'sitios' => $sitios, 'sites' => $sites]);    
        }else{
            return view('noticia.show',['noti_show'=>$noti_show, 'sitios' => $sitios, 'sites' => $sites]);   
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $noticia = Noticia::find($id);

        return response()->json(
            $noticia->toArray()
            );
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
            $id = $request->id_noti_1;
            $noticia = Noticia::find($id);
            $noticia->titulo = $request->titulo;
            $noticia->texto = $request->texto;

            if($request->hasFile('path')){
                $oldFile = $noticia->path;
                $file = $request->file('path');
                $destinationPath = 'file/';
                //$file = 'noticia_' . time() . '.' . $file->getClientOriginalName();
                //\Storage::disk('local')->put($name, \File::get($file));

                if(File::isFile($oldFile)){
                    if(File::exists($destinationPath.$oldFile)){
                        unlink($destinationPath.$oldFile);
                    }
                }
                
                $noticia->path = $file;
            }

            $noticia->save();

            \Session::flash('update', 'Noticia actualizada exitosamente.');

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
        $noticia = Noticia::find($id);
        $file = 'file/'.$noticia->path;
        $noticia->delete();

        if(File::exists($file)){
            unlink($file);
        }

        return response()->json([
            "mensaje"=>'eliminado'
        ]);

    }
}
