<?php
require_once __DIR__ . "/../../Config/Ambiente.php";
require_once __DIR__ . "/../../Config/Session_Handler.php";
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lista De Filiados</title>
    <h3>Lista De Filiados</h3>
</head>
<body>

<form action="<?php Ambiente::getUrl('Filiado/listar',true)?>" method="post">

    <label>Nome: </label>
    <input type="text" name="filtros[nome]" value="<?php echo json_decode(Session_Handler::obterSessao('filtros'),true)['nome'] ?>">

    <select name="filtros[mes]">
        <option value=""></option>
        <option value="1">Janeiro</option>
        <option value="2">Fevereiro</option>
        <option value="3">Marco</option>
        <option value="4">Abril</option>
        <option value="5">Maio</option>
        <option value="6">Junho</option>
        <option value="7">Julho</option>
        <option value="8">Agosto</option>
        <option value="9">Setembro</option>
        <option value="10">Outubro</option>
        <option value="11">Novembro</option>
        <option value="12">Dezembro</option>
    </select>

    <input type="submit" value="Filtrar">
</form>


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
         <?php foreach ($aFiliados as $oFiliado) : ?>

            <tr>
                <td><?php echo $oFiliado->getNome()?></td>
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
                <?php if(Session_Handler::obterSessao('tipo') === 'Administrador') : ?>
                    <td><a href=<?php Ambiente::getUrl('Filiado/editar',true)?>?id=<?php echo $oFiliado->getId()?>>Editar</td>
                    <td>
                        <form action="<?php Ambiente::getUrl('Filiado/excluir',true)?>" method="post">
                            <input type="hidden" name="id" value="<?php echo $oFiliado->getId()?>">
                            <input type="submit" value="Excluir">
                        </form>
                    </td>
                <?php endif; ?>
                <td><a href=<?php Ambiente::getUrl('Dependente/listar',true)?>?id=<?php echo $oFiliado->getId()?>>Dependentes</a></td>
            </tr>

        <?php endforeach; ?>
        </tbody>

    </table>
</section>

<br>

<div>
<a href=<?php Ambiente::getUrl('Filiado/listar',true)?>?pagina=1>Primeira</a>

    <?php if($iPagina>1) : ?>
        <a href="?pagina=<?php echo $iPagina-1 ?>"><<</a>
    <?php endif; ?>

    <?php echo $iPagina?>

    <?php if($iPagina<=$iTotalPaginas) : ?>
    <a href="?pagina=<?php echo $iPagina+1?>">>></a>
    <?php endif; ?>

<a href=<?php Ambiente::getUrl('Filiado/listar',true)?>?pagina=<?php echo $iTotalPaginas ?>>Ultima</a>

</div>

<br>

<a href=<?php Ambiente::getUrl('Filiado/indexDashborad',true)?>>Voltar</a>

</body>
</html>
