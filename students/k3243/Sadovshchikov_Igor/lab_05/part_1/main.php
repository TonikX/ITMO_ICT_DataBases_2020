<?php

echo "<h2> Типы данных </h2>";

$int_var = 10;
echo "int_var = $int_var <br>";

$float_var = 2.5;
echo "float_var = $float_var <br>";

$string_var = "I am string";
echo "string_var = $string_var <br>";


echo "<h2> Массивы </h2>";

$array_var = array(1, 2, 3, 4);
echo "Массив array_var содержит элементы: <br>";

foreach ($array_var as $i) {
	echo $i, "<br>";
}


echo "<h2> Циклы </h2>";

for ($i = 0; $i < 5; $i++) {
	echo "Цикл for, итерация номер $i <br>";
}

echo "<br>";

foreach ($array_var as $i) {
	echo "Цикл foreach, текущий элемент: $i <br>";
}
echo "<br>";

$i = 0;
while ($i < 5) {
	echo "Цикл while итерация номер $i <br>";
	$i++;
}
echo "<br>";

$i = 0;
do {
		echo "Цикл do-while итерация номер $i <br>";
		$i++;
} while ($i < 5);
echo "<br>";


echo "<h2> Функции </h2>";

echo "Функция find_root() вычисляет корни квадратного уравнения <br>";

function find_root($a, $b, $c){

	$d = 4 * $a * $c;

	if ($d > 0) {

		$root1 = (-$b + sqrt($d)) / ($a * 2);
		$root2 = (-$b - sqrt($d)) / ($a * 2);

		echo "<h3> Дискриминант больше нуля. Два корня: $root1 и $root2 </h3>";
		return array($root1, $root2);

	} elseif ($d == 0) {

		$root1 = -$b / (2 * $a);

		echo "<h3> Дискриминант равен нулю. Один корень: $root1 </h3>";
		return array($root1);

	} else {

		echo "<h3> Корней нет! </h3>";

	}
}

echo "<h3> Вычисляем a+2b+3c=0 </h3>";
find_root(1,2,3);


echo "<h2> Сессии </h2>";

session_start();
$_SESSION['time'] = time();

echo "Время начала сессии: ";
echo date('Y/m/d H:i:s', $_SESSION['time']);

echo "<br><br><br><br><br><br><br><br>"
?>
