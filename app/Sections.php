<?php

namespace TuFracc;

use Illuminate\Database\Eloquent\Model;

class Sections extends Model
{
    protected $table = 'sections';

    public $timestamps = false;

    protected $fillable = ['is_active'];
}
