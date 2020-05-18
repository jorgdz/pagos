<?php
namespace App\Render;

use App\Exceptions\RouteNotFoundException;

class Route
{

	private static $preg_params_init = '/{([^\/]+)}/';
	private static $preg_params = '(?<\1>[^/]+)';

	/**
	*
	* Constructor with out instance
	*
	*/
	private function __construct(){}
	
	/**
	*
	* @return uri
	* Get complete url
	*/
	public static function getUri () 
	{
		$uri = $_SERVER['REQUEST_URI'];
		if (strpos($uri, '?')) 
		{
			$uri = strstr($uri, '?', true);
		}
		
		if (strpos($uri, 'pagos/public_html/')) 
		{
			$uri = str_replace('pagos/public_html/', '', $uri);
		}
		
		return $uri;
	}


	/**
	*
	* @return params names
	* Get params
	*/
	private static function pregMathAll ($route) 
	{
		preg_match_all(static::$preg_params_init, $route, $names_params);
		return $names_params;
	}

	public static function add ($route, $controller)
	{
		$urlRule = preg_replace(static::$preg_params_init, static::$preg_params, $route);
		$urlRule = str_replace('/', '\/', $urlRule);

		if (preg_match('/^' . $urlRule . '\/*$/s', self::getUri(), $matches)) 
		{
			$args = array_intersect_key($matches, array_flip(static::pregMathAll($route)[1]));

			$closure = $controller;

			if (is_string($controller))
			{
				if (strpos($controller, '@')) 
				{
					$controller = str_replace('@', '::', $controller);
				}
				
				$classController = explode("::", $controller);
				$closure = 'App\\Controllers\\'.$classController[0];
				$closure = new $closure;
			
				return call_user_func_array(array($closure, $classController[1]), $args);
			}
			else
			{
				return call_user_func_array($closure, $args);
			}
		}
	}

}
