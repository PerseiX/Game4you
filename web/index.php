<?php
	require '../src/Autoloader.php';
	Twig_Autoloader::register();
	$loader = new Twig_Loader_Filesystem('../templates/views');
	$twig = new Twig_Environment($loader, array(
		'cache' => null  ));
	echo $twig->render('index.html.twig', $loginStatus);
