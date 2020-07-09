<?php
echo '<p>Лабораторная работа №5, часть 1(практикум)</p>';

// Переменные всяких типов


$Float = 0.00001;
$String = 'str';
$Boolean = true;
$Integer = 1230;


$a = 5;
$b = 5;
echo "<p>a = $a, b = $b, a + b = $a + $b<p>";

$String = 'hellow';
$String .= ' world!';
echo "<p>Операции со строками $String</p>";



//Условные операторы

// if

$a = 6;
$b = 6;
echo "Условный оператор if: ";
if($a === $b) echo 'A равно Б </p>';
elseif ($b == 6) echo 'Б = 6</p>';
else echo 'A не равно Б</p>';

// Массивы
echo "Операции с массивами: ";
$Array[0] = 'я';
$Array[1] = 'не люблю';
$Array[2] = 'php';
echo "<p>$Array[0] $Array[1] $Array[2]</p>";

$Array = array('ягодна' => 'арбуз', 'лимон' => 'миллион', 'картина' => 'маслом');
unset($Array['лимон']);
var_dump($Array);
echo '<p></p>';

$Array['Человек'] = array('Жаба' => 'Вася');
echo $Array['Человек']['Жаба'];
echo '<p></p>';



// switch case
$test = 90;
echo "оператор switch case: ";
switch($test){
case 20: 
	echo "30";
	break;
case 90: 
	echo "90";
        break;
default: 
	echo "не попал";
        break;	
}
echo '<p></p>';




// Циклы
//for

echo "Цикл for:";
for ($i=0; $i<10;$i++) {
	if ($i == 8) continue;
	echo $i;
	}
echo '<p></p>';

//foreach
echo "Цикл foreach:";
$associations["телефон"] = "в руке";
$associations["еда"] = "в рот";
$associations["сало"] = ")0)0))";
foreach ($associations as $key => $value) {
echo "<p>$value - $key</p>";
}
echo '<p></p>';


//while
$i = 1;  
echo "Цикл while:";
   while ($i <= 12) {
       echo $i++ ;
	   echo ' ';
   } 
echo '<p></p>';

//dowhile

echo "Цикл do while:";
  do {
    echo $i--; echo' '; 
  } while ($i !=0);
echo '<p></p>';





// Пользовательские функции
echo "Пользовательские функции: ";
function Test1($pl = '.') {
echo "Привет$pl";
}
Test1(' Вася');

function Test2() {
return true;
}
if (Test2()) echo 'тест прошел';

$a = 1;
function Test3() {
	global $a;
	if ($a == 1) return true;
	else return false;
}

if (Test3()) echo '123';

echo '<p></p>';

// Сессия
session_start();
$_SESSION['Язык'] = 'английский';
$_SESSION['машина'] = 'обучение';

unset($_SESSION['Язык']);

echo $_SESSION['машина'];
?>
