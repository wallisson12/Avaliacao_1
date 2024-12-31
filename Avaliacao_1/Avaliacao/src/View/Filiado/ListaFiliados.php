<?php
use Moobi\Avaliacao\Config\Ambiente;
use Moobi\Avaliacao\Config\Mensagem;
use Moobi\Avaliacao\Config\Session_Handler;

/**
 * @var array $aFiliados
 * @var array $aMeses
 * @var int $iPagina
 * @var int $iTotalPaginas
 * @var string $sNomeSelecionado
 * @var string $sMesSelecionado
 */
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lista De Filiados</title>
</head>

<body>

<h3>Lista De Filiados</h3>

<form action="<?php Ambiente::getUrl('Filiado/listar',true)?>" method="post">

    <div><?php echo Mensagem::getMensagem()?></div>

    <label>Nome: </label>
    <input type="text" name="filtros[nome]" value="<?php echo $sNomeSelecionado ?>">

    <select name="filtros[mes]">
        <option value=""></option>
        <?php foreach($aMeses as $iNumero => $sNome) { ?>
            <option value="<?php echo $iNumero ?>" 
                            <?php echo $sMesSelecionado == $iNumero ? 'selected' : '' ?>>
                            <?php echo $sNome ?>
            </option>
        <?php }?>
    </select>

    <input type="submit" value="Filtrar">
    <a href=<?php Ambiente::getUrl('Filiado/limparFiltros',true)?>>Limpar</a>
</form>

<form action="<?php Ambiente::getUrl('Filiado/excluirFiliadosMarcados',true)?>" method="post">
    <input type="submit" value="Deletar">
    <input type="hidden" id="inputFiliadosId" name="filiadosId[]">
</form>

<section>
    <table>
        <thead>
            <tr>
                <th><input id="todosFiliados" type="checkbox"></th>
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
         <?php foreach ($aFiliados as $oFiliado) { ?>
            <tr>
                <td></td>
                <td><input class="checkboxFiliado" type="checkbox" value="<?php echo $oFiliado->getId()?>"> <?php echo $oFiliado->getNome()?> </td>
                <td><?php echo $oFiliado->getCPF()?></td>
                <td><?php echo $oFiliado->getIdade()?></td>
                <td><?php echo $oFiliado->getRG()?></td>
                <td><?php echo $oFiliado->getDataNascimento()?></td>
                <td><?php echo !empty($oFiliado->getEmpresa()) ? $oFiliado->getEmpresa() : '-' ?></td>
                <td><?php echo !empty($oFiliado->getCargo()) ? $oFiliado->getCargo() : '-' ?></td>
                <td><?php echo !empty($oFiliado->getSituacao()) ? $oFiliado->getSituacao() : '-' ?></td>
                <td><?php echo $oFiliado->getTelefoneResidencial()?></td>
                <td><?php echo $oFiliado->getCelular()?></td>
                <td><?php echo $oFiliado->getDataUltimaAtualizacao()?></td>
                <?php if(Session_Handler::obterSessao('tipo') === 'Administrador') { ?>
                    <td><a href=<?php Ambiente::getUrl('Filiado/editar',true)?>?id=<?php echo $oFiliado->getId()?>>Editar</td>
                    <td>
                        <form action="<?php Ambiente::getUrl('Filiado/excluir',true)?>" method="post">
                            <input type="hidden" name="id" value="<?php echo $oFiliado->getId()?>">
                            <input type="submit" value="Excluir">
                        </form>
                    </td>
                <?php } ?>
                <td><a href=<?php Ambiente::getUrl('Dependente/listar',true)?>?id=<?php echo $oFiliado->getId()?>>Dependentes</a></td>
            </tr>

        <?php } ?>
        </tbody>

    </table>
</section>

<br>

<div>
    <a href=<?php Ambiente::getUrl('Filiado/listar',true)?>?pagina=1>Primeira</a>

        <?php if($iPagina>1) { ?>
            <a href="?pagina=<?php echo $iPagina-1 ?>"><<</a>
        <?php } ?>

        <?php echo $iPagina?>

        <?php if($iPagina<$iTotalPaginas) { ?>
            <a href="?pagina=<?php echo $iPagina+1?>">>></a>
        <?php } ?>

    <a href=<?php Ambiente::getUrl('Filiado/listar',true)?>?pagina=<?php echo $iTotalPaginas ?>>Ultima</a>
</div>

<br>

<a href=<?php Ambiente::getUrl('Filiado/indexDashborad',true)?>>Voltar</a>

<script src="/../Avaliacao/public/Js/ListaFiliados.js"></script>
</body>
</html>
