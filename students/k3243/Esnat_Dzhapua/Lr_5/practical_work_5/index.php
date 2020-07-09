<?php

#переменных различных типов

$int = 100;
$float = 100.001;
$string = 'hello world';
$boolean = true;

$string .= '!!!!!!';
$int += 100;
echo "$int , $float , $string , $boolean <br/>";

#массивов

$array = array('Фрукт1' => 'Апельсин', 'Фрукт2' => 'Лимон', 'Фрукт3' => 'Яблоко');
echo $array['Фрукт2'].'<br/><br/>';

unset($array['Фрукт2']);
var_dump($array);

#условных операторов всех типов

$a = 10;

if ($a == 20) echo 'Wrong';
elseif ($a == 30) echo 'Wrong';
else {
	echo '<br/><br/>Right<br/>';
	$a += 10;
}

switch ($a){

case 10:
	echo 'Wrong';
	break;

case 30:
	echo 'Wrong';
	break;

default:
	echo 'Right again<br/><br/>';
	break;
}

#циклов всех типов

$b = 0;
while ($b != 10){
	$b++;
	echo "$b ";
}

echo '<br/>';

do {
	echo "$b ";
	$b--;

} while ($b > 0);

echo '<br/>';

for ($c = 1; $c <= 100; $c++){
	if ($c % 2 == 0) continue;
	echo "$c ";
	if ($c == 51) break;
}

echo '<br/><br/>';

$newarray = array('Один ' => 1, 'Два ' => 2, 'Три ' => 3, 'Четыре ' => 4, 'Пять ' => 5);

foreach ($newarray as $key => $value){
	echo "$key $value <br/>";
}

echo '<br/><br/>';

#пользовательских функций

function test1($p1){
	echo "hello $p1";
}

test1('world');

echo '<br/><br/>';

function test2($p1){
	$a = $p1 ** $p1;
	return $a;
}

echo test2(5);

#сессий

session_start();

$_SESSION ['Язык'] = 'PHP';
$_SESSION ['Я'] = 'Человек';

?>