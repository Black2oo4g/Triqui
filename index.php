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
    <div class="header">
        <h1>Tica Tac Toe</h1>
        <p><?php echo $_SESSION['msjtriqui']; ?></p>
        <form method="post" action="triqui.php">
            <label for="idcelda">Coordenadas de la celda:</label>
            <input type="text" id="idcelda" name="idcelda" required>
            <input type="submit" value="Marcar">
        </form>
    </div>

    <div class="table-container">
        <div class="tarjeta">
            <?php mostrartabla(); ?>
        </div>
        <div class="tarjeta1">
            <?php mostrartabla(); ?>
        </div>
        
    </div>
    <div class="content-container">
        <div class="box">
            <h2>¿Qué significa la palabra triqui?</h2>
            <p>El nombre trique, empleado históricamente por la población mexicana, designa a un grupo indígena y
                también a un conjunto de lenguas indígenas estrechamente relacionadas entre sí. Dicho nombre es la forma
                castellanizada de driqui, que en la propia lengua significa Dios.</p>
                <img src="img/img2.png" alt="">
        </div>
        <div class="box">
            <h2>Generado por la IA</h2>
            <img src="img/img1.jpeg" alt="">
        </div>
        <div class="box">
            <h2>Mas info</h2>
            <p>El tres en línea, también conocido como ceros y cruces, tres en raya, cerito cruz, michi, triqui,
                cuadritos, juego del gato, gato, tatetí, totito, triqui traka, equis cero, o la vieja es un juego de
                lápiz y papel entre dos jugadores: O y X, que marcan los espacios de un tablero de 3×3 alternadamente.
            </p>
        </div>
    </div>
</body>

</html>