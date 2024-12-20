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
                if (!empty($_SESSION['form']['pasos'][3]['values'][$value])) {
                    $formBody .= "<label>Peso(" . $value . "): </label>";
                    $formBody .= "<input type='text' required value='" . $_SESSION['form']['pasos'][3]['values'][$value]['peso'] . "' name='pesos[" . $value . "]'> <br>";

                    $formBody .= "<label>Repeticiones(" . $value . "): </label>";
                    $formBody .= "<input type='text' required value='" . $_SESSION['form']['pasos'][3]['values'][$value]['repeticiones'] . "' name='repeticiones[" . $value . "]'> <br>";
                } else {
                    $formBody .= "<label>Peso(" . $value . "): </label>";
                    $formBody .= "<input type='text' required name='pesos[" . $value . "]'> <br>";

                    $formBody .= "<label>Repeticiones(" . $value . "): </label>";
                    $formBody .= "<input type='text' required name='repeticiones[" . $value . "]'> <br>";
                }
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
                    $checked = "";

                    if (!empty($_SESSION['form']['pasos'][4]['values'][$musculo])) {
                        $selecteds = preg_split("[_]", $_SESSION['form']['pasos'][4]['values'][$musculo]);
                        if (in_array($index, $selecteds)) {
                            $checked = "checked";
                        }
                    }

                    $formBody .= "<li>
                        <label for='plan_." . $index . "'>Plan para " . $musculo . " " . ($index + 1) . "</label>
                        <input type='radio'" . $checked . " name='plan[" . $musculo . "]'value='plan_" . $musculo . "_" . $index . "'>";

                    $planes = preg_split("[\\n]", $value);

                    $peso += $peso * ($index / 10);
                    $repeticiones += 1;
                    foreach ($planes as $plan) {
                        $formBody .= "<ul>" . $plan . " con " . $peso . " kg a " .  $repeticiones  . " repeticiones</ul>";
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
            foreach ($_SESSION['form']['pasos'][5]['options'] as $type => $option) {
                if ($type == "file") {
                    $formBody .= '
                    <label for="' . $option . '">Introduce tu ' . $option . '</label>
                    <input type="' . $type . '" required accept =".jpg, .jpeg, .png" name="' . $option . '" id="' . $option . '"></input>';
                } else {
                    $formBody .= '
                    <label for="' . $option . '">Introduce tu ' . $option . '</label>
                    <input type="' . $type . '" required name="' . $option . '" id="' . $option . '"></input>';
                }
            }

            $formBody .= '<br>
                <button type="submit" name="accion" value="atras">Atrás</button>
                <button type="submit" name="accion" value="finalizar">Finalizar</button>';
            break;

        case "final":

            $formBody .= '<table>
                <thead>
                <tr>
                <td>Nombre</td> <td>Foto</td> <td>Email</td>  <td>Plan</td> 
                <tr>
                </thead>
                <tbody>
                <tr>
                    <td>' . $_SESSION['form']['pasos'][5]['users']['nombre'] . '</td> 
                    <td> <img src="./uploads/' . $_SESSION['form']['pasos'][5]['users']['foto'] . '"></td>
                    <td>' . $_SESSION['form']['pasos'][5]['users']['email'] . '</td>
                    <td>';
            var_dump($_SESSION['form']['pasos'][4]['values']);
            foreach ($_SESSION['form']['pasos'][4]['values'] as $key => $value) {
                $formBody .= '<ul>';
                $plan = preg_split("/_/", $value);
                $peso = $_SESSION['form']['pasos'][3]['values'][$plan[1]]['peso'];
                $repeticiones = $_SESSION['form']['pasos'][3]['values'][$plan[1]]['repeticiones'];

                $formBody .= '<li>' . $_SESSION['form']['pasos'][4]['options'][$plan[1]][$plan[2]] . $peso . 'kg' . $repeticiones . ' repeticiones' . '</li>';

                $formBody .= '</ul>';
            }

            $formBody .= '</td>
                </tr>
                </tbody>';

            $formBody .= '</table>';

            $formBody .= '<button type="submit" name="accion" value="reiniciar">Reiniciar</button>
                <button type="submit" name="accion" value="atras">Atrás</button>';
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

function getUserInfoStructure($nombre, $email, $foto)
{
    return array("nombre" => $nombre, "email" => $email, "foto" => $foto);
}


function saveImage()
{
    $done = false;
    var_dump($_FILES['foto']);
    $nombreImg = basename($_FILES['foto']['name']);
    $ruta = "./uploads/";
    $rutaDestino = $ruta . $nombreImg;
    if (move_uploaded_file($_FILES['foto']['tmp_name'], $rutaDestino)) {
        $done = true;
    }

    return $done;
}
