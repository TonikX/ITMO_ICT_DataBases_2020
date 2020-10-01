<?php
	header("Content-Type: text/plain; charset=utf-8");
	session_start();
	$_SESSION ['perm'] = "другой скрипт, другая активная сессия";
	$a = 10;
	$a1 = 2;
	$b = 'sampletext';
	$c = 0.01;
	$d = true;
	
	//мат.операторы
	//математические операторы для демонстрации типов данных
	echo 'Деление переменной a на переменную a1:',"\n";
	$e = $a / $a1;
	echo $e, "\n";
	echo "\n";
	
	//операторы для работы с строковым типом
	echo 'оператор работы с строковым типом .=',"\n";
	$b .= 'forlife';
	echo $b, "\n";
	echo "\n";
	
	//массив
	$array = array(1,$a,$a1,$b, 'цве'=>'точек');
	echo $array['цве'], "\n";
	echo "\n";
	if ($c == 0.01){
		echo 'Я оператор ==', "\n";
		echo "\n";
	}
	elseif ($c<=0.001){
		echo 'Я оператор<=', "\n";
		echo "\n";
	}	
	//цикл
	foreach ($array as $vivod){
		echo $vivod, "\n";
	}
	for ($i=0; $i<5; $i++){
	echo"\n", $i;}
	echo"\n";
	echo"\n";
	$i = 7;
	while ($i > 4) {
		echo $i--, "\n"; 
	}
	echo"\n";
	
	function get_max($arr){
		$max = $arr[0];
		foreach ($arr as $val) {
			if ($val > $max){
			$max = $val;
			}
		}
		return $max;
	}		
	echo"\n";
	echo get_max(array(1, 2,0, -1, 45));
	echo"\n";	
?>