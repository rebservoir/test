<?php

namespace TuFracc;

use Illuminate\Database\Eloquent\Model;

class Plans extends Model
{
    protected $table = 'plans';

    public $timestamps = false;

    protected $fillable = ['name', 'price', 'user_limit','id_site'];

}
