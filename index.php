<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    session_start();

    include_once('app/functions.php');

    if(isset($_SESSION['form']) && !empty($_SESSION['form'])){
        $formulario = $_SESSION['form'];
    }else{

        $_SESSION['form'] = [
            "pasoActual" => 1,
            "pasos" => [
                1=>[
                    "control" => "select",
                    "options" =>["hombre","mujer"],
                    "values" =>""
                ],
                2=>[
                    "control" => "checkbox",
                    "options" =>["pectoral","biceps","gluteos"],
                    "values" =>""
                ],
                3=>[
                    "control" => "select",
                    "options" =>[],
                    "values" =>""
                ],
                4=>[
                    "control" =>"text",
                    "options" => ["nombre", "email", "foto"],
                    "values" =>[],
                ],
                5=>[
                    "control" => "mostrar"
                ]
            ]
        ];

    }
    if(isset($POST) && !empty($POST)){
    
    }
    var_dump($POST);
    var_dump($_SESSION);

    $formBody = getFormMarkup($formulario['pasoActual']);

    include_once('templates/templateIndex.php');
?>