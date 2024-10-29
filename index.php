<?php
    session_start();

    include_once('app/functions.php');

    if(isset($_SESSION['form']) && !empty($_SESSION['form'])){
        $formulario = $_SESSION['form'];
    }else{
        $_SESSION['form'] = [

        ];
    }


?>