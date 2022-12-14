<?php

use Steampixel\Route;

require_once('class/User.class.php');
require_once('config.php');

session_start();

Route::add('/', function () {
    global $twig;
    $v = array();
    if (isset($_SESSION['auth']))
        if ($_SESSION['auth']) {
            //jesteśmy zalogowani
            $user = $_SESSION['user'];
            $v['user'] = $user;
        }
    $twig->display('home.html.twig', $v);
});

Route::add('/login', function () {

    global $twig;
    $twig->display('login.html.twig');
});
Route::add('/login', function () {
    global $twig;
    if (isset($_REQUEST['login']) && isset($_REQUEST['password'])) {
        $user = new User($_REQUEST['login'], $_REQUEST['password']);
        if ($user->logowanie()) {
            $_SESSION['auth'] = true;
            $_SESSION['user'] = $user;
            $v = array(
                'message' => "Zalogowano poprawnie użytkownika: " . $user->getName(),
            );
            $twig->display('message2.html.twig', $v);
        } else {
            $twig->display(
                'login.html.twig',
                ['message' => "Błędny login lub hasło"]
            );
        }
    } else {
        die("Nie otrzymano danych");
    }
}, 'post');

Route::add('/register', function () {
    global $twig;
    $twig->display('register.html.twig');
});
Route::add('/register', function () {
    global $twig;
    if (isset($_REQUEST['login']) && isset($_REQUEST['password'])) {
        if (
            empty($_REQUEST['login']) || empty($_REQUEST['password'])
            || empty($_REQUEST['firstName']) || empty($_REQUEST['lastName'])
        ) {
            //podano pusty string jako jedną z wymaganych wartości
            $twig->display(
                'register.html.twig',
                ['message' => "Nie podano wymaganej wartości"]
            );
            exit();
        }
        $user = new User($_REQUEST['login'], $_REQUEST['password']);
        $user->setFirstName($_REQUEST['firstName']);
        $user->setLastName($_REQUEST['lastName']);
        if ($user->register()) {
            //echo "Zarejestrowano poprawnie";
            $twig->display(
                'message.html.twig',
                ['message' => "Zarejestrowano poprawnie"]
            );
        } else {
            //echo "Błąd rejestracji użytkownika";
            $twig->display(
                'register.html.twig',
                ['message' => "Błąd rejestracji użytkownika"]
            );
        }
    } else {
        die("Nie otrzymano danych");
    }
}, 'post');

Route::add('/logout', function () {
    global $twig;
    session_destroy();
    $twig->display(
        'message.html.twig',
        ['message' => "Wylogowano poprawnie"]
    );
});

Route::add('/profile', function() {
    global $twig;
    $user = $_SESSION['user'];
    //pobieramy imię i nazwisko rozdzielone spacją
    $fullName = $user->getName();
    $fullName = explode(" ", $fullName); // "Imię nazwisko" => array ("Imię", "Nazwisko");
    $v = array( 'user'      => $user,
                'firstName' => $fullName[0],
                'lastName'  => $fullName[1],
            );
    $twig->display('profile.html.twig', $v);
});
Route::add('/profile', function() {
    global $twig;
    if(isset($_REQUEST['firstName']) && isset($_REQUEST['lastName'])) {
        $user = $_SESSION['user'];
        $user->setFirstName($_REQUEST['firstName']);
        $user->setLastName($_REQUEST['lastName']);
        $user->save();
        $twig->display('message.html.twig', 
                                ['message' => "Zapisano zmiany w profilu"]);
    }
    if(isset($_REQUEST['password']) && isset($_REQUEST['passwordRepeat'])) {
        //formularz zmiany hasła
        $password = $_REQUEST['password'];
        $passwordRepeat = $_REQUEST['passwordRepeat'];
        if($password == $passwordRepeat) {
            //hasła zgodne
            $user = $_SESSION['user'];
            if($user->changePassword($password)) {
                $twig->display('message.html.twig', 
                    ['message' => "Hasło zostało zmienione"]);
            } else {
                $twig->display('message.html.twig', 
                    ['message' => "Nastąpił błąd!"]);
            }
        } else {
            //hasła niezgodne
            $twig->display('message.html.twig', 
            ['message' => "Podane hasła nie są zgodne"]);
        }

    }

}, "post");



Route::run('/sebastianSkiba');

?>