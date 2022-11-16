<?php
    require_once('class/User.class.php');

    $user = new User('jkowalski', 'haslo');
    $user->register();
    echo '<pre>';
    var_dump($user);
?>