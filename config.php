<?php
require_once('vendor/autoload.php');
require_once('class/User.class.php');

$loader = new Twig\Loader\FilesystemLoader("templates");
$twig = new Twig\Environment($loader);



$db = new mysqli('localhost', 'root', '', 'loginformat');

?>