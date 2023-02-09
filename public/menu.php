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
        if ($value['type_id'] == 1) {

            echo '<a href="produtos.php>Produtos</a>';
            echo '<hr>';
            echo '<a href="categorias.php>Categorias</a>';
            echo '<hr>';
            echo '<a href="marcas.php>Marcas</a>';
            echo '<hr>';

        } else if ($value['type_id'] == 2) {

            echo '<a href="usuarios.php>Usuários</a>';
            echo '<hr>';
            echo '<a href="permissoes.php>Permissões</a>';
            echo '<hr>';
           
        }
    }

}