<?php

namespace TuFracc\Http\Controllers;

use TuFracc\User;
use Illuminate\Http\Request;
use TuFracc\Http\Requests;
use Mail;
use TuFracc\Pagos;
use Session;
use Sites;
use Redirect;
use TuFracc\Http\Controllers\Controller;
use App\Jobs\SendEmail;
use DB;
use Illuminate\Contracts\Auth\Guard;

class MailController extends Controller
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
    public function store(Request $request)
    {
        /*
        Mail::send('emails.contact',$request->all(), function($msj){
            $msj->subject('Contacto');
            $msj->to('tufracc@gmail.com');
        });
        Session::flash('message','Mensaje enviado correctamente');
        return Redirect::to('/contacto');
        */
        Mail::send('emails.contact',$request->all(), function($msj){
            $msj->subject('Contacto');
            $msj->to('tufracc@gmail.com');
        });

        return response()->json([
            "message"=>'listo'
        ]);
    }

    public function contact(Request $request)
    {
        Mail::send('emails.contact',$request->all(), function($msj){
            $msj->subject('Contacto');
            $msj->to('tufracc@gmail.com');
        });

        return response()->json([
            "message"=>'listo'
        ]);
    }


    public function sendEmail(Request $request,$id,$tipo)
    {
        $user = User::findOrFail($id);
        $admin = User::findOrFail($this->auth->user()->id);
        $status='';
        $saldo_vencido=0;
        $id_site = \Session::get('id_site');
        $id_user = $user->id;

        if($tipo=='corte'){

            $year = array(2013,2014,2015,2016);
            $month = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
            $year_c = date('Y');
            $mes = date('n');
            $day = date('j');

            $d_corte = 15;
            $m_corte = 0;
            $y_corte = 0;
            $d_vence = 21;
            $status = 1;
            $pago_hasta_mes = '';
            $pago_hasta = '';
            $pago_monto = 0;
            $ultimo_pago = '';

            if($day>15){
                if($mes == 12){
                    $m_corte=0;
                    $y_corte = $year_c+1;
                }else{
                    $m_corte=$mes;
                    $y_corte = $year_c;
                }
            }else{
                $m_corte=$mes-1;
                $y_corte = $year_c;
            }

            if($user->status == 0){
                $status = '<span class="label ecxlabel-danger" style="background-color: #d9534f;display: inline;padding: .2em .6em .3em;font-weight: 600;line-height: 1;color: #fff;text-align: center;white-space: nowrap;vertical-align: baseline;border-radius: .25em;font-size: 14px;">Adeudo</span>';
            }else{
                $status = '<span class="label ecxlabel-danger" style="background-color: #5cb85c;display: inline;padding: .2em .6em .3em;font-weight: 600;line-height: 1;color: #fff;text-align: center;white-space: nowrap;vertical-align: baseline;border-radius: .25em;font-size: 14px;">Saldado</span>';
            }

             $ultimo_p = DB::table('pagos')->where('id_user', $user->id)->where('status', 1)->where('id_site', $id_site)->orderBy('date', 'dsc')->get();

            foreach($ultimo_p as $pa){
                $pago_hasta = $pa->date; 
                $pago_monto = $pa->amount; 
                $pago_hasta_mes = explode("-", $pago_hasta); 
                break; 
            }

            if($pago_hasta_mes == ''){
                $pagado_hasta = '<p>No disponible</p>';
                $ultimo_pago = '<p>No disponible</p>';
            }else{ 
                $pagado_hasta = $month[$pago_hasta_mes[1]-1] . ' ' . $pago_hasta_mes[0];
                $ultimo_pago = $pago_hasta_mes[2] . "-" . $month[$pago_hasta_mes[1]-1] . "-" . $pago_hasta_mes[0];
            }

            $fecha_corte = $d_corte."-".$month[$m_corte]."-".$y_corte;
            $fecha_limite = $d_vence."-".$month[$m_corte]."-".$y_corte;
            $pagos = DB::table('pagos')->where('id_user', $id_user)->where('id_site', $id_site)->get();

            foreach($pagos as $pago){
                if($pago->status == 0){
                    $saldo_vencido += $pago->amount;
                }
            }
            $saldo_vencido = '$ '. number_format($saldo_vencido, 2);

            $data = ['username'      => $user->name,
                     'user_mail'     => $user->email,
                     'status'        => $status,
                     'pagado_hasta'  => $pagado_hasta,
                     'ultimo_pago'   => $ultimo_pago,
                     'fecha_corte'   => $fecha_corte,
                     'fecha_limite'  => $fecha_limite,
                     'saldo_vencido' => $saldo_vencido
                    ];

            Mail::send('emails.corte', $data, function ($msj) use ($data) {
                $msj->subject('Factura al Corte');
                $msj->to($data['user_mail']);
            });
            
            return response()->json([
                "message"=>'listo'
            ]);

        }else if($tipo=='adeudo'){

            $pagos = Pagos::where('id_user', $id)->where('id_site', $id_site)->where('status', 0)->orderBy('date', 'asc')->get();
            $debe='';
            $month = array("x","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
            foreach ($pagos as $key => $pago) {
                $fecha = explode("-", $pago->date); 
                $debe = $debe . '<strong style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;font-weight: 700;">'
                . '•' . $month[intval($fecha[1])] . ' ' . $fecha[0] . '</strong><br style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">';
            }

                $data = ['username'   => $user->name,
                        'user_mail'   => $user->email,
                        'debe'        => $debe
                ];

            if($pagos->count() > 0){
                Mail::send('emails.adeudo', $data, function ($msj) use ($data) {
                    $msj->subject('Recordatorio de Pago');
                    $msj->to($data['user_mail']);
                });
            }

            return response()->json([
                "message"=>'listo'
            ]);

        }else if($tipo=='invitacion'){ 

            $sitio = Sites::where('id', $id_site)->get();
            $password = substr( md5(microtime()), 1, 6);

            $data = ['username'     => $user->name,
                     'user_email'   => $user->email,
                     'sitio'        => $sitio->name,
                     'admin_email'  => $admin->email,
                     'password'     => $password
                ];

            Mail::send('emails.invitacion', $data, function ($msj) use ($data) {
                $msj->subject('invitación Bill Box');
                $msj->to($data['user_mail']);
            });

            return response()->json([
                "message"=>'listo'
            ]);

        }


    }

    public function sendEmailMsg(Request $request,$id)
    {
        $user = User::findOrFail($id);

        $data = [ 'msg'=> $request->input('msg'), 'subj'=> $request->input('subj'), 'user_mail' => $user->email];

/*
        Mail::later(5, 'emails.msg', $data , function ($msj) use ($user) {
            $msj->subject('Email');
            $msj->to($user->email);
        });

        Mail::queue('emails.welcome', $data, function ($message) {
            //
        });
*/
        Mail::send('emails.msg',$data, function ($msj) use ($data) {
            $msj->subject($data['subj']);
            $msj->to($data['user_mail']);
        });

        return response()->json([
            "message"=>'listo'
        ]);
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
        //
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
