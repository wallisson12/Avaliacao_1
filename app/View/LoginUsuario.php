<?php
require_once __DIR__ . "/../../Config/autoLoad.php";

$usuarioController = new UsuarioController();

//Modificar para nao pegar o Post e o Get diretamente
if (isset($_POST['login']))
{
    $usuarioController->findUsuarioAdm($_POST['nome'], $_POST['senha']);
}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Responsavel por fazer o login</title>
    <h3>Tela para realizar o login</h3>
</head>
<body>

<form method="post">
    <label>Nome: </label>
    <input type="text" name="nome" id="nome" required>

    <label>Senha: </label>
    <input type="password" name="senha" id="senha" required>

    <input type="submit" name="login" value="Login">
</form>

</body>
</html>
