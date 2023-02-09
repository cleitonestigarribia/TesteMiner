<?php

ob_start();
session_start();

$pdo = new PDO('mysql:host=localhost;dbname=projeto', 'root', 'root');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


if (isset($_SESSION['usuario']) && isset($_SESSION['senha'])) {

    $sql = $pdo->prepare("SELECT * FROM users WHERE login ='" . $_SESSION['usuario'] . "' AND senha = '" . $_SESSION['senha'] . "'");
    $sql->execute();

    $fetchUsers = $sql->fetchAll();

    foreach ($fetchUsers as $key => $value) {
        if ($value['type_id'] != 1) {

            header("Location: index.php");

        } 
    }

}


MARCAS