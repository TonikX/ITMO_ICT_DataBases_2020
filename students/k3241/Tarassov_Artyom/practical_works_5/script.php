<?php
	header("Content-Type: text/plain; charset=utf-8");
	session_start();
	$_SESSION['peremennaya'] = "Можно вызвать в другом скрипте, при активной сессии)";

	
	function get_min($arr){
		echo "Пример функции нахождения минимума в массиве \n";
		if (count($arr) < 0){
			echo "Массив пуст :(", "\n";
			return Null; 
		}
		$min = $arr[0];
		foreach ($arr as $val) {
			if ($val < $min){
				$min = $val;
			}
		}
		return $min;
	}
	$int = 10;
    $bool = True;
    $float  = 0.01;
	$s = "Привет)))";

	$a = array($int,
		2,
		"Строка",
		$float,
		$bool,
		"foo" => "bar"
		);	
	echo $a["foo"], "\n";
	
	if($s == "Привет)))"){
		echo "Привет", " - условный оператор)", "\n";
	}
	if($float >= 2){
		echo "Привет", " - условный оператор)", "\n";
	}else{
		echo $float, " < ", 2, " - условный оператор)", "\n";
	}
	
	
	foreach ($a as $b) {
		echo $b, "\n";
	}
	for ($i = 0; $i < 10; $i++) {
		echo $i;
	}
	echo "\n";
	$i = 15;
	while ($i > 10) {
		echo $i--, "\n"; 
	}
	
	echo get_min(array(6, -54, 0, 346, 7));
	
?>	