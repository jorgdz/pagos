<?php
namespace App\Render;

use App\Exceptions\RouteNotFoundException;

class Route
{

	private static $preg_params_init = '/{([^\/]+)}/';
	private static $preg_params = '(?<\1>[^/]+)';
	private static $array_routes = [];

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
	public static function getUri () {
		$uri = $_SERVER['REQUEST_URI'];

		if (strpos($uri, '?')) {
			$uri = strstr($uri, '?', true);
		}
		
		if (strpos($uri, getenv('APP_URI'))) {
			$uri = str_replace(getenv('APP_URI'), '', $uri);
		}
		
		return $uri;
	}

	/**
	*
	* @return params names
	* Get params
	*/
	private static function pregMathAll ($route) {
		preg_match_all(static::$preg_params_init, $route, $names_params);
		return $names_params;
	}

	/**
	 * 
	 * @return route adding
	 */
	public static function add ($route, $controller, $method = null) {
		$urlRule = preg_replace(static::$preg_params_init, static::$preg_params, $route);
		$urlRule = str_replace('/', '\/', $urlRule);
		array_push(self::$array_routes, $route);

		if (preg_match('/^' . $urlRule . '\/*$/s', self::getUri(), $matches)) {
			$args = array_intersect_key($matches, array_flip(static::pregMathAll($route)[1]));

			$closure = $controller;

			if (is_string($controller) && isset($method) && !empty($method)) 
			{
				$closure = new $controller;
				return call_user_func_array(array($closure, $method), $args);
			}
			else 
			{
				return call_user_func_array($closure, $args);
			}
		}
	}

	/**
	 * 
	 * @return all routes
	 */
	public static function getRoutes () {
		return self::$array_routes;
	}

	/**
	 * 
	 * Verify route if exist
	 */
	public static function verifyRouteExist () {
		$uri = self::getUri();
		$existUri = null;

		foreach(self::getRoutes() as $route) {
			$urlRule = preg_replace(static::$preg_params_init, static::$preg_params, $route);
			$urlRule = str_replace('/', '\/', $urlRule);

			if (preg_match('/^' . $urlRule . '\/*$/s', $uri, $matches)) {
				$existUri = $uri;
			}
		}

		if ($uri != $existUri) throw new RouteNotFoundException('Not found.', 404);
	}
}
