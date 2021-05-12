<?php

	use App\Render\Route;
	use App\Exceptions\RouteNotFoundException;
	use App\Controllers\Auth\AuthController;
	use App\Controllers\HomeController;

	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
		Route::add('/gretting/{name}', HomeController::class, 'gretting');
		
		Route::add('/gretting/{name}/{lastname}', function ($name, $lastname) {
			echo "Hola {$name} {$lastname}";
		});
		
		Route::add('/login', AuthController::class, 'index');

		Route::add('/cifrar/{pass}', function ($pass) {
			$opts = [
				'cost' => 12,
			];
	
			echo password_hash($pass, PASSWORD_BCRYPT, $opts)."\n";
		});
  }
