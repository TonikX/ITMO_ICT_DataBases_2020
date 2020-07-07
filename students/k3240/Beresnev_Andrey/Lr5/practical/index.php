<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
        echo "Зачем я это делаю? \r\n";
    ?>
    <br>
    <?php
        session_start();
        $_SESSION['a'] = "Получается сессия";

        function stringsArray($string = 'string', $times = 2) 
        {
            $strings = array();
            for ($i=0; $i < $times; $i++) { 
                $strings[] = $string;
            };

            foreach ($strings as $a) {
                echo $a;
            }
        }   
        stringsArray("brah", 3);
    ?>
    <br>
    <?php
        
        $isActive = true;
        $number = 47;
        $a = "Хромосом";
        
        if ($isActive) {
            echo $number.$a;
        };
    ?>


    <a href="session.php">Проверить сессию</a>
    <a href="close.php">Закрыть сессию</a>
</body>

</html>