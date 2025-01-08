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
    <link rel="stylesheet" href="/../Avaliacao/public/Css/main.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <?php require(__DIR__ . '/../parcial/nav.php')?>

    <form action="<?php Ambiente::getUrl('Filiado/atualizar',true)?>?id=<?php echo $aFiliado[0]->getId()?>" method="post">

        <div class="mb-3">
            <div class="form-group">
                <div class="row d-flex justify-content-center p-2">
                    <h3>Editar Filiado</h3>
                </div>
            </div>

            <div class="form-group">
                <div class="row d-flex justify-content-center">
			        <?php echo Mensagem::getMensagem()?>
                </div>
            </div>

            <div class="form-group">
                <div class="col-auto mb-3 col-md-6 offset-md-3">
                    <label class="form-label col-form-label">Nome</label>
                    <input class="form-control form-control-lg" type="text" value="<?php echo $aFiliado[0]->getNome(); ?>" readonly>
                </div>
            </div>

            <div class="form-group">
                <div class="col-auto mb-3 col-md-6 offset-md-3">
                    <label class="form-label col-form-label">CPF</label>
                    <input class="form-control form-control-lg" type="text" value="<?php echo $aFiliado[0]->getCpf(); ?>" readonly>
                </div>
            </div>

            <div class="form-group">
                <div class="col-auto mb-3 col-md-6 offset-md-3">
                    <label class="form-label col-form-label">Idade</label>
                    <input class="form-control form-control-lg" type="text" value="<?php echo $aFiliado[0]->getIdade(); ?>" readonly>
                </div>
            </div>

            <div class="form-group">
                <div class="col-auto mb-3 col-md-6 offset-md-3">
                    <label class="form-label col-form-label">RG</label>
                    <input class="form-control form-control-lg" type="text" value="<?php echo $aFiliado[0]->getRG(); ?>" readonly>
                </div>
            </div>

            <div class="form-group">
                <div class="col-auto mb-3 col-md-6 offset-md-3">
                    <label class="form-label col-form-label">Data Nascimento</label>
                    <input class="form-control form-control-lg" type="text" value="<?php echo $aFiliado[0]->getDataNascimento(); ?>" readonly>
                </div>
            </div>

            <div class="form-group">
                <div class="col-auto mb-3 col-md-6 offset-md-3">
                    <label class="form-label col-form-label">Empresa</label>
                    <input class="form-control form-control-lg" type="text" name="empresa" value="<?php echo $aFiliado[0]->getEmpresa(); ?>">
                </div>
            </div>

            <div class="form-group">
                <div class="col-auto mb-3 col-md-6 offset-md-3">
                    <label class="form-label col-form-label">Cargo</label>
                    <input class="form-control form-control-lg" type="text" name="cargo" value="<?php echo $aFiliado[0]->getCargo(); ?>">
                </div>
            </div>

            <div class="form-group">
                <div class="col-auto mb-3 col-md-6 offset-md-3">
                    <fieldset class="d-flex flex-column">
                        <label class="form-label col-form-label">Situacao</label>
                        <select class="form-select form-select-lg mb-3 p-3 rounded padraoSelects" name="situacao">
                            <option value="Ativo" <?php echo $aFiliado[0]->getSituacao() == 'Ativo' ? 'selected' : ''; ?>>Ativo</option>
                            <option value="Aposentado" <?php echo $aFiliado[0]->getSituacao() == 'Aposentado' ? 'selected' : ''; ?>>Aposentado</option>
                            <option value="Licenciado" <?php echo $aFiliado[0]->getSituacao() == 'Licenciado' ? 'selected' : ''; ?>>Licenciado</option>
                            <option value="" <?php echo $aFiliado[0]->getSituacao() == '' ? 'selected' : ''; ?>></option>
                        </select>
                    </fieldset>
                </div>
            </div>

            <div class="form-group">
                <div class="col-auto mb-3 col-md-6 offset-md-3">
                    <label class="form-label col-form-label">Telefone Residencial</label>
                    <input class="form-control form-control-lg" type="text" value="<?php echo $aFiliado[0]->getTelefoneResidencial(); ?>" readonly>
                </div>
            </div>

            <div class="form-group">
                <div class="col-auto mb-3 col-md-6 offset-md-3">
                    <label class="form-label col-form-label">Celular</label>
                    <input class="form-control form-control-lg" type="text" value="<?php echo $aFiliado[0]->getCelular(); ?>" readonly>
                </div>
            </div>

            <div class="form-group">
                <div class="col-auto mb-3 col-md-6 offset-md-3">
                    <label class="form-label col-form-label">Data Ultima Atualizacao</label>
                    <input class="form-control form-control-lg" type="text" name="data" value="<?php echo $aFiliado[0]->getDataUltimaAtualizacao(); ?>" readonly>
                </div>
            </div>

            <div class="form-group">
                <div class="col-auto mb-3 col-md-4 offset-md-4 p-4">
                    <input class="form-control btn btn-secondary btn-lg" type="submit" name="editar" value="Editar">
                </div>
            </div>

        </div>
    </form>

    <div class="col-auto col-md-4 p-3">
        <a class="btn btn-dark btn-lg" href="<?php Ambiente::getUrl('Filiado/indexListar',true)?>">Voltar</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
