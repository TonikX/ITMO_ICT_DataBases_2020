<?php

$Boolean = true;
$Float = 0.5;
$Integer = 7;
$String = 'laba';

echo $String; 
echo '<br>';
echo $Float;

$a = 10;
$b = 5;
$c = $a + $b;
echo '<br> 10 + 5 = ';
echo $c;

$String .= ' code';
echo '<br>';
echo $String;
echo '<p>';

if ($a == $b) {
	echo 'A = B';
} else if ($a *2 == $b) {
	echo '2A = B';
} else {
	echo 'A и В не равны';
}

echo '<p>';

if ($a == $b) {
	echo 'A = B';
} else if ($b *2 == $a) {
	echo '2B = A';
} else {
	echo 'A и В не равны';
}

echo '<p>';

$test = 15;

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
$Array[0] = 'Google Chrome';
$Array[1] = 'Internet Explorer';
$Array[2] = 'Mozila Firefox';

echo $Array[2];
echo '<br>';
$Array[] = 'Google Chrome';
$Array[] = 'Internet Explorer';
$Array[] = 'Mozila Firefox';

echo $Array[1];
echo '<p>';

$Array1 = array('Спорт1' => 'Футбол', 'Спорт2' => 'Баскетбол', 'Спорт3' => 'Волейбол');
echo 'На физкультуре будут играть в ';
echo $Array1['Спорт2'];
echo '<br>';

$Array2 = array('Ельцин', 'Путин', 'Медведев');
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

$Array3 = array('Значение 1' => 5, 'Значение 2'=> 10, 'Значение 3' => 15);

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
Test1('Филипп');

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

define ('HELLO', 'FILIPP');
function Test3() {
	echo HELLO;
}
Test3();
echo '<p>';
echo 'Сессии ON!';
echo '<p>';

session_start();
$_SESSION['President'] = 'Putin';
$_SESSION['USA-President'] = 'Trump';
echo $_SESSION['President'];

$_SESSION = array ();
session_destroy();
?>
