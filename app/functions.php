<?php
    function getFormMarkup($paso){
        $formBody = "";
        switch ($paso) {
            case 1:
                $formBody .= "<label>Genero: </label>";
                $formBody .= "<select name='genero'>";
                foreach ($_SESSION['form']['pasos'][1]['options'] as $opcion) {
                    $formBody .= "<option value='$opcion'>$opcion</option>";
                }
                $formBody .= "</select>";
                break;
            case 2:
                $formBody .= "<label>Musculos: </label>";
                foreach ($_SESSION['form']['pasos'][2]['options'] as $opcion) {
                    $formBody .= "<input type='checkbox' name='musculos[]'value='$opcion'> $opcion <br>";
                }
                break;
            
            default:
                $formBody = "<h1>Paso no valido</h1>";
                break;
        }

        return $formBody;
    }
?>