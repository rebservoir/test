<?php

namespace TuFracc\Http\Middleware;
use Illuminate\Contracts\Auth\Guard;
use Closure;
use Session;
use TuFracc\Sites_users;

class Admin
{
    protected $auth;

    public function __construct(Guard $auth){
        $this->auth = $auth;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $id_site = \Session::get('id_site');
        $id_user = $this->auth->user()->id;
        $user_role = Sites_users::where('id_site',$id_site)->where('id_user',$id_user)->value('role');

        if($user_role != 1){
            return redirect()->to('home');
        }

        return $next($request);
    }
}
