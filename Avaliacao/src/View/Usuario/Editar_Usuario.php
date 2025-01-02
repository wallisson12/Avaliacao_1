<?php
use Moobi\Avaliacao\Config\Ambiente;
/** @var array $aUsuarios */
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

    <h3>Editar Usuario</h3>

    <form action="<?php Ambiente::getUrl('Usuario/atualizar',true)?>?id=<?php echo $aUsuarios[0]->getId()?>" method="post">

        <div>
            <label>Nome</label>
            <input type="text" name="nome" value="<?php echo $aUsuarios[0]->getNome();?>" required>
        </div>

        <div>
            <label>Tipo</label>
            <select name="tipo">
                <option value="Administrador" <?php echo $aUsuarios[0]->getTipoUsuario() == 'Administrador' ? 'selected' : ''; ?>>Administrador</option>
                <option value="Comum" <?php echo $aUsuarios[0]->getTipoUsuario() == 'Comum' ? 'selected' : ''; ?>>Comum</option>
            </select>
        </div>

        <input type="submit" name="editar" value="Editar">

    </form>

    <a href=<?php Ambiente::getUrl('Usuario/listar',true)?>>Voltar</a>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>
