<?php
use Moobi\Avaliacao\Config\Ambiente;
use Moobi\Avaliacao\Config\Mensagem;
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastro De Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>
