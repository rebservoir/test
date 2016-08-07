<?php

namespace TuFracc\Http\Controllers;

use Illuminate\Http\Request;
use TuFracc\Http\Requests;
use TuFracc\Http\Requests\UserCreateRequest;
use TuFracc\Http\Requests\UserUpdateRequest;
use TuFracc\Http\Controllers\Controller;
use TuFracc\User;
use TuFracc\Cuotas;
use TuFracc\Pagos;
use TuFracc\Sites;
use TuFracc\Sites_users;
use TuFracc\Sites_users_deleted;
use TuFracc\Plans;
use Session;
use Redirect;
use Excel;
use DB;
use Hash;
use Mail;
use Illuminate\Routing\Route;
use Illuminate\Database\Eloquent;
use Illuminate\Contracts\Auth\Guard;

class UsuarioController extends Controller
{
    protected $auth;

    public function __construct(Guard $auth){
        $this->middleware('auth');
        $this->middleware('admin');
        $this->auth = $auth;
       // $this->beforeFilter('@find', ['only' => ['edit','update','destroy']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(10);
        $users->setPath('/laravel5_1/public/usuario');
        return view('usuario.usuarios',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('usuario.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateRequest $request)
    {

        if($request->ajax()){

            $id_site = \Session::get('id_site');
            $admin_email = $this->auth->user()->email;
            $sitio = Sites::where('id', $id_site)->get();
            $sitio_plan = DB::table('sites')->where('id', $id_site )->value('plan');
            //$plan = Plans::where('id', $sitio_plan )->get();
            $user_limit = DB::table('plans')->where('id', $id_site )->value('user_limit');
            $user_count = DB::table('sites_users')->where('id_site', $id_site)->count();
            $password = substr( md5(microtime()), 1, 6);
            $sitio_this = Sites::findOrFail($id_site);

            if( $user_count<$user_limit){

                $new_user = DB::table('users')->insertGetId(
                    ['name' => $request->name,
                     'email' => $request->email ,
                     'address' => $request->address,
                     'phone' => $request->phone,
                     'celphone' => $request->celphone,
                     'password' => Hash::make($password)
                     ]); 

                $usuario = User::find($new_user);

                DB::table('sites_users')->insert(
                ['id_user' => $new_user,
                 'id_site' => $id_site,
                 'type' => $request->type,
                 'role' => $request->role,
                 'status' => 1  
                 ]);

            //email invitacion
            $data = ['username'     => $usuario->name,
                     'user_email'   => $usuario->email,
                     'sitio'        => $sitio_this->name,
                     'admin_email'  => $admin_email,
                     'password'     => $password
                ];

            Mail::send('emails.invitacion', $data, function ($msj) use ($data) {
                $msj->subject('Invitación Bill Box');
                $msj->to($data['user_email']);
            });

                return response()->json([
                    "tipo" => 'success',
                    "message"=> 'Usuario Creado Exitosamente.'
                ]);
            }else{
                return response()->json([
                    "tipo" => 'limite',
                    "message"=>'Limite alcanzado. No se pueden crear más usuarios.'
                ]);

            }     
        }

    }

    public function checkEmail($email){

        $id_site = \Session::get('id_site');
        $user = DB::table('users')->where('email', $email )->first();
        
        if(!empty($user)){  //si existe
            //activo en este sitio?
            $sites_users = Sites_users::where('id_user',$user->id)->where('id_site',$id_site)->count();

            if($sites_users>0){ //activo en sitio
                return response()->json([
                    "res"=> "2"
                ]);

            }else{ //no activo en sitio

                //fue eliminado de este sitio?
                $site_user_del = Sites_users_deleted::where('id_user',$user->id)->where('id_site',$id_site)->count();

                if($site_user_del>0){ //fue eliminado de este sitio
                    return response()->json([
                        "res"=> "5",
                        "id_user"=> $user->id
                    ]);
                }else{ //otro sitio?

                    //esta en otro sitio?
                    $site_user = Sites_users::where('id_user',$user->id)->count();
                        
                    if($site_user>0){ //activo en otro sitio
                        return response()->json([
                            "res"=> "3",
                            "id_user"=> $user->id
                        ]);
                    }else{ // eliminado de otro sitio

                    return response()->json([
                            "res"=> "4",
                            "id_user"=> $user->id
                        ]);
                    }
                }
            }
        }else{  //no existe
            return response()->json([
                "res"=> "1"
            ]);
        }
        
    } 

    public function asignar($id, Request $request){

        $id_site = \Session::get('id_site');
        $admin_email = $this->auth->user()->email;
        $sitio = Sites::where('id', $id_site)->get();
        $sitio_plan = DB::table('sites')->where('id', $id_site )->value('plan');
        $user_limit = DB::table('plans')->where('id', $id_site )->value('user_limit');
        $user_count = DB::table('sites_users')->where('id_site', $id_site)->count();
        $sitio_this = Sites::findOrFail($id_site);
        $user = User::findOrFail($id);

        if( $user_count<$user_limit){
            
            //check status
            $adeudos = DB::table('pagos')->where('id_user', $id)->where('id_site', $id_site)->where('status', 0 )->count();

            if($adeudos>0){
                $status = 0;
            }else{
                $status = 1; 
            }

            DB::table('sites_users')->insert(
                     ['id_user' => $id,
                      'id_site' => $id_site,
                      'type' => $request->type,
                      'role' => $request->role,
                      'status' => $status  
                     ]);

            //email invitacion
            $data = ['username'     => $user->name,
                     'user_email'   => $user->email,
                     'sitio'        => $sitio_this->name,
                     'admin_email'  => $admin_email,
                     'password'     => 'Contraseña Actual'
                ];

            Mail::send('emails.invitacion', $data, function ($msj) use ($data) {
                $msj->subject('invitación Bill Box');
                $msj->to($data['user_email']);
            });

            return response()->json([
                "res" => 'ok'
            ]);

        }else{
            return response()->json([
                "res" => 'fail'
            ]);
        }

    }

    public function reactivar($id, UserUpdateRequest $request){

        $id_site = \Session::get('id_site');
        $admin_email = $this->auth->user()->email;
        $sitio = Sites::where('id', $id_site)->get();
        $sitio_plan = DB::table('sites')->where('id', $id_site )->value('plan');
        $user_limit = DB::table('plans')->where('id', $id_site )->value('user_limit');
        $user_count = DB::table('sites_users')->where('id_site', $id_site)->count();
        $password = substr( md5(microtime()), 1, 6);
        $sitio_this = Sites::findOrFail($id_site);

        if( $user_count<$user_limit){

            $site_user_del = DB::table('sites_users_deleted')->where('id_user',$id)->where('id_site',$id_site);
            $site_user_del->delete();

            $usuario = User::find($id);
            $usuario->name = $request->name;
            $usuario->email = $request->email;
            $usuario->address = $request->address;
            $usuario->phone = $request->phone;
            $usuario->celphone = $request->celphone;
            $usuario->password = Hash::make($password);
            $usuario->save();

            //check status
            $adeudos = DB::table('pagos')->where('id_user', $id)->where('id_site', $id_site)->where('status', 0 )->count();

            if($adeudos>0){
                $status = 0;
            }else{
                $status = 1; 
            }

            $react_user = DB::table('sites_users')->insert(
                    ['id_user' => $id,
                     'id_site' => $id_site,
                     'type' => $request->type,
                     'role' => $request->role,
                     'status' => $status
                     ]);

            //email invitacion
            $data = ['username'     => $usuario->name,
                     'user_email'   => $usuario->email,
                     'sitio'        => $sitio_this->name,
                     'admin_email'  => $admin_email,
                     'password'     => $password
                    ];

            Mail::send('emails.invitacion', $data, function ($msj) use ($data) {
                $msj->subject('Invitación Bill Box');
                $msj->to($data['user_email']);
            });            

            return response()->json([
                "res" => 'ok'
            ]);

        }else{
            return response()->json([
                "res" => 'fail'
            ]);
        }

    } 

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $id_site = \Session::get('id_site');
        $user = DB::select('select users.* FROM users JOIN sites_users ON sites_users.id_user = users.id AND sites_users.id_site = :id', ['id' => $id_site]);
        return response()->json($user);
    }

    public function search($id)
    {
        $current = 'usuarios';    
        $id_site = \Session::get('id_site');
        $id_user = $this->auth->user()->id;
        $sitios = Sites::where('id', $id_site)->get();
        $sites = Sites_users::where('id_user', $id_user)->count();
        $sitio_plan = DB::table('sites')->where('id', $id_site )->value('plan');
        $plan = Plans::where('id', $sitio_plan )->get();
        $user_count = DB::table('sites_users')->where('id_site', $id_site)->count();
        $tipos = Cuotas::orderBy('id', 'ASC')->lists('concepto','id');
        $users = User::where('id', $id)->get();
            return view('/admin/usuarios', ['current' => $current, 'users' => $users, 'tipos' => $tipos, 'user_count' => $user_count, 'plan'=>$plan, 'sitios' => $sitios, 'sites' => $sites ]);
    }

    public function add($id)
    {
        $users = User::where('id', $id)->get();
            return response()->json(
                    $users->toArray()
                );
    }

    public function sort($sort)
    {
        $current = 'usuarios'; 
        $id_site = \Session::get('id_site');
        $id_user = $this->auth->user()->id;
        $sitios = Sites::where('id', $id_site)->get();
        $sites = Sites_users::where('id_user', $id_user)->count();
        $sitio_plan = DB::table('sites')->where('id', $id_site )->value('plan');
        $plan = Plans::where('id', $sitio_plan )->get();
        $user_count = DB::table('sites_users')->where('id_site', $id_site)->count();
        $tipos = Cuotas::orderBy('id', 'ASC')->lists('concepto','id');
        $users = DB::select('select users.*, sites_users.status, sites_users.role, sites_users.type FROM users JOIN sites_users ON sites_users.id_user = users.id AND sites_users.id_site = :id', ['id' => $id_site]);
        $users = collect($users);

        if($sort == 'name'){
            $users = $users->sortBy('name');
        }else if($sort == 'desc'){
            $users = $users->sortByDesc('name');
        }else if($sort == 'email'){
            $users = $users->sortBy('email');
        }else if($sort == 'email_desc'){
            $users = $users->sortByDesc('email');
        }else if($sort == 'all'){
            $users = $users;
        }else if($sort == 'adeudo'){
            $users = $users->where('status', 0);
        }else if($sort == 'corriente'){
            $users = $users->where('status', 1);
        }                
            return view('/admin/usuarios', ['current' => $current, 'users' => $users, 'tipos' => $tipos, 'user_count' => $user_count, 'plan'=>$plan, 'sitios' => $sitios, 'sites' => $sites ]);
    }


    public function sort_usr($sort)
    {
        $id_site = \Session::get('id_site');
        
        if($sort == 1){ //all
            $users =DB::select('select users.id, users.name, users.email FROM users LEFT JOIN sites_users ON sites_users.id_user = users.id WHERE sites_users.role = 0 AND sites_users.id_site = :id_site ORDER BY users.name', ['id_site' => $id_site]);
        }else if($sort == 2){ //adeudo
            $users =DB::select('select users.id, users.name, users.email FROM users JOIN sites_users ON sites_users.id_user = users.id AND sites_users.id_site = :id_site AND sites_users.role = 0 AND sites_users.status = 0 order by users.name', ['id_site' => $id_site]);
        }else if($sort == 3){ //corriente
            $users =DB::select('select users.id, users.name, users.email FROM users JOIN sites_users ON sites_users.id_user = users.id AND sites_users.id_site = :id_site AND sites_users.role = 0 AND sites_users.status = 1 order by users.name', ['id_site' => $id_site]);
        }
            $users = collect($users);
            return response()->json(
                $users->toArray()
            );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id_site = \Session::get('id_site');
        $user = DB::select('select users.*, sites_users.status, sites_users.role, sites_users.type FROM users JOIN sites_users ON sites_users.id_user = users.id AND sites_users.id_user = :id_user AND sites_users.id_site = :id_site', ['id_user' => $id, 'id_site' => $id_site]);
        $user = collect($user);
        return response()->json(
            $user->toArray()
            );
    }

    public function edit_react($id)
    {
        $user = User::find($id);
        $user = collect($user);
        return response()->json(
            $user->toArray()
            );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {

            $user = User::find(6);
            $id_site = \Session::get('id_site');
            $user->fill($request->all());
            $user->save();
            /*
            $user->name = $request->name;
            $user->email = $request->email;
            $user->address = $request->address;
            $user->phone = $request->phone;
            $user->celphone = $request->celphone;
            $user->save();
            */
            DB::table('sites_users')->where('id_user', 6)->where('id_site', $id_site)
                ->update(['role' => $request->role, 'type' => $request->type]);

            return response()->json([
                "message"=>'listo'
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
        //$user = User::find($id);
        $site_user = DB::delete('delete from sites_users where id_site = ? and id_user = ?', [$id_site, $id]);
        DB::table('sites_users_deleted')->insert(['id_user' => $id,'id_site' => $id_site]);
        //$user->delete();

        return response()->json([
            "mensaje"=> $site_user
            ]);
    }


    public function loadData(Request $request){
        /*
        Excel::load('file/file.xlsx', function($file)
        {
            $result=$file->get();
          
            foreach ($result as $key => $value)
            {
                echo $value->nombre.'--'.$value->email.'--'.$value->direccion.'<br>';
            }
        
        })->get();
        */

        if($request->hasFile('file')){
            $file = $request->file('file');
            $result = Excel::load($file)->get();
        }   

        //$result = Excel::load('file/file.xlsx')->get();
        /*
        return response()->json(
                $result->toArray()
            );
        */
        $users = User::all();
        $tipos = Cuotas::lists('concepto','id');
        return view('/admin/usuarios', [ 'users' => $users, 'tipos' => $tipos, 'result' => $result ]);

    }


}
