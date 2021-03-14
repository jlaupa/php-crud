<?php
require_once 'config/Connection.php';
require_once 'Models/User.php';
require_once 'Models/Login.php';
$path = '/prueba_yellducal';

$user = new User();
$login = new Login();
$login->session();

?>
<!doctype html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Prueba</title>
    <link rel="stylesheet" href="<?=$path?>/assets/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
<header>
    <nav class="nav-extended teal lighten-2">
        <div class="nav-wrapper ">
            <a href="<?=$path?>/views/users" class="brand-logo center ">Prueba</a>
            <ul id="slide-out" class="side-nav">
                <li><a href="<?=$path?>/views/users"><i class="material-icons dp48">contacts</i>Users</a></li>
            </ul>

            <ul class="right">
                <li>
                    <a class="btn btn-floating pulse teal darken-4" id="menu" href="#" data-activates="slide-out" ><i class="material-icons">menu</i></a>
                </li>
            </ul>
            <ul class="right teal darken-4">
                <li>
                    <?php
                    if (isset($user->auth()->username)) {
                        echo '<a href="#">'.$user->auth()->username.'</a>';
                    } else {
                    ?>
                        <a href="<?=$path?>/views/login.php">Login</a >
                    <?php
                    }
                    ?>
                </li>
                <li>
                    <a href="<?=$path?>/views/logout.php"> Logout </a>
                </li>
            </ul>
        </div>
    </nav>
</header>