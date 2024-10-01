<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    echo "redireccionando";
    echo '<script type="text/javascript">';
    echo 'window.location.href="/app/views/login.php";';
    echo '</script>';
    exit();
    ?>
</body>
</html>