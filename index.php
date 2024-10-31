<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    session_start();

    include_once('app/functions.php');

    if(!isset($_SESSION['form']) || empty($_SESSION['form'])){
        $_SESSION['form'] = [
            "pasoActual" => 1,
            "pasos" => [
                1=>[
                    "options" =>["hombre","mujer"],
                    "values" =>""
                ],
                2=>[
                    "options" =>["pectoral","biceps","gluteos"],
                    "values" =>""
                ],
                3=>[
                    "options" =>[],
                    "values" =>""
                ],
                4=>[
                    "options" => ["nombre", "email", "foto"],
                    "values" =>[],
                ],
                5=>[
                    "control" => "mostrar"
                ]
            ]
        ];

    }

    if(isset($_POST['accion']) && !empty($_POST['accion'])){
        echo "ZZZZZZ";
        switch ($_POST['accion']) {
            case 'atras':
                $_SESSION['form']['pasoActual'] = $_SESSION['form']['pasoActual'] - 1;
                echo "AAAAA";
                break;

            case 'siguiente':
                $_SESSION['form']['pasoActual'] = $_SESSION['form']['pasoActual'] + 1;
                echo "BBBB";
                break;
            
            default:
            echo "CCCC";
                break;
        }
    }
    var_dump($_SESSION['form']);
    

    $formBody = getFormMarkup($_SESSION['form']['pasoActual']);


    include_once('templates/templateIndex.php');
?>