<?php
require_once __DIR__ . "/../../Config/Ambiente.php";
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
</head>

<body>

    <h3>Tela Padrao do sistema</h3>
    <h1>Bem-vindo ao Sindicato dos Estágios</h1>
    <a href=<?php Ambiente::getUrl('LoginUsuario/index',true)?>>Login</a>

</body>
</html>
