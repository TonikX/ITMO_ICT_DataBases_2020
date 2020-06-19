<?php

echo "<h1>my first php script</h1>";
echo "<h2>the main page </h2>";
    
// начало сессии: обозначим переменные username и role

session_start();

$_SESSION['username'] = 'spiritofsofya';
$_SESSION['role'] = 'admin';

echo "<br/>" . "username: " . $_SESSION['username'] . "<br/>";
echo "role: " . $_SESSION['role'] . "<br/>";

// создадим и напечатаем массив 

$vegetables = array("tomatoes", "potatoes", "eggplants");

echo "<br/>" . "my favorite vegetables:  " . $vegetables[0] . ", " . $vegetables[1] . " and " . $vegetables[2] . " :) " . "<br/>"; 

// пример цикла while

$number = 10;
echo "<br/>" . "variable number before \"while\" cycle: " . $number;

while ($number > 0){
    $number--;
};

echo "<br/>" . "variable number after \"while\" cycle: " . $number . "<br/>";

// пример цикла do-while

do {
    $number++;
} while ($number < 10);

echo "<br/>" . "the same variable after \"do-while\" cycle: " . $number . "<br/>";

// создадим пустой массив, наполним числами с помощью цикла for

$numbers = array();
for ($i = 0; $i < 10; $i++){
    $numbers[$i] = $i;
}

// печать полученного массива с помощью цикла foreach

echo "<br/>" . "new array: ";

foreach ($numbers as $value){
    echo $value . "\n";
}

echo "<br/>";

// пользовательская функция - похвалить питомца

function give_praise($animal){

switch ($animal){
case "dog":
    echo "\ngood doggie!";
    break;
case "cat":
    echo "\nwhat a handsome lil cat!";
    break;
case "hamster":
    echo "\ncute cheeks!";
    break;
default:
    echo "\nplease choose another pet";
}
}
    
$pet = "dog";
echo "<br/>" . "chosen pet: " . $pet . "<br/>";
give_praise($pet);
echo "<br/>";

$pet = "cat";
echo "<br/>" . "chosen pet: " . $pet . "<br/>";
give_praise($pet);
echo "<br/>";

$pet = "hamster";
echo "<br/>" . "chosen pet: " . $pet . "<br/>";
give_praise($pet);
echo "<br/>";

// пользовательская функция - сравнение чисел

function evaluate()
{
    global $a, $b;
    
    if ($a > $b)
    {
    echo "<br/>" . "a > b " . "<br/>";
    }
    else if ($a == $b)
    {
    echo "<br/>" . "a == b " . "<br/>";
    }
    else
    {
    echo "<br/>" . "a < b " . "<br/>";
    }
} 


echo "<br/>" . "set a = 15, b = 30 " . "<br/>";
$a = 15;
$b = 30;

echo "<br/>" . "evaluation result: ";
evaluate();

echo "<br/>" . "now a = 6.0, b = 5.9 " . "<br/>";
$a = 6.0;
$b = 5.9;

echo "<br/>" . "evaluation result: ";
evaluate();

echo "<br/>" . "now a = b " . "<br/>";
$a = $b;

echo "<br/>" . "evaluation result: ";
evaluate();






