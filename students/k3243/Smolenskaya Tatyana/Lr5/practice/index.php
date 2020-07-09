<?php

$Boolean = true;
$Float = 0.5;
$Integer = 7;
$String = 'laba';

echo $String; 
echo '<br>';
echo $Float;

$a = 15;
$b = 5;
$c = $a + $b;
echo '<br> 15 + 5 = ';
echo $c;

$String .= ' code';
echo '<br>';
echo $String;
echo '<p>';

if ($a == $b) {
	echo 'A = B';
} else {
	echo 'A и В не равны';
}

echo '<p>';

$test = 20;

switch($test){
case 30 :
echo "значение переменной = 30";
break;

case 10 :
echo "значение переменной = 10";
break;

default :
echo "значение переменной не равно 30 и 10";
break;
}

echo '<br>';
$Array[0] = 'k3241';
$Array[1] = 'k3242';
$Array[2] = 'k3243';

echo $Array[2];
echo '<br>';
$Array[] = 'k3241';
$Array[] = 'k3242';
$Array[] = 'k3243';

echo $Array[1];
echo '<p>';

$Array1 = array('Фрукт1' => 'Яблоко', 'Фрукт2' => 'Банан', 'Фрукт3' => 'Апельсин');
echo 'На завтрак будет ';
echo $Array1['Фрукт2'];
echo '<br>';

$Array2 = array('Информатика', 'Физика', 'Химия');
unset($Array2[2]);
echo $Array2[1];
echo '<br>';
var_dump($Array2);
echo '<br>';

$i = 2;
while($i <= 10) {
	echo $i++;
}
echo '<br>';

$k = 10;
do {
echo $k++;
} while($k < 10);
echo '<p>';

for ($i = 10; $i <= 12; $i++) {
	echo $i;
	echo '<br>';
}
echo '<p>';

$Array3 = array('Значение 1' => 10, 'Значение 2'=> 15, 'Значение 3' => 20);

foreach($Array3 as $key => $value) {
	echo "<br>Ключ: $key: $value";
}

echo '<p>';

for ($i = 2; $i <= 10; $i++) {
	if ($i == 5) continue;
	echo $i;
}
echo '<p>';
for ($i = 2; $i <= 10; $i++) {
	if ($i == 7) break;
	echo $i;
}
echo '<p>';

echo 'Функции ON';
echo '<p>';

function Test1($p1 = '7') {
	echo "Привет, $p1";	
}

Test1();
echo '<br>';
Test1('Татьяна');

function test2(){
	global $a;
	if ($a == 10) {
		return true;
	} else {
		return false;
	}
} echo '<br>';
if ( test2()) {
	echo 'ten';
}
echo '<br>';

define ('HELLO', 'Tatiana');
function Test3() {
	echo HELLO;
}
Test3();
echo '<p>';
echo 'Сессии ON!';
echo '<p>';

session_start();
$_SESSION['Flowers'] = 'Tulpan';
$_SESSION['Wild-Flowers'] = 'Romashka';
echo $_SESSION['Flowers'];

$_SESSION = array ();
session_destroy();
?>
