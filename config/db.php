<?php 

use Illuminate\Database\Capsule\Manager;

$manager = new Manager;

$manager->addConnection([
	'driver' => getenv('DRIVER'),
	'host'	=>  getenv('HOST'),
	'username' => getenv('DB_USER'),
	'password' => getenv('DB_PASSWORD'),
	'database' => getenv('DATABASE'),
	'port'	=> getenv('PORT'),
	'charset'	=> 'utf8mb4',
  'prefix'	=> '',
  'collation' => 'utf8mb4_unicode_ci',
]);

$manager->bootEloquent();
