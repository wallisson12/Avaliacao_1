<?php
require_once __DIR__ . "/../../Config/Ambiente.php";
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastro De Usuario</title>
    <h3>Pagina para cadastrar usuario</h3>
</head>
<body>


<form action="<?php Ambiente::getUrl('Usuario/cadastrar',true)?>" method="post">

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
