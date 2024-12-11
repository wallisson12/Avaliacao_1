<?php
require_once __DIR__ . "/../../Config/Ambiente.php";
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Responsavel por fazer o login</title>
</head>
<body>

<h3>Tela para realizar o login</h3>

<form action="<?php Ambiente::getUrl('Login/logar',true)?>" method="post">

    <label>Nome: </label>
    <input type="text" name="nome" id="nome" required>

    <label>Senha: </label>
    <input type="password" name="senha" id="senha" minlength="6" required>

    <input type="submit" name="login" value="Login">

</form>

</body>
</html>
