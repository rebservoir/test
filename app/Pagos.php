<?php

namespace TuFracc;

use Illuminate\Database\Eloquent\Model;

class Pagos extends Model
{
    protected $table = 'pagos';

    public $timestamps = true;

    protected $fillable = ['id_user','date','status','amount','retardo','fecha_pago','user_name','id_site'];

}
