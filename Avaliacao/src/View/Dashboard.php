<?php
use Moobi\Avaliacao\Config\Ambiente;
use Moobi\Avaliacao\Config\Session_Handler;
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DashBorad</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

    <h3>Usuario: <?php echo Session_Handler::obterSessao('usuario')?></h3>
    <h3>Tipo: <?php echo Session_Handler::obterSessao('tipo')?></h3>


    <?php if(Session_Handler::obterSessao('tipo') === 'Administrador') { ?>

        <label>Cadastrar Usuario</label>
        <input name="cadastrarUsuario" type="hidden">
        <a  href=<?php Ambiente::getUrl('Usuario/indexCadastrar',true)?>>Cadastrar</a>
    <?php }else { ?>
        <span class="hidden">Cadastrar Usuario</span>
    <?php } ?>

    <br>
    <br>

        <label>Listar Usuarios</label>
        <a href=<?php Ambiente::getUrl('Usuario/listar',true)?>>Listar</a>

    <br>
    <br>

    <?php if(Session_Handler::obterSessao('tipo') === 'Administrador') { ?>
        <label>Cadastrar Filiado</label>
        <a href=<?php Ambiente::getUrl('Filiado/indexCadastrar',true) ?>>Cadastrar</a>
    <?php }else { ?>
        <span class="hidden">Cadastrar Filiado</span>
    <?php } ?>

    <br>
    <br>

    <label>Listar Filiados</label>
    <a href=<?php Ambiente::getUrl('Filiado/listar',true)?>>Listar</a>

    <br>
    <br>

    <a href=<?php Ambiente::getUrl('Usuario/logout',true)?>>Logout</a>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>
