<!DOCTYPE html>

<html>

<head>
    <title>Mariia Kuznitsyna</title>
</head>

<body>
    <h1>Airport CRUD</h1>
    <?php
    $pages = array(
        "scripts-6.1.php" => "PHP-скрипт лаба 6.1",
        "license.php" => "Допуски",
        "workers.php" => "Работники",
        "crew.php" => "Экипаж",
        "planes.php" => "Самолёты",
        "flights.php" => "Рейсы"
    );

    $button_style = "
        margin-bottom: 12px;
    ";

    foreach ($pages as $path => $label) {
        echo "
            <div style='$button_style'>
                <a href='$path'>> $label</a>
            </div>
        ";
    }

    ?>
</body>

</html>