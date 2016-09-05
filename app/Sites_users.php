<?php

namespace TuFracc;

use Illuminate\Database\Eloquent\Model;

class sites_users extends Model
{
    protected $table = 'sites_users';

    //public $timestamps = false;

    protected $fillable = ['id_site', 'id_user','field1', 'field2','role', 'type','status'];

}
