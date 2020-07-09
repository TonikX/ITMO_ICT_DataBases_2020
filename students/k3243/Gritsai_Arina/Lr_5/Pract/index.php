<?php
    echo "<h1>my first php script</h1>";
    echo "<h2>the main page </h2>";
    
    // начало сессии: обозначим переменные username и role

    session_start();

    $_SESSION['username'] = 'arinagritsai';
    $_SESSION['role'] = 'admin';
    
    echo "<br/>" . "username: " . $_SESSION['username'] . "<br/>";
    echo "role: " . $_SESSION['role'] . "<br/>";
    
    // создадим и напечатаем массив

    $animals = array("dog", "cat", "rabbit");

    echo "<br/>" . "fluffy animals:  " . $animals[0] . ", " . $animals[1] . " and " . $animals[2] . "<br/>";
    
    // цикл while

    $number = 5;
    echo "<br/>" . "number before \"while\": " . $number;

    while ($number > 0){
        $number--;
    };

    echo "<br/>" . "number after \"while\": " . $number . "<br/>";
    
    // цикл do-while

    do {
        $number++;
    } while ($number < 100);

    echo "<br/>" . "same variable after \"do-while\": " . $number . "<br/>";
    
    // пустой массив заполняется числами циклом for

    $numbers = array();
    for ($i = 10; $i > 0; $i--){
        $numbers[$i] = $i;
    }
    
    // вывод полученного массив циклом foreach

    echo "<br/>" . "new array: ";

    foreach ($numbers as $value){
        echo $value . "\n";
    }

    echo "<br/>";
    
    // пользовательская функция - выбор подарка

    function choose_present($present){

    switch ($present){
    case "flowers":
        echo "\n nice one!";
        break;
    case "chocolate":
        echo "\n yummee!";
        break;
    case "pet":
        echo "\n wow surprizing!";
        break;
    default:
        echo "\n please choose something else";
    }
    }
        
    $present = "flowers";
    echo "<br/>" . "chosen present: " . $present . "<br/>";
    choose_present($present);
    echo "<br/>";

    $present = "chocolate";
    echo "<br/>" . "chosen present: " . $present . "<br/>";
    choose_present($present);
    echo "<br/>";

    $present = "pet";
    echo "<br/>" . "chosen present: " . $present . "<br/>";
    choose_present($present);
    echo "<br/>";
    
    // пользовательская функция - вычитание из большего меньшее

    function subtractif()
    {
        global $c, $d, $e;
        
        if ($c > $d)
        {
            echo "<br/>" . "c - d = " . $e = $c - $d ."<br/>";
        }
        else if($c < $d)
        {
            echo "<br/>" . "d - c = " . $e = $d - $c . "<br/>";
        }
    }


    echo "<br/>" . "set c = 30, d = 10 " . "<br/>";
    $c = 30;
    $d = 10;

    echo "<br/>" . "subtract result: ";
    subtractif();

    echo "<br/>" . "now c = 9.0, d = 15.3 " . "<br/>";
    $c = 9.0;
    $d = 15.3;

    echo "<br/>" . "subtract result: ";
    subtractif();

?>
