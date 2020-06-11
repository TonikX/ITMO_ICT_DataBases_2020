<?php
	session_start();
	$_SESSION['a'] = "Сессия создана на index.php";

	function func($i, $j){
		return ($i - $j) * $i;
	}

	$a = 1;
	$b = 2.23;
	$c = "Lol";
	$d = True;

	$array = array(
    "group" => "K3240",
    "Name" => "Vlad",
	);

	echo $a, PHP_EOL, $b, PHP_EOL, $c, PHP_EOL, $d, PHP_EOL, "<br/>";

	if ($d){
		echo "d = True <br/>";
	} else {
		echo "d = False <br/>";
	}

	switch ($a) {
		case 1:
			echo "a = 1 <br/>";
			break;
		case 2:
			echo "a = 2 <br/>";
			break;
		default:
			echo "a != {1, 2) <br/>";
			break;
	}

	$i = 0;
	while ($i <= 10) {
		echo "$i <br/>";
		$i++;
	}

	do {
    echo "$i <br/>";
    $i--;
  	} while ($i >= 0);

	for ($i=0; $i<10; $i++) echo $i, PHP_EOL;

	echo "<br/>";

	foreach ($array as $key => $value) {
	echo "$key -> $value <br/>";
	}

	echo func(100, 10);
?>
