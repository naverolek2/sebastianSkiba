<?php
    require_once('class/User.class.php');

    $user = new User('jkowalski', 'haslo');
    echo '<pre>';
    var_dump($user);
?>