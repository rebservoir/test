<?php

namespace TuFracc\Http\Controllers;

use Illuminate\Http\Request;
use TuFracc\Http\Requests;
use TuFracc\Http\Requests\PagoCreateRequest;
use TuFracc\Http\Requests\PagoUpdateRequest;
use TuFracc\Http\Controllers\Controller;
use TuFracc\Pagos;
use TuFracc\Sites;
use TuFracc\Sites_users;
use TuFracc\Cuotas;
use TuFracc\User;
use Illuminate\Contracts\Auth\Guard;
use Session;
use Redirect;
use Illuminate\Routing\Route;
use DB;
use Mail;
use App\Jobs\SendEmail;
use Illuminate\Database\Eloquent;


class PagosController extends Controller
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
    public function store(PagoUpdateRequest $request)
    {
        if($request->ajax()){

            $id_site = \Session::get('id_site');
            $id_user = $request->id_user;
            $user = User::find($id_user);
            $type = DB::table('sites_users')->where('id_site', $id_site)->where('id_user', $id_user)->value('type');
            $cuota = Cuotas::find($type);
            $pagos = DB::table('pagos')->where('id_user', $id_user)->where('id_site', $id_site)->get();
            $newDate = explode("-", $request->date);
            $flag=true;
            $meses = array("x","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

            $site = DB::table('sites')->where('id', $id_site)->value('name');
            $y = $newDate[0];
            $m = intval($newDate[1]);
            $d = $newDate[2];
            $concepto = $meses[$m].' '.$y;

            if(empty($user)){

                return response()->json([
                  "tipo" => 'fail',
                  "message" => 'Seleccionar un usuario.'
                ]);

            }else{

            if(empty($pagos)){

                 DB::table('pagos')->insert(
                            [   'id_user' => $id_user,
                                'date' => $request->date,
                                'status' => $request->status,
                                'amount' => $cuota->amount,
                                'user_name' => $user->name,
                                'id_site' => $id_site
                            ]);

                            if($request->status == 0){
                              $status = 'Adeudo';
                            }elseif($request->status == 1){
                              $status = 'Pagado';
                            }else{
                             $status = 'Pendiente';
                            }

                            $importe = '$'.number_format($cuota->amount, 2, '.', '');

                            $data = [ 'msg'=> 'pago generado', 'subj'=> 'Pago generado', 'user_mail'=> $user->email,
                            'usuario'=> $user->name,'site' => $site,'status' => $status,'fecha' => $request->date,
                            'name'=> $user->name,'address'=> $user->address,
                            'concepto'=> $concepto,'cuota' => $importe,'descuento' =>'0', 'importe' => $importe
                             ];

                            Mail::send('emails.pago_pendiente',$data, function ($msj) use ($data) {
                                $msj->subject($data['subj']);
                                $msj->to($data['user_mail']);
                            });

                            return response()->json([
                                "tipo" => 'success'
                            ]);

            }else{

                foreach($pagos as $value){
                    $date = explode("-", $value->date);
                    if(($date[0]==$newDate[0])&&($date[1]==$newDate[1])){
                        $flag=false;
                        break;
                    }
                }

                if($flag){

                    $ultimo = DB::table('pagos')->where('id_user', $id_user)->where('id_site', $id_site)->orderBy('date', 'dsc')->take(1)->value('date');

                    //get next year and month
                    $ultimo_pago = explode("-", $ultimo);
                        if(intval($ultimo_pago[1])==12){
                            $next_m = 1;
                            $next_y = intval($ultimo_pago[0])+1;
                        }else{
                            $next_m = intval($ultimo_pago[1])+1;
                            $next_y = intval($ultimo_pago[0]);
                        }

                            DB::table('pagos')->insert(
                            [   'id_user' => $id_user,
                                'date' => $request->date,
                                'status' => $request->status,
                                'amount' => $cuota->amount,
                                'user_name' => $user->name,
                                'id_site' => $id_site
                            ]);

                            if($request->status == 0){
                              $status = 'Adeudo';
                            }elseif($request->status == 1){
                              $status = 'Pagado';
                            }else{
                             $status = 'Pendiente';
                            }

                            $importe = '$'.number_format($cuota->amount, 2, '.', '');

                            $data = [ 'msg'=> 'pago generado', 'subj'=> 'Pago generado', 'user_mail'=> $user->email,
                            'usuario'=> $user->name,'site' => $site,'status' => $status,'fecha' => $request->date,
                            'name'=> $user->name,'address'=> $user->address,
                            'concepto'=> $concepto,'cuota' => $importe,'descuento' =>'0', 'importe' => $importe
                             ];

                            Mail::send('emails.pago_pendiente',$data, function ($msj) use ($data) {
                                $msj->subject($data['subj']);
                                $msj->to($data['user_mail']);
                            });

                            return response()->json([
                                "tipo" => 'success'
                            ]);
                
                    }else{
                        return response()->json([
                            "tipo" => 'fail',
                            "message" => 'Ya existe un pago para este mes y usuario.'
                        ]);
                    }

            }
      
          }
        } // end request ajax
    } //end function

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(){

        $id_site = \Session::get('id_site');
        $pagos_show = Pagos::where(function ($query) {
            $query->where('id_user', $id)
                ->where('status', 0)
                ->where('id_site', $id_site)
                ->sortBy('date');
                  })->get();

        return response()->json(
            $pagos_show->toArray()
            );
    }

    public function detalle($id){

        $id_site = \Session::get('id_site');
        $pagos = Pagos::where('id_user', $id)->where('id_site', $id_site)->orderBy('date', 'asc')->get();

        return response()->json(
            $pagos->toArray()
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
        $pago = Pagos::find($id);

        return response()->json(
            $pago->toArray()
            );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PagoUpdateRequest $request, $id)
    {
        $pago = Pagos::find($id);
        $pago->fill($request->all());
        $pago->save();

        \Session::flash('update', 'Pago actualizado exitosamente.');

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
        $pago = Pagos::find($id);
        $pago->delete();

        return response()->json([
            "mensaje"=>'eliminado'
            ]);
    }


    public function test(){
        //\Log::info('I was here @ ' . \Carbon\Carbon::now());

        $data = [ 'msg'=> 'Prueba', 'subj'=> 'Prueba', 'user_mail' => 'reb_189@hotmail.com'];

        Mail::send('emails.msg',$data, function ($msj) use ($data) {
            $msj->subject($data['subj']);
            $msj->to($data['user_mail']);
        });

    }

    public function corte(){

      //obtener la fecha actual 
      $year = date('Y');
      $month = date('m');
      $day = date('d');
      $date = $year.'-'.$month.'-'.$day;
      $meses = array("x","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
      $existe = false;
      //obtener sitios
      $sitios = DB::select('select * FROM sites');
      //obtener usuarios por sitio
      foreach ($sitios as $key => $sitio){
        //Para cada sitio 
        $id_site = $sitio->id;

        //para cada sitio obtener usuarios y pagos (solo users, no admins)
        $users = DB::select('select users.*, sites_users.status, sites_users.type FROM users JOIN sites_users ON sites_users.id_user = users.id AND sites_users.id_site = :id AND sites_users.role = 0', ['id' => $id_site]);

        foreach ($users as $key => $user){

          $fechas_pagos = DB::select('select date FROM pagos WHERE id_user = :id_user AND id_site = :id_site ORDER BY date desc', ['id_site' => $id_site, 'id_user' => $user->id]);
          $existe = false;
            if(!empty($fechas_pagos)){ //tiene pagos
              foreach ($fechas_pagos as $key => $fecha) {
                $fecha_p = explode("-", $fecha->date);
                  if(($fecha_p[0] == $year) && ($fecha_p[1] == $month)){
                    $existe=true;
                    break;
                  }//end if
              }//foreach $fechas_pagos

              if($existe){//existe y no se crea
                  //\Log::info($fecha_p[0].'='.$year.'--'.$fecha_p[1].'='.$month.'-Existe');
                  //\Log::info('sitio:'.$sitio->name.'- user:' . $user->name . '- ya existe');
              }else{//No existe y se crea

                //\Log::info($fecha_p[0].'='.$year.'--'.$fecha_p[1].'='.$month.'-Crear pago');
                //\Log::info('sitio:'. $sitio->name .'- user:' . $user->name . '- Crear pago');
                      //obtener el amount de la cuota
                      $cuota = Cuotas::find($user->type);

                        DB::table('pagos')->insert(
                          ['id_user'    => $user->id,
                           'date'       => $date,
                           'status'     => 2,
                           'amount'     => $cuota->amount,
                           'user_name'  => $user->name, //$user->name,
                           'id_site'    => $id_site //$id_site
                          ]);
                        
                        $sitio = Sites::find($id_site);
                        $concepto = $meses[intval($month)] . '-' . $year;
                        $importe = '$'.number_format($cuota->amount, 2, '.', '00');
                        $status = $status = '<span class="label" style="background-color: #00bcd4;display: inline;padding: .2em .6em .3em;font-weight: 600;line-height: 1;color: #fff;text-align: center;white-space: nowrap;vertical-align: baseline;border-radius: .25em;font-size: 14px;">Pendiente</span>';
                        $descuento = '$'.number_format(  0 , 2, '.', '00');

                        $data =['subj'      =>  'Nuevo pago pendiente - no existe', 
                                'user_mail' =>  $user->email,
                                'usuario'   =>  $user->name,
                                'site'      =>  $sitio->name,
                                'status'    =>  $status,
                                'fecha'     =>  $date,
                                'name'      =>  $user->name,
                                'address'   =>  $user->address,
                                'concepto'  =>  $concepto,
                                'cuota'     =>  $importe,
                                'descuento' =>  $descuento,
                                'importe'   =>  $importe
                                ];

                        
                        Mail::send('emails.pago_pendiente',$data, function ($msj) use ($data) {
                          $msj->subject($data['subj']);
                          $msj->to($data['user_mail']);
                        });
                        
              }
            }else{ //no tiene pagos
              \Log::info($fecha_p[0].'='.$year.'--'.$fecha_p[1].'='.$month.'- Crear pago');
              //\Log::info('sitio:'. $sitio->name .'- user:' . $user->name . '- Crear pago');

                    $cuota = Cuotas::find($user->type);

                        
                        DB::table('pagos')->insert(
                          ['id_user'    => $user->id,
                           'date'       => $date,
                           'status'     => 2,
                           'amount'     => $cuota->amount,
                           'user_name'  => $user->name, //$user->name,
                           'id_site'    => $id_site //$id_site
                          ]);
                        

                        $sitio = Sites::find($id_site);
                        $concepto = $meses[intval($month)] . '-' . $year;
                        $importe = '$'.number_format($cuota->amount, 2, '.', '00');
                        $status = $status = '<span class="label" style="background-color: #00bcd4;display: inline;padding: .2em .6em .3em;font-weight: 600;line-height: 1;color: #fff;text-align: center;white-space: nowrap;vertical-align: baseline;border-radius: .25em;font-size: 14px;">Pendiente</span>';
                        $descuento = '$'.number_format(  0 , 2, '.', '00');

                        $data =['subj'      =>  'Nuevo pago pendiente - no pagos', 
                                'user_mail' =>  $user->email,
                                'usuario'   =>  $user->name,
                                'site'      =>  $sitio->name,
                                'status'    =>  $status,
                                'fecha'     =>  $date,
                                'name'      =>  $user->name,
                                'address'   =>  $user->address,
                                'concepto'  =>  $concepto,
                                'cuota'     =>  $importe,
                                'descuento' =>  $descuento,
                                'importe'   =>  $importe
                                ];
                           
                        Mail::send('emails.pago_pendiente',$data, function ($msj) use ($data) {
                          $msj->subject($data['subj']);
                          $msj->to($data['user_mail']);
                        });
                    
            }
        } //fin foreach $user
      }//end foreach sitio
    } //fin Corte


    public function limite(){

      //obtener sitios
      $sitios = DB::select('select * FROM sites');
      //obtener usuarios por sitio
      foreach ($sitios as $sitio){
        $users = DB::select('select users.*, sites_users.status, sites_users.type FROM users JOIN sites_users ON sites_users.id_user = users.id AND sites_users.id_site = :id AND sites_users.role = 0', ['id' => $sitio->id]);
          //para cada user del sitio
          foreach ($users as $user){
            //obtener ultimo pago
            $ultimo_pago = DB::table('pagos')->where('id_user', $user->id)->where('id_site',$sitio->id)->orderBy('date', 'desc')->take(1)->get();
              if(!empty($ultimo_pago)){ //tiene pagos
                  foreach ($ultimo_pago as $pago){
                    //si es adeudo o pendiente
                    if(($pago->status == 0) or ($pago->status == 2) ){

                      //si es pendiente se cambia a adeudo
                      if($pago->status == 2){
                        DB::table('pagos')->where('id', $pago->id)->update(['status' => 0]);
                      }

                      //Actualizar el status de usuario a Adedudo
                      DB::table('sites_users')->where('id_site', $sitio->id)->where('id_user', $user->id)->update(['status' => 0]);

                      //label de Adeudo
                      $status = '<span class="label ecxlabel-danger" style="background-color: #d9534f;display: inline;padding: .2em .6em .3em;font-weight: 600;line-height: 1;color: #fff;text-align: center;white-space: nowrap;vertical-align: baseline;border-radius: .25em;font-size: 14px;">Adeudo</span>';

                      //Data del mail
                      $data =['subj'      =>  'Limite de pago', 
                              'user_mail' =>  $user->email,
                              'usuario'   =>  $user->name,
                              'sitio'      => $sitio->name,
                              'status'    =>  $status
                              ];
                      
                      //Se envia el mail
                      Mail::send('emails.limite',$data, function ($msj) use ($data) {
                        $msj->subject($data['subj']);
                        $msj->to($data['user_mail']);
                      });
                    

                    }else if($pago->status == 1){ //si status es corriente
                      //Se actualiza a corriente
                      DB::table('sites_users')->where('id_site', $sitio->id)->where('id_user', $user->id)->update(['status' => 1]);
                    }
                    
                  }
              }
          }
      }
    } //fin limite


}//end controller
