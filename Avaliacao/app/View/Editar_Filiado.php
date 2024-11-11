<?php
require_once __DIR__ . "/../../Config/MoobiDataBase.php";
require_once __DIR__ . "/../Controller/FiliadoController.php";

$filiadoController = new FiliadoController();

if(isset($_POST['editar']))
{
    //Quando editar, tenho que atualizar a data da ultima atualizacao
    $filiadoController->atualizar($_GET['id'],$_POST['empresa'],$_POST['cargo'],$_POST['situacao'],$_POST['data']);

    //Carrega a view Lista de filiados
    require_once __DIR__ . "/../View/ListaFiliados.php";
    exit();


}
else
{
    $oFiliado = $filiadoController->find($_GET['id']);
}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    <h3>Editar Filiado</h3>
</head>
<body>

<form method="post">

    <div>
        <label>Nome</label>
        <input type="text" value="<?php echo $oFiliado->getNome(); ?>" readonly>
    </div>

    <div>
        <label>CPF</label>
        <input type="text" value="<?php echo $oFiliado->getCpf(); ?>" readonly>
    </div>

    <div>
        <label>Idade</label>
        <input type="text" value="<?php echo $oFiliado->getIdade(); ?>" readonly>
    </div>

    <div>
        <label>RG</label>
        <input type="text" value="<?php echo $oFiliado->getRG(); ?>" readonly>
    </div>

    <div>
        <label>Data Nascimento</label>
        <input type="text" value="<?php echo $oFiliado->getDataNascimento(); ?>" readonly>
    </div>

    <div>
        <label>Empresa</label>
        <input type="text" name="empresa" value="<?php echo $oFiliado->getEmpresa(); ?>">
    </div>

    <div>
        <label>Cargo</label>
        <input type="text" name="cargo" value="<?php echo $oFiliado->getCargo(); ?>">
    </div>

    <div>
        <label>Situacao</label>
        <input type="text" name="situacao" value="<?php echo $oFiliado->getSituacao(); ?>">
    </div>

    <div>
        <label>Telefone Residencial</label>
        <input type="text" value="<?php echo $oFiliado->getTelefoneResidencial(); ?>" readonly>
    </div>

    <div>
        <label>Celular</label>
        <input type="text" value="<?php echo $oFiliado->getCelular(); ?>" readonly>
    </div>

    <div>
        <label>Data Ultima Atualizacao</label>
        <input type="text" name="data" value="<?php echo $oFiliado->getDataUltimaAtualizacao(); ?>" readonly>
    </div>

    <input type="submit" name="editar" value="Editar">
</form>

</body>
</html>
