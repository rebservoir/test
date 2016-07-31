<?php

namespace TuFracc;

use Illuminate\Database\Eloquent\Model;

class Paypal_credentials extends Model
{
    protected $table = 'paypal_credentials';

     public $timestamps = false;

    protected $fillable = ['id_site','client_id','secret'];

}
