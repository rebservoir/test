<?php

namespace TuFracc;

use Illuminate\Database\Eloquent\Model;

class Documentos extends Model
{
    protected $table = "documentos";

    public $timestamps = false;

    protected $fillable = ['titulo','path','id_site'];

    public function setPathAttribute($path){
		$this->attributes['path'] = 'doc_' . time() . '.' . $path->getClientOriginalName();
    	$name = 'doc_' . time() . '.' . $path->getClientOriginalName();
    	//$name = Carbon::now()->second.$path->getClientOriginalName();
    	\Storage::disk('local')->put($name, \File::get($path));
    }
}
