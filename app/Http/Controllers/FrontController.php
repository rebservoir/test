<?php

namespace TuFracc\Http\Controllers;

use Illuminate\Http\Request;
use TuFracc\Http\Requests;
use TuFracc\Http\Requests\UserCreateRequest;
use TuFracc\Http\Requests\UserUpdateRequest;
use TuFracc\Http\Controllers\Controller;
use TuFracc\User;
use TuFracc\Noticia;
use TuFracc\Utiles;
use TuFracc\Pagos;
use TuFracc\Egresos;
use TuFracc\Saldos;
use TuFracc\Cuotas;
use TuFracc\Sites;
use TuFracc\Sites_users;
use TuFracc\Plans;
use TuFracc\Calendario;
use TuFracc\Documentos;
use DB;
use Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Contracts\Auth\Guard;
use Closure;
use Session;
use Redirect;
use Mail;
use Hash;
use Illuminate\Database\Eloquent;

class FrontController extends Controller
{
    protected $auth;

    public function __construct(Guard $auth){
        $this->middleware('auth', ['only' => ['index', 'admin', 'file' , 'contacto', 'noticias', 'cuenta', 
            'sitio','admin_modulo','contenidos','calendario','finanzas', 'usuarios']]);
    
        $this->auth = $auth;

        if(!\Session::has('pagos_id')) \Session::put('pagos_id', array());
        if(!\Session::has('pagos_data')) \Session::put('pagos_data', array());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function CheckSites(){
        $id_user = $this->auth->user()->id;
        $sites = Sites_users::where('id_user', $id_user)->get();

        if( ($sites->count())>1){
            $sitios = DB::select('select sites.* FROM sites INNER JOIN sites_users ON sites_users.id_user = :id_user AND sites.id = sites_users.id_site', ['id_user' => $id_user]);
            return view('sites', [ 'sitios' => $sitios ]);
        }else{
            $id_site = Sites_users::where('id_user', $id_user)->value('id_site');
            return redirect()->to('setSite/'.$id_site);
        }
    }

    public function setSite($id_site){
        
        $id_user = $this->auth->user()->id;
        $is_site = Sites_users::where('id_user', $id_user)->where('id_site',$id_site)->count();
        
        if($is_site==0){
            return redirect()->to('home');
        }else{
            \Session::put('id_site', $id_site );
            return redirect()->to('home');
        }
    }

    public function index()
    {
        $current = 'home';
        $id_site = \Session::get('id_site');
        $id_user = $this->auth->user()->id;
        $user_role = Sites_users::where('id_site',$id_site)->where('id_user',$id_user)->value('role');
    
        if($user_role == 0){
            $users = DB::select('select users.name FROM users JOIN sites_users ON sites_users.id_user = users.id WHERE sites_users.role = 0 AND sites_users.status = 0 AND sites_users.id_site = :id_site ORDER BY users.name', ['id_site' => $id_site]);
            $noticias = Noticia::where('id_site', $id_site)->orderBy('created_at','desc')->take(2)->get();
            $sitios = Sites::where('id', $id_site)->get();
            $sites = Sites_users::where('id_user', $id_user)->count();
            return view('index', ['current' => $current,'users' => $users, 'noticias' => $noticias, 'sitios' => $sitios, 'sites' => $sites ]);
        }else if($user_role == 1){
            return redirect()->to('/admin/home');
        }
        
    }

    public function login()
    {
        return view('login');
    }

    public function noticias(Request $request)
    {
        $current = 'noticias';
        $id_site = \Session::get('id_site');
        $id_user = $this->auth->user()->id;
        $user_role = Sites_users::where('id_site',$id_site)->where('id_user',$id_user)->value('role');
        $sitios = Sites::where('id', $id_site)->get();
        $sites = Sites_users::where('id_user', $id_user)->count();
        $noticias = Noticia::where('id_site', $id_site )->orderBy('created_at', 'desc')->paginate(5);

        if($user_role != 1){
            $noticias->setPath('/noticias');
            if($request->ajax()){
            return view('noticia.noticias', ['current' => $current,'noticias' => $noticias, 'sitios' => $sitios]);
            }
            return view('noticias', ['current' => $current,'noticias' => $noticias, 'sitios' => $sitios, 'sites' => $sites]);
        }else{
            $noticias->setPath('/admin/noticias');
            return view('admin.noticias', ['current' => $current,'noticias' => $noticias, 'sitios' => $sitios, 'sites' => $sites]);
        }
    }

    public function cuenta()
    {
        $current = 'cuenta';
        $id_site = \Session::get('id_site');
        $sitios = Sites::where('id', $id_site)->get();
        $pagos = Pagos::where(function ($query) {
            $id_site = \Session::get('id_site');
                $query->where('id_user', $this->auth->user()->id)
                ->where('id_site', $id_site)
                ->orderBy('date', 'asc');
                  })->get();
        $id_user = $this->auth->user()->id;

        $ultimo_p = DB::table('pagos')->where('id_user', $id_user)->where('status', 1)->where('id_site', $id_site)->orderBy('date', 'dsc')->get();
        $vencidos = DB::table('pagos')->where('id_user', $id_user)->where('status', 0)->orWhere('status', 2)->where('id_site', $id_site)->orderBy('date', 'asc')->get();
        
        $user_type = Sites_users::where('id_site',$id_site)->where('id_user',$id_user)->value('type');
        $cuota = Cuotas::find($user_type);
        $cuota = $cuota->amount;

        $sites = Sites_users::where('id_user', $id_user)->count();
        
        return view('cuenta', ['current' => $current,'vencidos' => $vencidos,'pagos' => $pagos, 
                                'sitios' => $sitios, 'ultimo_p' => $ultimo_p, 'cuota' => $cuota, 'sites' => $sites]);
    }

    public function miSitio()
    {
        $current = 'misitio';
        $id_site = \Session::get('id_site');
        $id_user = $this->auth->user()->id;
        $utiles = Utiles::where('id_site', $id_site )->get();
        $sitios = Sites::where('id', $id_site)->get();
        $sites = Sites_users::where('id_user', $id_user)->count();
        $documentos = Documentos::where('id_site', $id_site )->get();
        return view('sitio/misitio', ['current' => $current,'utiles' => $utiles, 'sitios' => $sitios, 'sites' => $sites, 'documentos' => $documentos]);
    }

    public function finanzas($mes_sel=null, $year_sel=null)
    {   
        $current = 'finanzas';
        $id_site = \Session::get('id_site');
        $id_user = $this->auth->user()->id;
        $user_role = Sites_users::where('id_site',$id_site)->where('id_user',$id_user)->value('role');
        $saldos = Saldos::where('id_sitio',$id_site)->get();

        if(!$mes_sel)
            $mes_sel = date('n');
        if(!$year_sel)
            $year_sel= date('Y');

        $pagos = Pagos::where('id_site', $id_site )->get();
        $egresos = Egresos::where('id_site', $id_site )->get();
        $sites = Sites_users::where('id_user', $id_user)->count();
        $sitios = Sites::where('id', $id_site)->get();

        if($user_role == 1){
            return view('admin/finanzas', ['current' => $current,'pagos' => $pagos,'egresos' => $egresos, 'saldos' => $saldos, 'mes_sel' => $mes_sel, 'year_sel' => $year_sel, 'sites' => $sites, 'sitios' => $sitios ]);
        }else{
            return view('finanzas', ['current' => $current,'pagos' => $pagos,'egresos' => $egresos, 'saldos' => $saldos, 'mes_sel' => $mes_sel, 'year_sel' => $year_sel, 'sites' => $sites, 'sitios' => $sitios ]);     
        }  
    }

    
    public function calendario($mes_sel=null, $year_sel=null)
    {   
        $current = 'calendario';
        $id_site = \Session::get('id_site');
        $id_user = $this->auth->user()->id;

        if(!$mes_sel)
            $mes_sel = date('n');
        if(!$year_sel)
            $year_sel= date('Y');

        $sitios = Sites::where('id', $id_site)->get();
        $sites = Sites_users::where('id_user', $id_user)->count();
        $calendario = Calendario::where('id_site', $id_site )->get();
        $user_role = Sites_users::where('id_site',$id_site)->where('id_user',$id_user)->value('role');

        if($user_role == 1){
            return view('admin/calendario', ['current' => $current,'mes_sel' => $mes_sel, 'year_sel' => $year_sel, 'sitios' => $sitios, 'sites' => $sites, 'calendario' => $calendario ]);
        }else{
            return view('calendario', ['current' => $current,'mes_sel' => $mes_sel, 'year_sel' => $year_sel, 'sitios' => $sitios, 'sites' => $sites, 'calendario' => $calendario ]);     
        }  
    }


    public function contacto()
    {
        $current = 'contacto';
        $id_site = \Session::get('id_site');
        $id_user = $this->auth->user()->id;
        $sitios = Sites::where('id', $id_site)->get();
        $sites = Sites_users::where('id_user', $id_user)->count();
        return view('contacto', ['current' => $current,'sitios' => $sitios, 'sites' => $sites ]);
    }

    public function admin()
    {   
        $current = 'home';
        $id_site = \Session::get('id_site');
        $id_user = $this->auth->user()->id;
        $sites = Sites_users::where('id_user', $id_user)->count();
        $user_role = Sites_users::where('id_site',$id_site)->where('id_user',$id_user)->value('role');
        
        if($user_role == 1){
                $users =DB::select('select users.name FROM users JOIN sites_users ON sites_users.id_user = users.id WHERE sites_users.role = 0 AND sites_users.status = 0 AND sites_users.id_site = :id_site ORDER BY users.name', ['id_site' => $id_site]);
                $sitios = Sites::where('id', $id_site)->get();
                $noticias = Noticia::where('id_site', $id_site)->orderBy('created_at','desc')->take(2)->get();
                return view('admin/index', ['current' => $current,'noticias' => $noticias, 'users' => $users, 'sitios' => $sitios, 'sites' => $sites]);
        }else{
                 return Redirect::to('home');
        }
    }

    public function admin_modulo()
    {
        $current = 'admin';
        $id_site = \Session::get('id_site');
        $id_user = $this->auth->user()->id;
        $user_role = Sites_users::where('id_site',$id_site)->where('id_user',$id_user)->value('role');
        $sites = Sites_users::where('id_user', $id_user)->count();

        if($user_role == 1){
            $id_site = \Session::get('id_site');
            $sitios = Sites::where('id', $id_site)->get();
            $sitio_plan = DB::table('sites')->where('id', $id_site )->value('plan');
            $plan = Plans::where('id', $sitio_plan )->get();
            $user_count = DB::table('sites_users')->where('id_site', $id_site)->count();
            $pagos = Pagos::where('id_site', $id_site )->get();
            $egresos = Egresos::where('id_site', $id_site )->get();
            $cuotas = Cuotas::where('id_site', $id_site )->orderBy('concepto', 'ASC')->get();

            return view('/admin/admin_modulo', ['current' => $current,'pagos' => $pagos, 'egresos' => $egresos, 'cuotas' => $cuotas,
                'sitios' => $sitios, 'plan' => $plan, 'id_site' => $id_site, 'user_count'=>$user_count,  'sites' => $sites ]);
        }else{
                 return Redirect::to('home');
        }
    }

    public function contenidos()
    {
        $current = 'contenidos';
        $id_site = \Session::get('id_site');
        $id_user = $this->auth->user()->id;
        $user_role = Sites_users::where('id_site',$id_site)->where('id_user',$id_user)->value('role');
        $sites = Sites_users::where('id_user', $id_user)->count();

        if($user_role == 1){
            $noticias = Noticia::where('id_site', $id_site )->get();
            $documentos = Documentos::where('id_site', $id_site )->get();
            $utiles = Utiles::where('id_site', $id_site )->get();
            $sitios = Sites::where('id', $id_site)->get();
            return view('/admin/contenidos', ['current' => $current,'sitios' => $sitios,  'sites' => $sites, 'utiles' => $utiles, 
                'noticias' => $noticias, 'documentos' => $documentos ]);
        }else{
            return Redirect::to('home');
        }
    }

    public function usuarios(){

        $current = 'usuarios'; 
        $id_site = \Session::get('id_site');
        $id_user = $this->auth->user()->id;
        $user_role = Sites_users::where('id_site',$id_site)->where('id_user',$id_user)->value('role');
        $sites = Sites_users::where('id_user', $id_user)->count();

        if($user_role == 1){
                $id_site = \Session::get('id_site');
                $sitios = Sites::where('id', $id_site)->get();
                $sitio_plan = DB::table('sites')->where('id', $id_site )->value('plan');
                $plan = Plans::where('id', $sitio_plan )->get();
                $user_count = DB::table('sites_users')->where('id_site', $id_site)->count();
                $users = DB::select('select users.*, sites_users.status, sites_users.role, sites_users.type FROM users JOIN sites_users ON sites_users.id_user = users.id AND sites_users.id_site = :id', ['id' => $id_site]);
                
                $tipos = Cuotas::where('id_site', $id_site )->lists('concepto','id');

            return view('/admin/usuarios', ['current' => $current,'users' => $users, 'tipos' => $tipos, 'user_count' => $user_count, 'plan'=>$plan, 'sitios' => $sitios, 'sites' => $sites ]);
        }else{
            return Redirect::to('home');
        }
    }

    public function edit_info($id)
    {
        $user = User::find($id);

        return response()->json(
            $user->toArray()
            );
    }

    public function pagos_show()
    {
        $id_site = \Session::get('id_site');
        $pagos_show = Pagos::where(function ($query) {
                $query->where('id_user', $this->auth->user()->id)
                ->where('id_site', $id_site)
                ->where('status', 0);
                  })->get();

        return response()->json(
            $pagos_show->toArray()
            );
    }

    public function update_info_user($id, UserUpdateRequest $request)
    {
        $user = User::find($id);
        $user->fill($request->all());
        $user->save();

            return response()->json([
                "message"=>'listo'
            ]);
    }

    public function changePass($id, Request $request){

        $user = User::find($id);
        $new_pass = $request->new_pass;
        $new_pass_2 = $request->new_pass_2;
        $c1 = strlen($new_pass);
        $c2 = strlen($new_pass_2);

        if(Hash::check($request->pass, $user->password)){
            if( ($c1>=6) && ($c2>=6) ){
                if($new_pass == $new_pass_2){

                    $user->password = Hash::make($new_pass);
                    $user->save();

                    return response()->json([
                        "res" => 'success',
                        "msg"=>'La contraseña ha sido modificada.'
                    ]);
                }else{
                    return response()->json([
                        "res" => 'fail',
                        "msg"=>'La nueva contraseña no coincide con la confirmación.'
                    ]);
                }    
            }else{
                    return response()->json([
                        "res" => 'fail',
                        "msg"=>'La nueva contraseña debe tener mínimo 6 caracteres.'
                    ]);
                 } 
        }else{
            return response()->json([
                "res" => 'fail',
                "msg"=>'La contraseña actual no es correcta.'
            ]);
        }

        
    }

    public function corte_finanzas(){

        $d='01';
        $m='08';
        $y='2016';
        $fecha = $y.'-'.$m.'-'.$d;

        $id_site = \Session::get('id_site');
        $pagos = Pagos::where('id_site', $id_site )->where('fecha_pago', '>=', $fecha)->get();
        $egresos = Egresos::where('id_site', $id_site )->where('date', '>=', $fecha)->get();

        $total_ingresos = 0;
        $total_egresos = 0;
        $saldo = 0;

        foreach($pagos as $pago){
           $total_ingresos .= $pago->amount;
        }
        foreach($egresos as $egreso){
           $total_egresos .= $egreso->amount;
        }

        $saldo = $total_ingresos - $total_egresos;

        DB::table('saldos')->insert(
                            [  
                                'id_sitio' => $id_site,
                                'saldo' => $saldo,
                                'date' => $fecha
                            ]);

    }

    public function test(){
        \Log::info('I was here @ ' . \Carbon\Carbon::now());
    }


} // end
