<?php
session_start();
require '../src/UserControler.php';

$controllers = array(
	'user' => 'UserController',
	'game' => 'GameController',
	'product' => 'ProductController',
);

if(isset($_GET['module']) && isset($_GET['action'])){
		$controllerName = $_GET['module'];
		$controllerClass = array_key_exists($controllerName, $controllers) ? $controllerName : null;
		
	if($controllerClass == true){
		$controllerName = $controllers[$controllerName];
		$controller = new $controllerName();
		$action = $_GET['action'].'Action';
	}

	else{
		echo "nie istnieje taki kontroler";
	}


	if(method_exists($controller, $action))
	{
		$controller->$action($_POST);
	}
	else{
		echo " nie ma takiej akcji";
	}
}
//echo call_user_func_array(array($controller, $action), array($_GET, $_POST));

