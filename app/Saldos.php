<?php

namespace TuFracc;

use Illuminate\Database\Eloquent\Model;

class Saldos extends Model
{
    protected $table = 'saldos';

    protected $fillable = ['id_sitio', 'saldo', 'date'];
}
