<?php
ob_start();
session_start();

$pdo = new PDO('mysql:host=localhost;dbname=projeto', 'root', 'root');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (isset($_POST['usuario']) && isset($_POST['senha'])) {

    $sql = $pdo->prepare("SELECT * FROM users WHERE login ='" . $_POST['usuario'] . "' AND senha = '" . $_POST['senha'] . "'");
    $sql->execute();

    $fetchUsers = $sql->fetchAll();

    foreach ($fetchUsers as $key => $value) {
        if ($value['type_id'] == 1) {

            $_SESSION['usuario'] = $value['usuario'];
            $_SESSION['senha'] = $value['senha'];

            header("Location: menu.php");

        } else if ($value['type_id'] == 2) {

            $_SESSION['usuario'] = $value['usuario'];
            $_SESSION['senha'] = $value['senha'];

            header("Location: menu.php");
        }
    }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Teste</title>
</head>

<body>
    <form method="post" action="menu.php">
        <div class="row">
            <div class="col-4">
                <div class="card">
                    <div class="card-header">
                        LOGIN
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Usuário</label>
                            <input type="text" class="form-control" id="usuario" name="usuario" placeholder="">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Senha</label>
                            <input type="password" class="form-control" id="senha" name="senha" placeholder="">
                        </div>
                        <div class="mb-3">
                            <input type="submit" class="btn btn-danger" value="Cancelar">
                            <input type="submit" class="btn btn-success" value="Logar">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
</body>

</html>