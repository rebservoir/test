<?php

namespace TuFracc;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Egresos extends Model
{
	protected $table = 'egresos';

    protected $fillable = ['concept','path','date','amount','id_site'];

    public function setPathAttribute($path){
		$this->attributes['path'] = 'egresos_' . time() . '.' . $path->getClientOriginalName();
    	$name = 'egresos_' . time() . '.' . $path->getClientOriginalName();
    	//$name = Carbon::now()->second.$path->getClientOriginalName();
    	\Storage::disk('local')->put($name, \File::get($path));
    }

    

}
