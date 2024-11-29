<?php
require_once __DIR__ . "/../../Config/Session_Handler.php";
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lista Dependentes</title>
    <h3>Lista De Dependentes</h3>
</head>
<body>
<table>
    <thead>

    <tr>
        <th>Nome</th>
        <th>Data Nascimento</th>
        <th>Grau Parentesco</th>
    </tr>

    </thead>

    <tbody>
    <?php foreach ($aDependentes as $oDependente ) : ?>
        <tr>
            <td><?php echo $oDependente->getNome()?></td>
            <td><?php echo $oDependente->getDataNascimento() ?></td>
            <td><?php echo $oDependente->getGrauParentesco() ?></td>
            <?php if(Session_Handler::obterSessao('tipo') === 'Administrador') : ?>
                <td><a href="http://localhost:5000/Avaliacao/Dependente/editar?id=<?php echo $oDependente->getIdDependente()?>">Editar</td>
                <td>
                    <form action="http://localhost:5000/Avaliacao/Dependente/excluir?idF=<?php echo $oDependente->getIdFiliado()?>" method="post">
                        <input type="hidden" name="idD" value="<?php echo $oDependente->getIdDependente()?>">
                        <input type="submit" value="Excluir">
                    </form>
                </td>
            <?php endif; ?>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<form action="http://localhost:5000/Avaliacao/Dependente/cadastrar?id=<?php echo $iIdFiliado ?>" method="post">

    <div id="dependente"></div>

    <?php if(Session_Handler::obterSessao('tipo') === 'Administrador') : ?>
        <a href="#" id="add">Cadastrar dependente</a>
        <input type="submit" name="cadastrar" value="Cadastrar">
    <?php endif; ?>
</form>

<a href="http://localhost:5000/Avaliacao/Filiado/listar">Voltar</a>

<script src="/../Avaliacao/app/View/Js/Dependentes.js"></script>
</body>
</html>