<?php
use Moobi\Avaliacao\Config\Ambiente;
use Moobi\Avaliacao\Config\Mensagem;
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastro De Usuario</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="/../Avaliacao/public/Css/main.css">
</head>
<body>

<form action="<?php Ambiente::getUrl('Usuario/cadastrar',true)?>" method="post">

    <div class="mb-3">

        <div class="form-group">
            <div class="row d-flex justify-content-center p-3">
                <h3>Cadastrar Usuario</h3>
            </div>
        </div>

        <div><?php echo Mensagem::getMensagem()?></div>

        <div class="form-group">
            <div class="col-auto mb-3 col-md-6 offset-md-3">
                <label class="form-label col-form-label">Nome</label>
                <input class="form-control form-control-lg" type="text" name="nome" required>
            </div>
        </div>

        <div class="form-group">
            <div class="col-auto mb-3 col-md-6 offset-md-3">
                <label class="form-label col-form-label">Senha</label>
                <input class="form-control form-control-lg" type="password" name="senha" required>
            </div>
        </div>

        <div class="form-group">
            <div class="col-auto mb-3 col-md-6 offset-md-3">
                <fieldset class="d-flex flex-column">
                    <label class="form-label col-form-label">Tipo</label>
                    <select class="form-select form-select-lg mb-3 p-3 rounded padraoSelects" name="tipo">
                        <option value="Administrador">Administrador</option>
                        <option value="Comum">Comum</option>
                    </select>
                </fieldset>
            </div>
        </div>

        <div class="form-group">
            <div class="col-auto mb-3 col-md-4 offset-md-4 p-4">
                <input class="form-control btn btn-secondary btn-lg" type="submit" name="cadastrar" value="Cadastrar">
            </div>
        </div>
    </div>

</form>

<div class="col-auto col-md-4">
    <a class="btn btn-dark btn-lg" role="button" href=<?php Ambiente::getUrl('Usuario/indexDashborad',true) ?>>Voltar</a>
</div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
