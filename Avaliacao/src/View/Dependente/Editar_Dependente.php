<?php
use Moobi\Avaliacao\Config\Ambiente;
/** @var array $aDependente */
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>