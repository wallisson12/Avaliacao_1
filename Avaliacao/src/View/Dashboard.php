<?php
use Moobi\Avaliacao\Config\Ambiente;
use Moobi\Avaliacao\Config\Session_Handler;
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DashBorad</title>
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

</body>
</html>
