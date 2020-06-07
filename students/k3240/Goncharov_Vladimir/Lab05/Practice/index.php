<?php
	session_start();
	$_SESSION['quote'] = "Etiam maximus convallis dui. Praesent.";


	function my_func($a, $b){
		return $a * $b - $a / $b;
	};

	$int_val = 10;
    $bool_val = True;
    $float_val  = 14.88;
	$s_val = "hendrerit";

	$ar = array(
		"foo",
		"bar",
		"ahmat" => "chechnya",
		666
		);	
	echo $ar["ahmat"], PHP_EOL;

	if($bool_val){
		echo "Тру сработало \r\n", PHP_EOL;
	}
	if($float_val < 14.88){
		echo "True";
	}else{
		echo "ne true", PHP_EOL;
	}

	for ($i = 0; $i < 10; $i++) {
		echo $i;
	}

	echo PHP_EOL;

	foreach ($ar as $b) {
		echo $b, PHP_EOL;
	}

	$i = 315;
	while ($i < 322) {
		echo $i++, PHP_EOL; 
	}

	echo my_func(3, 5);

?>