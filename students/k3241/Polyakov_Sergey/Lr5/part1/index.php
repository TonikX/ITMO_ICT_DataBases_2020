<?php
	header("Content-Type: text/plain; charset=utf-8");
	

	// Примеры переменных разных типов данных
	$bool = true;
	echo 'Boolean: ', $bool, "\n";
	$int1 = 1;
	$int2 = 10;
	echo 'Integer: ', $int1, ' ', $int2, "\n";
	$float = 0.15;
	echo 'Float: ', $float, "\n";
	$string = 'first text';
	$string .= ' and second text';
	echo $string, "\n";
	$random_numbers = array(1, 5, 7, 3, 8, 2, 3, 9);


	// Примеры использования условных операторов
	if ($int1 > $int2) echo 'Деление переменной int1 на переменную int2', $int1 / $int2, "\n";
	elseif ($int1 < $int2) echo 'Деление переменной b на переменную int1', $int2 / $int1, "\n";
	else echo 'int1 и int2 равны', "\n";
	
	if ($bool) echo 'Done', "\n";
		
	
	// Примеры использования циклов
	// Выводит 1 2 3 4 5 6 7 8 9 10
	$i=0;
	while ($i++ < 10) echo $i, ' ';
	echo "\n";
	
	// Обратный отсчет с 10
	echo 'Обратный отсчет ';
	$j = 10;
	do {
		echo $j, ' ';
	} while ($j-- > 0);
		echo "\n";

	//Пример функции нахождения сортировки массива
	function my_sort(&$arr) {
		if (count($arr) == 0){
			echo "Массив пуст", "\n";
			return Null; 
		}

		for ($i = 0; $i < count($arr); $i++) {
			for ($j = $i; $j < count($arr); $j++) {
				if ($arr[$i] > $arr[$j]) {
					$temp = $arr[$i];
					$arr[$i] = $arr[$j];
					$arr[$j] = $temp;
				} 
			}
		}
		return Null;
	}

	function print_array($arr) {
		$end = end($arr);
		echo '[';
		foreach ($arr as $value) {
			if ($value != $end) echo $value, ', ';
		}
		echo $end, ']';
	}

	$array = array(6, -54, 0, 346, 7);

	echo 'Array before sorting: ';
	print_array($array);
	echo "\n";

	my_sort($array);

	echo 'Array after sorting: ';
	print_array($array);
	echo "\n";

	// Пример работы с сессией
	session_start();
	$_SESSION['first_temp'] = "First temp for this session";
?>
