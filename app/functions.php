<?php
function getFormMarkup($paso)
{
    $formBody = "";
    switch ($paso) {
        case 1:
            $formBody .= "<label>Genero: </label>";
            $formBody .= "<select name='genero'>";
            foreach ($_SESSION['form']['pasos'][1]['options'] as $opcion) {
                $formBody .= "<option value='$opcion'>$opcion</option>";
            }
            $formBody .= "</select>";

            $formBody .= '<button type="submit" name="accion" value="siguiente">Siguiente</button>';
            break;
        case 2:
            $formBody .= "<label>Musculos: </label>";
            foreach ($_SESSION['form']['pasos'][2]['options'] as $opcion) {

                if (in_array($opcion, $_SESSION['form']['pasos'][2]['values'])) {
                    $formBody .= "<input type='checkbox' checked name='musculos[]'value='$opcion'> $opcion <br>";
                } else {
                    $formBody .= "<input type='checkbox' name='musculos[]'value='$opcion'> $opcion <br>";
                }
            }
            $formBody .= '
                <button type="submit" name="accion" value="atras">Atrás</button>
                <button type="submit" name="accion" value="siguiente">Siguiente</button>';
            break;
        case 3:
            foreach ($_SESSION['form']['pasos'][2]['values'] as $value) {
                $formBody .= "<label>Peso(" . $value . "): </label>";
                $formBody .= "<input type='text' name='pesos[" . $value . "]'> <br>";

                $formBody .= "<label>Repeticiones(" . $value . "): </label>";
                $formBody .= "<input type='text' name='repeticiones[" . $value . "]'> <br>";
            }


            $formBody .= '
                <button type="submit" name="accion" value="atras">Atrás</button>
                <button type="submit" name="accion" value="siguiente">Siguiente</button>';
            break;
        case 4:

            foreach ($_SESSION['form']['pasos'][2]['values'] as $musculo) {
                $formBody .= "<ul>";

                $peso = $_SESSION['form']['pasos'][3]['values'][$musculo]['peso'];
                $repeticiones = $_SESSION['form']['pasos'][3]['values'][$musculo]['repeticiones'];


                foreach ($_SESSION['form']['pasos'][4]['options'][$musculo] as $index => $value) {
                    $formBody .= "<li>
                    <label for='plan_." . $index . "'>Plan para " . $musculo . " " . ($index + 1) . "</label>
                    <input type='radio' name='plan_" . $musculo . "' id='plan_" . $index . "' value='plan_" . $musculo . "_" . $index . "'>";

                    $planes = preg_split("[\\n]", $value);
                    foreach ($planes as $plan) {
                        $formBody .= "<ul>" . $plan . " con " . $peso . " kg a " . $repeticiones . " repeticiones</ul>";
                    }


                    $formBody .= "</li>";
                }

                $formBody .= "</ul>";
            }
            $formBody .= '
                <button type="submit" name="accion" value="atras">Atrás</button>
                <button type="submit" name="accion" value="siguiente">Siguiente</button>';
            break;
        case 5:
            $formBody .= '<label for="nombre">Introduce tu nombre</label>
            <input type="text" name="nombre" id="nombre"></input>';

            $formBody .= '
                <button type="submit" name="accion" value="atras">Atrás</button>
                <button type="submit" name="accion" value="finalizar">Finalizar</button>';
            break;

        default:
            $formBody = "<h1>Paso no valido</h1>";
            break;
    }

    return $formBody;
}


function joinPesoYRepes($pesos, $repes)
{
    $finalArray = array();

    foreach ($pesos as $key => $value) {
        $tempArray = ['peso' => $value, 'repeticiones' => $repes[$key]];
        $finalArray[$key] = $tempArray;
    }
    return $finalArray;
}
