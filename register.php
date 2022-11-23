<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejestrowanie</title>
</head>
<body>

    <?php
    require_once('config.php');
    if(isset($_REQUEST['login']) && isset($_REQUEST['password'])) {
        
        $user = new User($_REQUEST['login'], $_REQUEST['password']);
        $user->setFirstName($_REQUEST['firstName']);
        $user->setLastName($_REQUEST['lastName']);
        if($user->register()) {
            $twig->display('message.html.twig', ['message' =>"Zarejestrowano poprawnie"]) ;
        } else {
            $twig->display('message.html.twig', ['message' => "Błąd rejestracji użytkownika"]) ;
        }
    }
    else {
        $twig->display('register.html.twig');
    }
    ?>
</body>
</html>