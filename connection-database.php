<?php
    $server = 'localhost';
    $user = 'root';
    $password = '';
    $db_name = 'site_maqina';
    $port = '3306';

    $db_connect = mysqli_connect($server, $user, $password, $db_name, $port);
    mysqli_set_charset($db_connect, "utf8");

    // if (mysqli_connect_errno()) {
    //     die('conexão falhou:' . mysqli_connect_errno());
    // } else {
    //     echo "tudo bem";
    // }
?>
