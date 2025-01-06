<?php
use Moobi\Avaliacao\Config\Ambiente;
use Moobi\Avaliacao\Config\Mensagem;
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Responsavel por fazer o login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>

    <form action="<?php Ambiente::getUrl('Login/logar',true)?>" method="post">
        <div class="mb-3">
            <div class="form-group">
                <div class="row d-flex justify-content-center p-3 m-4">
                    <h3>Login</h3>
                </div>
            </div>

            <div><?php echo Mensagem::getMensagem()?></div>

            <div class="form-group">
                <div class="col-auto mb-3 col-md-6 offset-md-3">
                    <label class="form-label col-form-label">Nome: </label>
                    <input class="form-control form-control-lg" type="text" name="nome" id="nome" required>
                </div>
            </div>

            <div class="form-group">
                <div class="col-auto mb-3 col-md-6 offset-md-3">
                    <label class="form-label col-form-label">Senha: </label>
                    <input class="form-control form-control-lg" type="password" name="senha" id="senha" required>
                </div>
            </div>

            <div class="form-group">
                <div class="col-auto mb-3 col-md-4 offset-md-4 p-4">
                    <input class="form-control btn btn-secondary btn-lg" type="submit" name="login" value="Login">
                </div>
            </div>
        </div>
    </form>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
