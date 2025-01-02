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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>