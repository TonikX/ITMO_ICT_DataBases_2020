<?php
	header("Content-Type: text/plain; charset=utf-8");

	// Примеры переменных разных типов данных
	$bool = true;
	echo 'Логический тип ', $bool, "\n";
	$a = 20;
    	$b = 40;
	echo 'Целые числа ', $a, ' ', $b, "\n";
	$double = 0.15;
	echo 'Дробные числа ', $double, "\n";
    	$string = 'first text';
    	$string .= ' and second text';
    	echo $string, "\n";
	$numbers = array(1, 5, 7, 3, 8, 2, 3, 9);


	// Примеры использования условных операторов
	if ($a > $b) {
		echo 'Деление переменной a на переменную b', "\n";
    		$e = $a / $b;
    		echo $e, "\n";
	} elseif ($a < $b) {
		echo 'Деление переменной b на переменную a', "\n";
    		$e = $b / $a;
    		echo $e, "\n";
	} else {
		echo 'a и b равны', "\n";
	}
	
	if ($bool) echo 'Done', "\n";
    	
	
	// Примеры использования циклов
	// Выводит 1 2 3 4 5 6 7 8 9 10
	$x=0;
	while ($x++<10) echo $x, ' ';
	echo "\n";
	
	// Обратный отсчет с 10
	echo 'Обратный отсчет ';
	$x = 10;
	do {
		echo $x, ' ';
	} while ($x-->0);
    	echo "\n";

	// Выводит Пауза.Пауза..Пауза...Пауза....
	for($i=0,$j=0,$k="Пауза"; $i<10; $j++,$i+=$j) { $k=$k."."; echo $k; }
	echo "\n";


	//Пример функции нахождения максимума
	function get_max($arr) 
	{
		if (count($arr) < 0){
			echo "Массив пуст", "\n";
			return Null; 
		}

		$max = $arr[0]; 

		foreach ($arr as $value)
    			if ($value > $max)
				$max = $value; 

    		return $max;
	}
	
	echo get_max(array(6, -54, 0, 346, 7)), "\n";
	echo get_max($numbers), "\n";


	// Пример работы с сессией
	session_start();
	$_SESSION['first_temp'] = "Сессии стали понятнее :)";
?>

