<?php
require_once __DIR__ . '/../../Config/autoLoad.php';

$oFiliadosController = new FiliadoController();

$oListaFiliados = $oFiliadosController->findAllFiliados();

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lista De Filiados</title>
    <h3>Lista De Filiados</h3>
</head>
<body>

<section>
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>CPF</th>
                <th>Idade</th>
                <th>RG</th>
                <th>Data Nascimento</th>
                <th>Empresa</th>
                <th>Cargo</th>
                <th>Situacao</th>
                <th>Telefone Residencial</th>
                <th>Celular</th>
                <th>Data Ultima Atualizacao</th>
            </tr>
        </thead>

        <tbody>
         <?php foreach ($oListaFiliados as $oFiliado) : ?>

            <tr>
                <td><?php echo $oFiliado->getNome()?></td>
                <td><?php echo $oFiliado->getCPF()?></td>
                <td><?php echo $oFiliado->getIdade()?></td>
                <td><?php echo $oFiliado->getRG()?></td>
                <td><?php echo $oFiliado->getDataNascimento()?></td>
                <td><?php echo $oFiliado->getEmpresa()?></td>
                <td><?php echo $oFiliado->getCargo()?></td>
                <td><?php echo $oFiliado->getSituacao()?></td>
                <td><?php echo $oFiliado->getTelefoneResidencial()?></td>
                <td><?php echo $oFiliado->getCelular()?></td>
                <td><?php echo $oFiliado->getDataUltimaAtualizacao()?></td>
                <td><a href="/../Avaliacao/app/View/Editar_Filiado.php?id=<?php echo $oFiliado->getId()?>">Editar</td>
                <td>
                    <form action="excluirFiliado.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $oFiliado->getId()?>">
                        <input type="submit" value="Excluir">
                    </form>
                </td>
            </tr>

        <?php endforeach; ?>
        </tbody>

        <tbody>

        </tbody>
    </table>
</section>



</body>
</html>
