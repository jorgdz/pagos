<?php
  require_once __DIR__.'/../vendor/autoload.php';
	$dotenv = Dotenv\Dotenv::createImmutable('../');
	$dotenv->load();

  require_once __DIR__.'/../config/db.php';
	
	use App\Render\Route;

  if ($_SERVER['REQUEST_METHOD'] == 'GET')
  {
		Route::add('/', function () {
			echo 'Hola Jorge ';
		});
  }
