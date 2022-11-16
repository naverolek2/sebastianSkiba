<?php
    require_once('class/User.class.php');
    require_once('config.php');
    $user = new User('jkowalski', 'haslo');
    /*
    if($user->register()) {
        echo "Zarejestrowano poprawnie";
    }
    else {
        echo " BŁąd";
    }
    */
    if($user->logowanie()) {
        echo "Zalogowano pomyślnie";
    }
    else {
        echo "Błędny login lub hasło";
    }
    echo '<pre>';
    var_dump($user);
?>