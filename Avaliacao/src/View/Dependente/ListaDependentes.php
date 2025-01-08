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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/../Avaliacao/public/Css/main.css">
</head>
<body>
    <?php require(__DIR__ . '/../parcial/nav.php')?>

<section class="p-3">

    <div class="form-group">
        <div class="row d-flex justify-content-center p-2 m-2">
            <h3>Lista De Dependentes</h3>
        </div>
    </div>

    <div class="form-group">
        <div class="row d-flex justify-content-center">
			<?php echo Mensagem::getMensagem()?>
        </div>
    </div>

    <table class="table table-hover table-bordered table-sm">
        <thead class="thead-light">
        <tr>
            <th scope="col">Nome</th>
            <th scope="col">Data Nascimento</th>
            <th scope="col">Grau Parentesco</th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>

        </thead>

        <tbody>
        <?php foreach ($loDependentes as $oDependente ) { ?>
            <tr>
                <td><?php echo $oDependente->getNome()?></td>
                <td><?php echo $oDependente->getDataNascimento() ?></td>
                <td><?php echo $oDependente->getGrauParentesco() ?></td>
                <?php if(Session_Handler::obterSessao('tipo') === 'Administrador') { ?>
                    <td><a class="btn btn-outline-info" href=<?php Ambiente::getUrl('Dependente/editar',true)?>?id=<?php echo $oDependente->getIdDependente()?>>Editar</td>
                    <td>
                        <form action="<?php Ambiente::getUrl('Dependente/excluir',true)?>?idF=<?php echo $oDependente->getIdFiliado()?>" method="post">
                            <input type="hidden" name="idD" value="<?php echo $oDependente->getIdDependente()?>">
                            <input class="btn btn-outline-danger" type="submit" value="Excluir">
                        </form>
                    </td>
                <?php } ?>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</section>
    <form action="<?php Ambiente::getUrl('Dependente/cadastrar',true)?>?id=<?php echo $iIdFiliado ?>" method="post">

        <div class="md-3">

        <div id="dependente"></div>
            <?php if(Session_Handler::obterSessao('tipo') === 'Administrador') { ?>
                <a class="btn btn-secondary" href="#" id="add">Cadastrar dependente</a>
                <input class="btn btn-success" role="button" type="submit" name="cadastrar" value="Cadastrar">
            <?php } ?>
        </div>
    </form>

    <div class="col-auto col-md-4 p-3">
        <a class="btn btn-dark btn-lg" role="button" href=<?php Ambiente::getUrl('Filiado/listar',true)?>>Voltar</a>
    </div>

    <script src="/../Avaliacao/public/Js/Dependentes.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>