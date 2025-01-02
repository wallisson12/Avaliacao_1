<?php
use Moobi\Avaliacao\Config\Ambiente;
use Moobi\Avaliacao\Config\Mensagem;

/** @var array $aFiliado */
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

    <h3>Editar Filiado</h3>

    <form action="<?php Ambiente::getUrl('Filiado/atualizar',true)?>?id=<?php echo $aFiliado[0]->getId()?>" method="post">

        <div><?php echo Mensagem::getMensagem()?></div>

        <div>
            <label>Nome</label>
            <input type="text" value="<?php echo $aFiliado[0]->getNome(); ?>" readonly>
        </div>

        <div>
            <label>CPF</label>
            <input type="text" value="<?php echo $aFiliado[0]->getCpf(); ?>" readonly>
        </div>

        <div>
            <label>Idade</label>
            <input type="text" value="<?php echo $aFiliado[0]->getIdade(); ?>" readonly>
        </div>

        <div>
            <label>RG</label>
            <input type="text" value="<?php echo $aFiliado[0]->getRG(); ?>" readonly>
        </div>

        <div>
            <label>Data Nascimento</label>
            <input type="text" value="<?php echo $aFiliado[0]->getDataNascimento(); ?>" readonly>
        </div>

        <div>
            <label>Empresa</label>
            <input type="text" name="empresa" value="<?php echo $aFiliado[0]->getEmpresa(); ?>">
        </div>

        <div>
            <label>Cargo</label>
            <input type="text" name="cargo" value="<?php echo $aFiliado[0]->getCargo(); ?>">
        </div>

        <div>
            <label>Situacao</label>
            <select name="situacao">
                <option value="Ativo" <?php echo $aFiliado[0]->getSituacao() == 'Ativo' ? 'selected' : ''; ?>>Ativo</option>
                <option value="Aposentado" <?php echo $aFiliado[0]->getSituacao() == 'Aposentado' ? 'selected' : ''; ?>>Aposentado</option>
                <option value="Licenciado" <?php echo $aFiliado[0]->getSituacao() == 'Licenciado' ? 'selected' : ''; ?>>Licenciado</option>
                <option value="" <?php echo $aFiliado[0]->getSituacao() == '' ? 'selected' : ''; ?>></option>
            </select>
        </div>

        <div>
            <label>Telefone Residencial</label>
            <input type="text" value="<?php echo $aFiliado[0]->getTelefoneResidencial(); ?>" readonly>
        </div>

        <div>
            <label>Celular</label>
            <input type="text" value="<?php echo $aFiliado[0]->getCelular(); ?>" readonly>
        </div>

        <div>
            <label>Data Ultima Atualizacao</label>
            <input type="text" name="data" value="<?php echo $aFiliado[0]->getDataUltimaAtualizacao(); ?>" readonly>
        </div>

        <input type="submit" name="editar" value="Editar">
    </form>

    <a href="<?php Ambiente::getUrl('Filiado/indexListar',true)?>">Voltar</a>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>
