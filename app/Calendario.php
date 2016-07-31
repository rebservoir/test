<?php

namespace TuFracc;

use Illuminate\Database\Eloquent\Model;

class Calendario extends Model
{
    protected $table = "calendario";

    public $timestamps = false;

    protected $fillable = ['title','start','end','id_site'];
}
