<?php
session_start();

if(!isset($_SESSION['admin']))
{
    header('location: ../View/LoginUsuario.php');
}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Administrador DashBord</title>
    <h3>Opcoes do adm</h3>
</head>
<body>


<label>Cadastrar Usuario</label>
<input name="cadastrarUsuario" type="hidden">
<a href="/../Avaliacao/app/View/CadastroUsuario.php">Cadastrar</a>

<br>
<br>

<label>Listar Usuarios</label>
<a href="/../Avaliacao/app/View/ListaUsuarios.php">Listar</a>

<br>
<br>

<label>Cadastrar Filiado</label>
<a href="/../Avaliacao/app/View/CadatroFiliado.php">Cadastrar</a>

<br>
<br>

<label>Listar Filiados</label>
<a href="/../Avaliacao/app/View/ListaFiliados.php">Listar</a>

<br>
<br>

<input type="submit" name="logout" value="logout">



</body>
</html>
