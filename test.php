<?php

use Steampixel\Route;

    require_once('class/User.class.php');
    require_once('config.php');
    
    Route::add('/', function() {
        echo "Strona główna";
    });
    
    Route::add('/login', function() {
        echo "Strona logowania";
    });

    Route::add('/register', function() {
        echo "Strona rejestracji";
    });
    
    Route::run('/user');

?>