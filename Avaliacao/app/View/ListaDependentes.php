
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
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

    <a href="http://localhost:5000/Avaliacao/Filiado/listar">Voltar</a>
    <!-- Vai permitir que cadastre mais de 1 dependente desse usuario !-->
    <a href="">Cadastrar dependente</a>
    <!-- Vai efetivamente fazer chamar a funcao para realizar o cadastro no banco, seguindo o id do filiado !-->
    <a href="">Cadastrar</a>

</body>
</html>