<?php 

//Часть 1
echo "переменные различных типов:<br/><br/>";

$boolean = true;
$integer = 200;
$float = 0.001;
$string = 'Текст';

$a = 5;
$b = 6;
$c = $a / $b;

echo "boolean = $boolean<br/> integer = $integer<br/> float = $float<br/> string = $string<br/> a = $a<br/> b = $b<br/> a / b = : $c<br/>";


echo "<br/>массивы:<br/><br/>";
$Array = array('snake' => 'cobra', 'bird' => 'eagle', 'fish' => 'salmon');
echo $Array['snake'];
echo "<br/>";
var_dump($Array);


echo "<br/><br/>условные операторы всех типов:<br/>";

if($a < $b){
	echo 'a меньше b';
}else if($a==$b){
	echo 'a равно b';
}
else{
	echo 'a больше b';
}

echo "<br/>";

switch ($a) {
	case '5':
		echo 'a = 5';
		break;
	case '6':
		echo'a = 6';
	
	default:
		echo 'a не равно 5, 6';
		break;
}

echo "<br/>циклы всех типов:<br/>";

$e = 0;
while ($e <= 3) {
	echo "e = $e<br/>";
	$e++;
}

echo "<br/>";

do {
	echo "e = $e<br/>";
	$e++;
} while ($e <= 10);

echo "<br/>";

for ($i=0; $i < 3; $i++) { 
	echo "i = $i<br/>";
}

echo "<br/>";

foreach ($Array as $key) {
	echo "$key<br/>";
}

echo "<br/>";

echo "<br/>пользовательские функции<br/>";

$d = 10;

function f($d){
	echo "$d в тертьей степени: ", $d * $d * $d, "<br/>";
}
f(3);

echo "<br/>сессии<br/>";

session_start();
$_SESSION['RU'] = 'RUSSIA';
$_SESSION['US'] = 'USA';

echo "<br/>";
echo $_SESSION['RU'];

 ?>