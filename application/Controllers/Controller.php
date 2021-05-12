<?php 
namespace App\Controllers;

use App\Render\Render;

abstract class Controller
{
	
	public function view ($view, $params = [])
	{
		Render::view($view, $params);
	}
	
	public function redirect ($view, $resp = [])
	{
		Render::redirect($view, $resp);
	}

}
