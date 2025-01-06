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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>

    <form action="<?php Ambiente::getUrl('Filiado/listar',true)?>" method="post">

        <div class="form-group">
            <div class="row d-flex justify-content-center p-2 m-2">
                <h3>Lista De Filiados</h3>
            </div>
        </div>

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

        <input class="btn btn-secondary" type="submit" value="Filtrar">
        <a class="btn btn-primary" role="button" href=<?php Ambiente::getUrl('Filiado/limparFiltros',true)?>>Limpar</a>
    </form>

    <form action="<?php Ambiente::getUrl('Filiado/excluirFiliadosMarcados',true)?>" method="post">
        <div class="form-group m-2">
            <input class="btn btn-danger m-2" type="submit" value="Deletar">
            <input type="hidden" id="inputFiliadosId" name="filiadosId[]">
        </div>
    </form>

    <section class="p-2">
        <table class="table table-hover table-bordered table-sm">
            <thead class="thead-light">
                <tr>
                    <th><input id="todosFiliados" type="checkbox"></th>
                    <th scope="col">Nome</th>
                    <th scope="col">CPF</th>
                    <th scope="col">Idade</th>
                    <th scope="col">RG</th>
                    <th scope="col">Data Nascimento</th>
                    <th scope="col">Empresa</th>
                    <th scope="col">Cargo</th>
                    <th scope="col">Situacao</th>
                    <th scope="col">Telefone Residencial</th>
                    <th scope="col">Celular</th>
                    <th scope="col">Data Ultima Atualizacao</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
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
                        <td><a class="btn btn-outline-info" href=<?php Ambiente::getUrl('Filiado/editar',true)?>?id=<?php echo $oFiliado->getId()?>>Editar</td>
                        <td>
                            <form action="<?php Ambiente::getUrl('Filiado/excluir',true)?>" method="post">
                                <input type="hidden" name="id" value="<?php echo $oFiliado->getId()?>">
                                <input class="btn btn-outline-danger" type="submit" value="Excluir">
                            </form>
                        </td>
                    <?php } ?>
                    <td><a class="btn btn-outline-primary" href=<?php Ambiente::getUrl('Dependente/listar',true)?>?id=<?php echo $oFiliado->getId()?>>Dependentes</a></td>
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

    <div class="col-auto col-md-4 p-3">
        <a class="btn btn-dark btn-lg" role="button" href=<?php Ambiente::getUrl('Filiado/indexDashborad',true)?>>Voltar</a>
    </div>

    <script src="/../Avaliacao/public/Js/ListaFiliados.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
