<?php
echo '<p>Лабораторная работа №5, часть 1</p>';

// Переменные всяких типов


$Float = 0.00001;
$String = 'str';
$Boolean = true;
$Integer = 1337;


$a = 3;
$b = 8;
echo "<p>a = $a, b = $b, a + b = $a + $b<p>";

$String = 'hello';
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
$Array[0] = 'куку';
$Array[1] = 'как';
$Array[2] = 'дела?';
echo "<p>$Array[0] $Array[1] $Array[2]</p>";

$Array = array('я' => 'Денис', 'это' => 'лаба', 'привет' => 'пока');
unset($Array['я']);
var_dump($Array);
echo '<p></p>';

$Array['Человек'] = array('устал' => 'я');
echo $Array['Человек']['устал'];
echo '<p></p>';



// switch case
$test = 90;
echo "оператор switch case: ";
switch($test){
case 20: 
	echo "20";
	break;
case 90: 
	echo "90";
        break;
default: 
	echo "не 20 и не 90";
        break;	
}
echo '<p></p>';




// Циклы
//for

echo "Цикл for:";
for ($i=0; $i<10;$i++) {
	if ($i == 7) continue;
	echo $i;
	}
echo '<p></p>';

//foreach
echo "Цикл foreach:";
$NewArray["1"] = "один";
$NewArray["2"] = "два";
$NewArray["3"] = "три";
foreach ($NewArray as $key => $value) {
echo "<p>$value - $key</p>";
}
echo '<p></p>';


//while
$i = 1;  
echo "Цикл while:";
   while ($i <= 10) {
       echo $i++ ;
	   echo ' ';
   } 
echo '<p></p>';

//dowhile

echo "Цикл do while:";
  do {
    echo $i--; echo' '; 
  } while ($i !=3);
echo '<p></p>';





// Пользовательские функции
echo "Пользовательские функции: ";
function Test1($pl = '.') {
echo "Привет$pl";
}
Test1(' Человек');
echo '<p></p>';

function Test2() {
return true;
}
if (Test2()) echo 'тест2 прошел';
echo '<p></p>';

$a = 1;
function Test3() {
	global $a;
	if ($a == 1) return true;
	else return false;
}

if (Test3()) echo 'тест3 прошел';

echo '<p></p>';

// Сессия
session_start();
$_SESSION['Язык'] = 'PHP';
$_SESSION['машина'] = 'машина - глупая';

#unset($_SESSION['Язык']);
echo $_SESSION['машина'];
?>
