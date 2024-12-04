<?php
require_once __DIR__ . "/../../Config/Ambiente.php";
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    <h3>Editar Usuario</h3>
</head>
<body>
<form action="<?php Ambiente::getUrl('Usuario/atualizar',true)?>?id=<?php echo $aUsuarios[0]->getId()?>" method="post">

    <div>
        <label>Nome</label>
        <input type="text" name="nome" value="<?php echo $aUsuarios[0]->getNome();?>" required>
    </div>

    <div>
        <label>Tipo</label>
        <select name="tipo">
            <option value="Administrador" <?php echo $aUsuarios[0]->getTipo_Usuario() == 'Administrador' ? 'selected' : ''; ?>>Administrador</option>
            <option value="Comum" <?php echo $aUsuarios[0]->getTipo_Usuario() == 'Comum' ? 'selected' : ''; ?>>Comum</option>
        </select>
    </div>

    <input type="submit" name="editar" value="Editar">

</form>

<a href=<?php Ambiente::getUrl('Usuario/listar',true)?>>Voltar</a>

</body>
</html>
