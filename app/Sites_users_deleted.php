<?php

namespace TuFracc;

use Illuminate\Database\Eloquent\Model;

class sites_users_deleted extends Model
{
    protected $table = 'sites_users_deleted';

    //public $timestamps = false;

    protected $fillable = ['id_site', 'id_user'];

}
