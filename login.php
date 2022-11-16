<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie</title>
</head>
<body>
    <form action="" method="post">
        <label for="login">Login:</label>
        <input type="text" name="login" id="loginID"><br>
        <label for="login">Hasło:</label>
        <input type="text" name="haslo" id="hasloID">
        <input type="submit" value="Zaloguj">
    </form>
    <?php
    if(isset($_REQUEST['login']) && isset($_REQUEST['password'])) {
        require_once('config.php');
        require_once('class/User.class.php');
       
        $user = new User($_REQUEST['login'], $_REQUEST['password']);
        if($user->logowanie()) {
            echo "Zalogowano uzytkownika: " . $user->getName();
        }
        else {
            echo "Nie zalogowano";
        }
    }
    ?>
</body>
</html>