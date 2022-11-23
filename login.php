<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie</title>
</head>
<body>
    
    <?php
    require_once('config.php');
    if(isset($_REQUEST['login']) && isset($_REQUEST['password'])) {
        
        $user = new User($_REQUEST['login'], $_REQUEST['password']);
        if($user->logowanie()) {
            $twig->display('message.html.twig', ['message' =>"Zalogowano uzytkownika: " . $user->getName()]);
        }
        else {
            //echo "Nie zalogowano";
            $twig->display('message.html.twig', ['message' => "błędny login lub hasło"]);
        }
    }
    else{
        $twig->display('login.html.twig');
    }
    ?>
</body>
</html>