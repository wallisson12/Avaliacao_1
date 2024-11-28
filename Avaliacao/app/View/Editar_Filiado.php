<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    <h3>Editar Filiado</h3>
</head>
<body>

<form action="http://localhost:5000/Avaliacao/Filiado/atualizar?id=<?php echo $oFiliado[0]->getId()?>" method="post">

    <div>
        <label>Nome</label>
        <input type="text" value="<?php echo $oFiliado[0]->getNome(); ?>" readonly>
    </div>

    <div>
        <label>CPF</label>
        <input type="text" value="<?php echo $oFiliado[0]->getCpf(); ?>" readonly>
    </div>

    <div>
        <label>Idade</label>
        <input type="text" value="<?php echo $oFiliado[0]->getIdade(); ?>" readonly>
    </div>

    <div>
        <label>RG</label>
        <input type="text" value="<?php echo $oFiliado[0]->getRG(); ?>" readonly>
    </div>

    <div>
        <label>Data Nascimento</label>
        <input type="text" value="<?php echo $oFiliado[0]->getDataNascimento(); ?>" readonly>
    </div>

    <div>
        <label>Empresa</label>
        <input type="text" name="empresa" value="<?php echo $oFiliado[0]->getEmpresa(); ?>">
    </div>

    <div>
        <label>Cargo</label>
        <input type="text" name="cargo" value="<?php echo $oFiliado[0]->getCargo(); ?>">
    </div>

    <div>
        <label>Situacao</label>
        <select name="situacao">
            <option value="Ativo" <?php echo $oFiliado[0]->getSituacao() == 'Ativo' ? 'selected' : ''; ?>>Ativo</option>
            <option value="Aposentado" <?php echo $oFiliado[0]->getSituacao() == 'Aposentado' ? 'selected' : ''; ?>>Aposentado</option>
            <option value="Licenciado" <?php echo $oFiliado[0]->getSituacao() == 'Licenciado' ? 'selected' : ''; ?>>Licenciado</option>
            <option value="" <?php echo $oFiliado[0]->getSituacao() == '' ? 'selected' : ''; ?>></option>
        </select>
    </div>

    <div>
        <label>Telefone Residencial</label>
        <input type="text" value="<?php echo $oFiliado[0]->getTelefoneResidencial(); ?>" readonly>
    </div>

    <div>
        <label>Celular</label>
        <input type="text" value="<?php echo $oFiliado[0]->getCelular(); ?>" readonly>
    </div>

    <div>
        <label>Data Ultima Atualizacao</label>
        <input type="text" name="data" value="<?php echo $oFiliado[0]->getDataUltimaAtualizacao(); ?>" readonly>
    </div>

    <input type="submit" name="editar" value="Editar">
</form>

<a href="http://localhost:5000/Avaliacao/Filiado/indexListar">Voltar</a>
</body>
</html>
