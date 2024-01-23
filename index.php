<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Juego Triqui</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include 'triqui.php'; ?>
    <p><?php echo $_SESSION['msjtriqui']; ?></p>
    <form method="post" action="triqui.php">
        <label for="idcelda">Coordenadas de la celda:</label>
        <input type="text" id="idcelda" name="idcelda" required>
        <input type="submit" value="Marcar">
    </form>
    <?php mostrartabla(); ?>
</body>
</html>