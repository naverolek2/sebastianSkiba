<?php
require_once('config.php');

$v = array(
    'testVariable' => "Wartość testowa",
);
$twig->display('test.html.twig', $v);


?>