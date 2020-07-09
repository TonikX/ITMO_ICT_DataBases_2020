<?php

echo '<p><b>Практическая часть</b></p>';

$integer = 1;
$float = 1.1;
$string = "Приветики";
$boolean = True;

$num_arr = ['Zero', 'One', 'Two'];
for ($i=0; $i < count($num_arr); $i++) { 
	echo "$i: $num_arr[$i]<br>";
}

$a = 1;
$b = 5;
echo '<p><b>Условный оператор if:</b></p>';
if($a === $b) echo 'A равно Б';
elseif ($b == 5) echo 'Б = 6';
else echo 'A не равно Б';

$i = 1;  
echo '<p><b>Цикл while:</b></p>';
   while ($i <= 10) {
       echo "$i";
   $i++; 
   }

echo '<p><b>Цикл do while:</b></p>';
do {
	echo "$i";
 	$i++;
   }
while ($i  <= 10);

echo '<p><b>Цикл for:</b></p>';
for ($x = 0; $x<10; $x++) {
	if ($x == 7) continue;
	echo $x;
	}

echo '<p><b>Цикл foreach:</b></p>';
$capitals["Латвия"] = "Рига";
$capitals["Россия"] = "Москва";
$capitals["Финляндия"] = "Хельсинки";
$capitals["Германия"] = "Берлин";
foreach ($capitals as $key => $value) {
   echo "<p>$value - $key</p>";
   }

$array[]=1;
$array[]=2;
$array[]=10;
$array[]=4;
$array[]=5;
echo '<p><b>Элементы массива:</b></p>', "\n";
for ($q=0; $q<=4; $q++) {
   echo $arr[$q]." ";
   }
function find_max($arr){
echo '<p><b>Находим максимум в массиве:</b></p>';
if (count($array) < 0){
	echo "Нет элементов", "\n";
	return 0;
}
$max = -INF;
foreach ($array as $a){
	if ($a > $max){
		$max = $a;
	}
}

session_start();
$_SESSION['name'] = 'Filips';
echo($_SESSION['name']);
unset($_SESSION['name']);
session_destroy();

?>