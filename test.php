<?php

use Steampixel\Route;

    require_once('class/User.class.php');
    require_once('config.php');
    
    Route::add('/', function() {
        echo "Strona główna";
    });
    
    Route::add('/login', function() {
            
        global $twig;
        $twig->display('login.html.twig');

    });

    Route::add('/register', function() {
        global $twig;
        $twig->display('register.html.twig');
    });
    
    Route::run('/user');

?>