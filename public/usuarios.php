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
        if ($value['type_id'] != 2) {

            header("Location: index.php");

        }
    }

}

if (isset($_POST['nome'])) {
    $sql = $pdo->prepare("INSERT INTO users VALUES (null,?,?,?,?)");
    $sql->execute(array($_POST['nome'], $_POST['type_id'], $_POST['login'], $_POST['senha']));
    echo 'Inserido';
}

?>

<form method="post">
    <div class="row">
        <div class="col-4">
            <div class="card">
                <div class="card-header">
                    Usuários
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome" placeholder="">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Login</label>
                        <input type="text" class="form-control" id="login" name="login" placeholder="">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Senha</label>
                        <input type="password" class="form-control" id="senha" name="senha" placeholder="">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tipo Usuário</label>
                        <select class="form-control" name="type_id">
                            <option value="1">Comum</option>>
                            <option value="2">Administrador</option>
                        </select>
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

<?php

$sql = $pdo->prepare("SELECT * FROM users");
$sql->execute();

$fetchUsers = $sql->fetchAll();

foreach ($fetchUsers as $key => $value) {
    echo $value['name'];
    echo '<hr>';
}

?>