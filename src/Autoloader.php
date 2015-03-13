<?php
require '../vendor/autoload.php';
require '../src/Controller.php';

if(!isset($_SESSION['logged'])){
    $_SESSION['logged'] = false;
    $_SESSION['login'] = null;
    $_SESSION['id'] = null;
    $_SESSION['email'] = null;
}

$loginStatus = array('logged' => $_SESSION['logged'],
    'id' => $_SESSION['id'],
    'login' => $_SESSION['login'],
    'email' => $_SESSION['email'],
);
