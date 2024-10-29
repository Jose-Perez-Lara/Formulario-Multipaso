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
        <button type="submit" name="retroceder" value="retroceder">Atrás</button>
        <button type="submit" name="avanzar" value="avanzar">Siguiente</button>
        <button type="submit" name="finalizar" value="fin">Finalizar</button>
    </form>
</body>
</html>