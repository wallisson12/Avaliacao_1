<?php
use Moobi\Avaliacao\Config\Ambiente;
/** @var array $aDependente */
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
</head>
<body>

<h3>Editar Dependente</h3>

<form action="<?php Ambiente::getUrl('Dependente/atualizar',true)?>?id=<?php echo $aDependente[0]->getIdDependente()?>" method="post">

    <div>
        <label>Nome</label>
        <input type="text" name="nome" value="<?php echo $aDependente[0]->getNome(); ?>" required>
    </div>

    <div>
        <label>Data Nascimento</label>
        <input type="date" name="data_nascimento" value="<?php echo DateTime::createFromFormat('d/m/Y', $aDependente[0]->getDataNascimento())->format('Y-m-d'); ?>" required>
    </div>

    <div>
        <label>Situacao</label>
        <select name="parentesco">
            <option value="Conjuge" <?php echo $aDependente[0]->getGrauParentesco() == 'Conjuge' ? 'selected' : ''; ?>>Conjuge</option>
            <option value="Filho" <?php echo $aDependente[0]->getGrauParentesco() == 'Filho' ? 'selected' : ''; ?>>Filho</option>
            <option value="Pai" <?php echo $aDependente[0]->getGrauParentesco() == 'Mae' ? 'selected' : ''; ?>>Pai</option>
            <option value="Mae" <?php echo $aDependente[0]->getGrauParentesco() == 'Pai' ? 'selected' : ''; ?>>Mae</option>
        </select>
    </div>

    <input type="hidden" name="idF" value="<?php echo $aDependente[0]->getIdFiliado()?>">
    <input type="submit" name="editar" value="Editar">

</form>

<a href="<?php Ambiente::getUrl('Dependente/listar',true)?>?id=<?php echo $aDependente[0]->getIdFiliado()?>">Voltar</a>
</body>
</html>