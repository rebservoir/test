<?php

namespace TuFracc\Http\Controllers;

class PruebaController extends Controller{

	public function index(){
		return "Hola desde controller";
	}

	public function nombre($nombre){
		return "Hola mi nombre es: ".$nombre;
	}

}