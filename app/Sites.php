<?php

namespace TuFracc;

use Illuminate\Database\Eloquent\Model;

class Sites extends Model
{
    protected $table = 'sites';

    public $timestamps = false;

    protected $fillable = ['name', 'path', 'plan', 'finanzas_active', 'morosos_active'];


}
