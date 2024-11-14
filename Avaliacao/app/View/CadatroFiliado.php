<?php
require_once __DIR__ . "/../../Config/MoobiDataBase.php";
require_once __DIR__ . "/../Controller/FiliadoController.php";

$filiadoController = new FiliadoController();

if(isset($_POST["cadastrar"]))
{
    if(empty($_POST['empresa']) && empty($_POST['cargo']) && empty($_POST['situacao']))
    {
            $_POST['empresa'] = null;
            $_POST['cargo'] = null;
            $_POST['situacao'] = null;
    }

    $filiadoController->cadastrar(
            $_POST['nome'],
            $_POST['cpf'],
            $_POST['rg'],
            $_POST['data_nascimento'],
            $_POST['empresa'],
            $_POST['cargo'],
            $_POST['situacao'],
            $_POST['telefone'],
            $_POST['celular']);
}

?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastro De Filiado</title>
    <h3>Cadastro De Filiado</h3>
</head>
<body>

<form method="post">

    <div>
        <label>Nome</label>
        <input type="text" name="nome" required>
    </div>

    <div>
        <label>CPF</label>
        <input type="text" name="cpf" required>
    </div>

    <div>
        <label>RG</label>
        <input type="text" name="rg" required>
    </div>

    <div>
        <label>Data Nascimento</label>
        <input type="text" name="data_nascimento" required>
    </div>

    <div>
        <label>Empresa</label>
        <input type="text" name="empresa">
    </div>

    <div>
        <label>Cargo</label>
        <input type="text" name="cargo">
    </div>

    <div>
        <label>Situacao</label>
        <input type="text" name="situacao">
    </div>

    <div>
        <label>Telefone Residencial</label>
        <input type="text" name="telefone" required>
    </div>

    <div>
        <label>Celular</label>
        <input type="text" name="celular" required>
    </div>

        <input type="submit" name="cadastrar" value="Cadastrar">
</form>



</body>
</html>
