<?php
namespace App\Render;

class Render
{

	/**
	*
	* Constructor with out instance
	*
	*/
	private function __construct(){}
	
	public static function view ($view, $params = [])
	{
		$origin = __DIR__."/../../resources/views/".$view.".php";
		if (!empty($view) && file_exists($origin)) 
		{
			if (count($params) > 0 && !empty($params) && isset($params) && $params != null) 
			{
				foreach ($params as $key => $value) 
				{
					$$key = $value;
				}
			}
			require_once $origin;
		}
		else
		{
			require_once __DIR__.'/../../resources/views/error/error.php';	
		}
	}

	public static function redirect ($route, $response = [])
	{
		if (isset($response) && $response != null && $response != '' && !empty($response)) 
		{
			foreach ($response as $key => $value) 
			{
				$_SESSION[$key] = $value;
			}
		}

		if ($route == '' || $route == '/')
			header('location:'.URL);	
		else
			header('location:'.URL.$route);
		
		exit();
	}

}