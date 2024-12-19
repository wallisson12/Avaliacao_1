<?php
use Moobi\Avaliacao\Config\Ambiente;
use Moobi\Avaliacao\Config\Mensagem;
use Moobi\Avaliacao\Config\Session_Handler;

/**
 *  @var array $loDependentes
 *  @var int $iIdFiliado
 */
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lista Dependentes</title>
</head>
<body>

<h3>Lista De Dependentes</h3>

<div><?php echo Mensagem::getMensagem()?></div>

<table>
    <thead>

    <tr>
        <th>Nome</th>
        <th>Data Nascimento</th>
        <th>Grau Parentesco</th>
    </tr>

    </thead>

    <tbody>
    <?php foreach ($loDependentes as $oDependente ) { ?>
        <tr>
            <td><?php echo $oDependente->getNome()?></td>
            <td><?php echo $oDependente->getDataNascimento() ?></td>
            <td><?php echo $oDependente->getGrauParentesco() ?></td>
            <?php if(Session_Handler::obterSessao('tipo') === 'Administrador') { ?>
                <td><a href=<?php Ambiente::getUrl('Dependente/editar',true)?>?id=<?php echo $oDependente->getIdDependente()?>>Editar</td>
                <td>
                    <form action="<?php Ambiente::getUrl('Dependente/excluir',true)?>?idF=<?php echo $oDependente->getIdFiliado()?>" method="post">
                        <input type="hidden" name="idD" value="<?php echo $oDependente->getIdDependente()?>">
                        <input type="submit" value="Excluir">
                    </form>
                </td>
            <?php } ?>
        </tr>
    <?php } ?>
    </tbody>
</table>

<form action="<?php Ambiente::getUrl('Dependente/cadastrar',true)?>?id=<?php echo $iIdFiliado ?>" method="post">

    <div id="dependente"></div>

    <?php if(Session_Handler::obterSessao('tipo') === 'Administrador') { ?>
        <a href="#" id="add">Cadastrar dependente</a>
        <input type="submit" name="cadastrar" value="Cadastrar">
    <?php } ?>
</form>

<a href=<?php Ambiente::getUrl('Filiado/listar',true)?>>Voltar</a>

<script src="/../Avaliacao/public/Js/Dependentes.js"></script>

</body>
</html>