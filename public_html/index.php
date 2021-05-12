<?php

	use App\Exceptions\RouteNotFoundException;
	use App\Render\Route;

  require_once __DIR__.'/../vendor/autoload.php';
	$dotenv = Dotenv\Dotenv::createImmutable('../');
	$dotenv->load();

  require_once __DIR__.'/../config/db.php';
  require_once __DIR__.'/../routes/routes.php';

	Route::verifyRouteExist();
