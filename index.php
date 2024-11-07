<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

session_start();

include_once('app/functions.php');

if (!isset($_SESSION['form']) || empty($_SESSION['form'])) {
    $_SESSION['form'] = [
        "pasoActual" => 1,
        "pasos" => [
            1 => [
                "options" => ["hombre", "mujer"],
                "values" => []
            ],
            2 => [
                "options" => ["pectoral", "biceps", "gluteos"],
                "values" => []
            ],
            3 => [
                "options" => [],
                "values" => []
            ],
            4 => [
                "options" => [
                    "pectoral" => [
                        "Press de banca con barra \nPress inclinado con mancuernas \nAperturas en máquina ",
                        "Press declinado con barra \nFondos en paralelas \nAperturas en banco inclinado ",
                        "Press plano con mancuernas \nAperturas en banco plano \nPress en máquina "
                    ],
                    "biceps" => [
                        "Curl con barra \nCurl alterno con mancuernas \nCurl martillo ",
                        "Curl predicador con barra \nCurl concentrado \nCurl con polea baja ",
                        "Curl en banco inclinado \nCurl con mancuernas de pie \nCurl en polea alta "
                    ],
                    "gluteos" => [
                        "Sentadillas profundas \nHip thrust con barra \nPatada de glúteo en máquina ",
                        "Peso muerto sumo \nAbducción de cadera en máquina \nPuente de glúteos con barra ",
                        "Elevación de cadera con peso \nSentadilla búlgara \nPatada trasera con polea "
                    ]
                ],
                "values" => []
            ],
            5 => [
                "options" => [
                    "text" => "nombre",
                    "email" => "email",
                    "file" => "foto"
                ],
                "users" => [],
            ]
        ]
    ];
}

if (isset($_POST) && !empty($_POST)) {
    $pasoActual = $_SESSION['form']['pasoActual'];
    switch ($pasoActual) {
        case 1:
            $_SESSION['form']['pasos'][$pasoActual]['values'] = $_POST['genero'];
            break;
        case 2:
            $_SESSION['form']['pasos'][$pasoActual]['values'] = $_POST['musculos'];
            break;
        case 3:
            $pesos = $_POST['pesos'];
            $repeticiones = $_POST['repeticiones'];
            $pesosYRepeticiones = joinPesoYRepes($pesos, $repeticiones);
            $_SESSION['form']['pasos'][$pasoActual]['values'] = $pesosYRepeticiones;
            break;
        case 4:
            $_SESSION['form']['pasos'][$pasoActual]['values'] = $_POST['plan'];
            break;
        case 5:
            if (saveImage()) {
                $nombre = $_POST['nombre'];
                $email = $_POST['email'];
                $foto = $_POST['foto'];
                $userInfo = getUserInfoStructure($nombre, $email, $foto);
                $_SESSION['form']['pasos'][$pasoActual]['users'] = $userInfo;
            } else {
                $_SESSION['form']['pasoActual'] = $_SESSION['form']['pasoActual'] - 1;
            }

            break;
        default:
            # code...
            break;
    }
}



if (isset($_POST['accion']) && !empty($_POST['accion'])) {

    switch ($_POST['accion']) {
        case 'atras':
            $_SESSION['form']['pasoActual'] = $_SESSION['form']['pasoActual'] - 1;
            break;

        case 'siguiente':
            $_SESSION['form']['pasoActual'] = $_SESSION['form']['pasoActual'] + 1;
            break;
        case 'finalizar':
            $_SESSION['form']['pasoActual'] = "final";
            break;

        default:
            echo "CCCC";
            break;
    }
}


$formBody = getFormMarkup($_SESSION['form']['pasoActual']);


include_once('templates/templateIndex.php');
