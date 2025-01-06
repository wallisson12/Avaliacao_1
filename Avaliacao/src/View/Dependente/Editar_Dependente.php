<?php
use Moobi\Avaliacao\Config\Ambiente;
/** @var array $aDependente */
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>