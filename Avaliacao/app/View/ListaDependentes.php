<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lista Dependentes</title>
    <h3>Lista De Dependentes</h3>
    <h3>Filiado: </h3>
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
            <td>
                <form action="http://localhost:5000/Avaliacao/Dependente/excluir" method="post">
                    <input type="hidden" name="idD" value="<?php echo $oDependente->getIdDependente()?>">
                    <input type="submit" value="Excluir">
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<form action="http://localhost:5000/Avaliacao/Dependente/cadastrar?id=<?php echo $iIdFiliado ?>" method="post">

    <div id="dependente"></div>

    <!-- Vai permitir que cadastre mais de 1 dependente desse usuario !-->
    <a href="#" id="add">Cadastrar dependente</a>
    <!-- Vai efetivamente fazer chamar a funcao para realizar o cadastro no banco, seguindo o id do filiado !-->
    <input type="hidden" name="idF" value="<?php echo $iIdFiliado?>">
    <input type="submit" name="cadastrar" value="Cadastrar">

</form>

<a href="http://localhost:5000/Avaliacao/Filiado/listar">Voltar</a>

<script src="/../Avaliacao/app/View/Js/Dependentes.js"></script>
</body>
</html>