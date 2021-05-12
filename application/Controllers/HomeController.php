<?php 
namespace App\Controllers;
use App\Models\User;

class HomeController extends Controller
{
	public function gretting ($name) {
		echo "Hola como estás {$name}";
	}
}
