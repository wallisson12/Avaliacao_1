<?php
use Moobi\Avaliacao\Config\Ambiente;
use Moobi\Avaliacao\Config\Mensagem;
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastro De Usuario</title>
</head>
<body>

<h3>Pagina para cadastrar usuario</h3>


<form action="<?php Ambiente::getUrl('Usuario/cadastrar',true)?>" method="post">

    <div><?php echo Mensagem::getMensagem()?></div>

    <div>
        <label>Nome</label>
        <input type="text" name="nome" required>
    </div>

    <div>
        <label>Senha</label>
        <input type="password" name="senha" required>
    </div>

    <div>
        <label>Tipo</label>
        <select name="tipo">
            <option value="Administrador">Administrador</option>
            <option value="Comum">Comum</option>
        </select>
    </div>

    <input type="submit" name="cadastrar" value="Cadastrar">

</form>
<a href=<?php Ambiente::getUrl('Usuario/indexDashborad',true) ?>>Voltar</a>

</body>
</html>
