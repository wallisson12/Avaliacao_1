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
        <?php foreach ($usuarios as $usuario) : ?>
            <tr>
                <td><?php echo $usuario->getNome() ?></td>
                <td><?php echo $usuario->getTipo_Usuario()->value ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>

    </table>
</section>

</body>
</html>
