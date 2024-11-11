<?php
session_start();

if(!isset($_SESSION['usuarioComum']))
{
    header('Location:../View/LoginUsuario.php');
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Usuario Comun Dashboard</title>
    <h3>Opcoes Usuario Comum</h3>
</head>
<body>

<label>Listar Filiados</label>
<a href="/../Avaliacao/app/View/ListaFiliados.php">Listar</a>

<br>
<br>

<input type="submit" name="logout" value="logout">

</body>
</html>
