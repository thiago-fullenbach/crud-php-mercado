<?php
    $servidor = 'localhost';
    $user = 'root';
    $password = 'root';
    $db = 'db_mercado';

    $conn = mysqli_connect($servidor, $user, $password, $db) or
    die("Erro ao conectar com o banco de dados!!");
?>