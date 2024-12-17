<?php
use Moobi\Avaliacao\Config\Ambiente;
use Moobi\Avaliacao\Config\Mensagem;
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

    <div><?php echo Mensagem::getMensagem()?></div>

    <label>Nome: </label>
    <input type="text" name="nome" id="nome" required>

    <label>Senha: </label>
    <input type="password" name="senha" id="senha" required>

    <input type="submit" name="login" value="Login">

</form>

</body>
</html>
