<?php

namespace TuFracc;

use Illuminate\Database\Eloquent\Model;

class Cuotas extends Model
{
    protected $table = "cuotas";

    public $timestamps = false;

    protected $fillable = ['concepto','amount','id_site'];
}
