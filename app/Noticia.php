<?php

namespace TuFracc;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Noticia extends Model
{
    protected $table = 'noticias';
    protected $fillable = ['titulo', 'texto', 'path','id_site'];

    public function setPathAttribute($path){
		$this->attributes['path'] = 'noticia_' . time() . '.' . $path->getClientOriginalName();
    	$name = 'noticia_' . time() . '.' . $path->getClientOriginalName();
    	\Storage::disk('local')->put($name, \File::get($path));
    }
}