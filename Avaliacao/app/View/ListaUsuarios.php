<?php
require_once __DIR__ . "/../../Config/Session_Handler.php";
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    <h3>Lista De Usuarios</h3>
</head>

<body>

<section>
    <table>

        <thead>
            <tr>
                <th>Nome</th>
                <th>Tipo Usuario</th>
            </tr>
        </thead>

        <tbody>
        <?php foreach ($usuarios as $oUsuario) : ?>
            <tr>
                <td><?php echo $oUsuario->getNome() ?></td>
                <td><?php echo $oUsuario->getTipo_Usuario() ?></td>
                <?php if(Session_Handler::obterSessao('tipo') === 'Administrador') : ?>
                    <td><a href="http://localhost:5000/Avaliacao/Usuario/editar?id=<?php echo $oUsuario->getId()?>">Editar</td>
                    <td>
                        <form action="http://localhost:5000/Avaliacao/Usuario/excluir" method="post">
                            <input type="hidden" name="id" value="<?php echo $oUsuario->getId()?>">
                            <input type="submit" value="Excluir">
                        </form>
                    </td>
                <?php endif; ?>
            </tr>

        <?php endforeach; ?>
        </tbody>

    </table>
</section>


<a href="http://localhost:5000/Avaliacao/Usuario/indexDashborad">Voltar</a>

</body>
</html>
