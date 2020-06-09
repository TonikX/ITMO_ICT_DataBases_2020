<?php

echo '<p>Лабораторная работа №5, часть 1(практикум)</p>';


// Переменные различных типов

$Boolean = true;
$Integer = 10;
$Float = 0.001;
$String = 'Text';

$a = 5;
$b = 5;
$c = $a + $b;
echo "<p>a = 5, b = 5, a + b = $c<p>";
$a = ($b = 4) + 5;
echo "<p> a = (b = 4) + 5 = $a</p>";

$String = 't';
$String .= 'he';
echo "<p>Операции со строками $String</p>";

define('TEST', 123);
echo "<p>TEST</p>";  


//Условные операторы

// if

$a = 1;
$b = 6;
echo "Условный оператор if: ";
if($a === $b) echo 'A равно Б </p>';
elseif ($b == 6) echo 'Б = 6</p>';
else echo 'A не равно Б</p>';

// switch case
$test = 40;
echo "Условный оператор switch case: ";
switch($test){
case 30: 
	echo "30";
	break;
case 10: 
	echo "10";
        break;
default: 
	echo "Все нормально";
        break;	
}
echo '<p></p>';


// Массивы
echo "Операции с массивами: ";
$Array[0] = 'Кобра';
$Array[1] = 'Питон';
$Array[2] = 'Гадюка';
echo "<p>$Array[0]</p>";

$Array = array('Фрукт1' => 'Апельсин', 'Фрукт2' => 'Лимон', 'Фрукт3' => 'Яблоко');
unset($Array['Фрукт2']);
var_dump($Array);
echo '<p></p>';

$Array['Человек'] = array('имя' => 'Вася');
echo $Array['Человек']['имя'];
echo '<p></p>';


// Циклы

//while
$i = 1;  
echo "Цикл while:";
   while ($i <= 10) {
       echo "$i";
   $i++; 
   } 
echo '<p></p>';

//dowhile

$i = 1;  
echo "Цикл do while:";
  do {
    echo "$i";
     
    $i++;
  } while ($i  <= 5);
echo '<p></p>';

//for
echo "Цикл for:";
for ($x=0; $x<10; $x++) {
	if ($x == 5) continue;
	echo $x;
	}
echo '<p></p>';

//foreach
echo "Цикл foreach:";
$capitals["Россия"] = "Москва";
$capitals["Украина"] = "Киев";
$capitals["Беларусь"] = "Минск";
$capitals["Казахстан"] = "Астана";
foreach ($capitals as $key => $value) {
echo "<p>$value - $key</p>";
}
echo '<p></p>';


// Пользовательские функции
echo "Пользовательские функции: ";
function Test1($pl = '.') {
echo "Привет$pl";
}
Test1('!');

function Test2() {
return true;
}
if (Test2()) echo '123';

$a = 100;
function Test3() {
	global $a;
	if ($a == 100) return true;
	else return false;
}

if (Test3()) echo '123';

echo '<p></p>';

// Сессия
session_start();
$_SESSION['Язык'] = 'PHP';
$_SESSION['Я'] = 'Человек';

unset($_SESSION['Я']);

echo $_SESSION['Язык'];

?>