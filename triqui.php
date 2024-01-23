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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idcelda'])) {
    $idcelda = $_POST['idcelda'];

    $fila = intval(substr($idcelda, 0, 1)) - 1;
    $columna = intval(substr($idcelda, 1, 1)) - 1;
    marcar($fila, $columna);
    if (validar()) {
        $_SESSION['msjtriqui'] = "Triqui, GANASTE";
        header("Location: index.php");
        exit;
    } else {
        header("Location: index.php");
        exit;
    }
}

function marcar($fila, $columna)
{
    if ($_SESSION['tabla'][$fila][$columna] == " ") {
        if ($_SESSION['turno'] === 0) {
            $_SESSION['tabla'][$fila][$columna] = "X";
        } else {
            $_SESSION['tabla'][$fila][$columna] = "O";
        }
        $_SESSION['turno'] = 1 - $_SESSION['turno'];
        $_SESSION['msjtriqui'] = "  ";
    } else {
        $_SESSION['msjtriqui'] = "Lugar inválido";
    }
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
            echo "<td id='$id'>";
            echo $_SESSION['tabla'][$i - 1][$j - 1];
            echo "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}
