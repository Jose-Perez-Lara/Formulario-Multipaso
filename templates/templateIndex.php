<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.css">
</head>
<body>
    <form action="index.php" method="post">

        <?php echo $formBody;?>
        <button type="submit" name="accion" value="atras">Atrás</button>
        <button type="submit" name="accion" value="siguiente">Siguiente</button>
        <button type="submit" name="accion" value="finalizar">Finalizar</button>
    </form>
</body>
</html>