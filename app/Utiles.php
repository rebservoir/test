<?php

namespace TuFracc;

use Illuminate\Database\Eloquent\Model;

class Utiles extends Model
{
    protected $table = "utiles";

    public $timestamps = false;

    protected $fillable = ['concept','phone_num','address','url','category','id_site'];
}
