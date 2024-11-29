<?php
require_once __DIR__ . "/../../Config/Session_Handler.php";
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DashBorad</title>
    <h3>Usuario: <?php echo Session_Handler::obterSessao('usuario')?></h3>
    <h3>Tipo: <?php echo Session_Handler::obterSessao('tipo')?></h3>
</head>
<body>


<?php if(Session_Handler::obterSessao('tipo') === 'Administrador'): ?>

    <label>Cadastrar Usuario</label>
    <input name="cadastrarUsuario" type="hidden">
    <a  href="http://localhost:5000/Avaliacao/Usuario/indexCadastrar">Cadastrar</a>
<?php else: ?>
    <span class="hidden">Cadastrar Usuario</span>
<?php endif;?>

<br>
<br>

    <label>Listar Usuarios</label>
    <a href="http://localhost:5000/Avaliacao/Usuario/listar">Listar</a>

<br>
<br>

<?php if(Session_Handler::obterSessao('tipo') === 'Administrador'): ?>
    <label>Cadastrar Filiado</label>
    <a href="http://localhost:5000/Avaliacao/Filiado/indexCadastrar">Cadastrar</a>
<?php else: ?>
    <span class="hidden">Cadastrar Filiado</span>
<?php endif;?>


<br>
<br>

<label>Listar Filiados</label>
<a href="http://localhost:5000/Avaliacao/Filiado/listar">Listar</a>

<br>
<br>


<a href="http://localhost:5000/Avaliacao/Usuario/logout">Logout</a>


</body>
</html>
