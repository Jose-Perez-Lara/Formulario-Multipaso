<?php
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
                    "value" =>""
                ],
                2=>[
                    "control" => "checkbox",
                    "options" =>["hombre","mujer"],
                    "value" =>""
                ],
                3=>[

                ],
                4=>[

                ]
            ]
        ];

    }


?>