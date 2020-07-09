<?php
    define("tr", "<br />");
    $Boolean = true;

    $a = 5;
    $b = 10;

    echo 'a = '.$a.tr;
    echo 'b = '.$b.tr;
    $c = $a + $b;
    echo 'a + b = c ='.$c.tr;

    $string = "Савнение a и b";
    $string .= tr;
    echo $string;
    if ($a == $b) {
        echo "a равно b".tr;
    } elseif ($a < $b){
        echo "a < b".tr;
    } else {
        echo "a > b".tr;
    }

    $test = 2;
    switch ($test) {
        case 1:
            echo '1'.tr;
            break;
        default:
            echo 'default'.tr;
    }

    $array[0] = 0;
    $array[1] = 1;
    $array[2] = 2;
    $array[3] = 3;
    $array[4] = 4;
    echo "Array {0, 1, 2, 3, 4, 5}".tr;
    echo "Array[2] = ".$array[2];

    $array1 = array('0' => "Ноль", '1' => "Один", '2' => "Два");
    echo " = ".$array1['2'].tr;

    echo "Вывод всех элементов array:".tr;
    $i = 0;
    while ($i < 5) {
        echo $array[$i].' ';
        $i += 1;
    }
    echo tr;

    $i = 0;
    do {
        echo $array[$i].' ';
        $i += 1;
    } while ($i < 5);
    echo tr;

    for ($j = 0; $j < 5; $j++) {
        echo $array[$j].' ';
    }
    echo tr;

    foreach ($array as $value) {
        echo $value.' ';
    }
    echo tr;

    foreach ($array1 as $key => $value) {
        echo "$key - $value".' ';
    }
    echo tr;

    session_start();
    $_SESSION['result'] = "Результат: ";

    echo $_SESSION['result'];
    echo '<a href="/lab_05_1/index2.php">Click</a>';

    ?>
<br><br>
<span><h3>Калькулятор</h3></span>
<form method="POST" action="/lab_05_1/index2.php">
    <div>
        <span>Введите первое число: </span>
        <input type="number" name="a" required>
    </div>
    <br>
    <div>
        <span>Введите второе число: </span>
        <input type="number" name="b" required>
    </div>
    <br>
    <div>
        <span>Выберите действие</span>
        <select size="1" name="operation">
            <option value="0">+</option>
            <option value="1">-</option>
            <option value="2">*</option>
            <option value="3">/</option>
        </select>
    </div>
    <br>
    <input type="submit" name="enter" value="Посчитать">
</form>





