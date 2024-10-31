<?php
session_start();

if (!isset($_SESSION['tabla'])) {
    $_SESSION['tabla'] = [
        [" ", " ", " "],
        [" ", " ", " "],
        [" ", " ", " "]
    ];
}

if (!isset($_SESSION['turno'])) {
    $_SESSION['turno'] = 0;
}

if (!isset($_SESSION['msjtriqui'])) {
    $_SESSION['msjtriqui'] = " ";
}

if (!isset($_SESSION['color'])) {
    $_SESSION['color'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idcelda'])) {
    $idcelda = $_POST['idcelda'];

    $fila = intval(substr($idcelda, 0, 1)) - 1;
    $columna = intval(substr($idcelda, 1, 1)) - 1;

    // Modificación para permitir que el usuario vuelva a seleccionar una celda si está ocupada
    if ($_SESSION['tabla'][$fila][$columna] == " ") {
        marcar($fila, $columna);

        if (validar()) {
            $_SESSION['msjtriqui'] = "Triqui, GANASTE";
            header("Location: index.php");
            exit;
        } else {
            jugarMaquina();
            if (validar()) {
                $_SESSION['msjtriqui'] = "Triqui, la máquina GANÓ";
                header("Location: index.php");
                exit;
            } else {
                header("Location: index.php");
                exit;
            }
        }
    } else {
        $_SESSION['msjtriqui'] = "Lugar ocupado, elige otro.";
        header("Location: index.php");
        exit;
    }
}

function marcar($fila, $columna)
{
    if ($_SESSION['tabla'][$fila][$columna] == " ") {
        if ($_SESSION['turno'] === 0) {
            $_SESSION['tabla'][$fila][$columna] = "X";
            $_SESSION['color'][$fila][$columna] = "blue";
        } else {
            $_SESSION['tabla'][$fila][$columna] = "O";
            $_SESSION['color'][$fila][$columna] = "red";
        }
        $_SESSION['turno'] = 1 - $_SESSION['turno'];
        $_SESSION['msjtriqui'] = "  ";
    } else {
        $_SESSION['msjtriqui'] = "Lugar inválido";
    }
}

function jugarMaquina()
{
    do {
        $fila = rand(0, 2);
        $columna = rand(0, 2);
    } while ($_SESSION['tabla'][$fila][$columna] != " ");

    $_SESSION['tabla'][$fila][$columna] = "O";
    $_SESSION['color'][$fila][$columna] = "red";
    $_SESSION['turno'] = 1 - $_SESSION['turno'];
}

function validar()
{
    for ($i = 0; $i < 3; $i++) {
        switch (true) {
            case $_SESSION['tabla'][$i][0] != " " && $_SESSION['tabla'][$i][0] == $_SESSION['tabla'][$i][1] && $_SESSION['tabla'][$i][1] == $_SESSION['tabla'][$i][2]:
                // Verificar filas
                return true;
            case $_SESSION['tabla'][0][$i] != " " && $_SESSION['tabla'][0][$i] == $_SESSION['tabla'][1][$i] && $_SESSION['tabla'][1][$i] == $_SESSION['tabla'][2][$i]:
                // Verificar columnas
                return true;
            case $_SESSION['tabla'][0][0] != " " && $_SESSION['tabla'][0][0] == $_SESSION['tabla'][1][1] && $_SESSION['tabla'][1][1] == $_SESSION['tabla'][2][2]:
                // Verificar diagonal 1
                return true;
            case $_SESSION['tabla'][0][2] != " " && $_SESSION['tabla'][0][2] == $_SESSION['tabla'][1][1] && $_SESSION['tabla'][1][1] == $_SESSION['tabla'][2][0]:
                // Verificar diagonal 2
                return true;
        }
    }
    return false;
}

function mostrartabla()
{
    echo "<table>";
    for ($i = 1; $i <= 3; $i++) {
        echo "<tr>";
        for ($j = 1; $j <= 3; $j++) {
            $id = $i . $j;
            $contenido = $_SESSION['tabla'][$i - 1][$j - 1];
            $color = isset($_SESSION['color'][$i - 1][$j - 1]) ? $_SESSION['color'][$i - 1][$j - 1] : '';
            echo "<td id='$id' class='$color'>";
            echo $contenido;
            echo "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}
?>