<html>
<head>
	<meta charset="utf-8">
	<title>Практика</title>
	<style type="text/css">
	body {
		background-color:
	}
	h3 {
		text-align:center
	}
	#back {
		position: absolute; 
		top: 15px; 
		right: 15px; 
	}

	</style>
</head>
<body>

	<h3>Практика</h3>

	<div id="back">
		<form action="index.php">
			<button>Главная страница</button> 
		</form>
	</div>



<?php
	
	//For begining
	echo 'Hello, World!';
	echo"<br>";
	//Математические операторы
	$Boolean = true;
	$Integer = 100;
	$Float = 0.01;
	$String = 'Hello';
	
	$a = 5;
	$b = 5;
	$c = $a + $b; 
	echo $c;
	echo"<br>";
	$a = 5;
	$b = 5;
	$c = $a - $b; 
	echo $c;
	echo"<br>";
	$a = ($b = 4) +5;
	echo $a;
	echo"<br>";
	$a = 10;
	$b =2;
	$c = $a / $b;
	echo $c;
	echo"<br>";
	$a = 10;
	$b = 2;
	$c = $a * $b;
	echo $c;
	echo"<br>";
	
	//Строковые операторы 
	$String .= ' Kitty';
	echo $String;
	echo"<br>";
	
	//Define
	define('You', 0, true);
	echo You;
	echo"<br>";
	
	//Условные операторы
	$a = 228;
	$b = 420;
	
	if ($a == $b) {
		
		echo 'You are GrozaRaiona';
		
	}else {
		
		echo 'Sorry, Bro';
	}
	echo"<br>";
	
	$a = 1;
	$b = 6;
	
	if ($a == $b) echo 'A равно B';
	
	else if ($b == 6) echo 'You got it';
	
	else echo 'Nope';
	echo "<br>";
	
	if($a === $b) echo "<br> yes";
	
	else echo "<br> no"; 
	echo "<br>";
	
	//Switch
	$test = 228;
	
	Switch($test) {
		
		Case 420 : 
		echo 'Brilliant';
		break;
		
		Case 228 : 
		echo 'Cool, my dude!';
		break;
		
		default :
		echo "mEEEEE";
		break;
	}
	echo "<br>";
	//Массивы
	
	$Array[0] = 'Robot';
	$Array[1] = 'Human';
	$Array[2] = 'Elf';
	echo $Array[1];
	echo "<br>";
	
	$Array = array("Robot", "Human", "Elf");
	echo "<br>";
	echo $Array[1];
	echo "<br>";

	$Array1 = array("Machine" => "Robot", "Skin" => "Human", "Pointy_ears" => "Elf");

	echo $Array1["Pointy_ears"];
	echo "<br>";

	$Array2['man'] = array("race" => "Human");
	echo $Array2["man"]["race"];
	echo "<br>";

	$Array3 = array("Robot", "Human", "Elf");
	unset($Array3[2]);
	var_dump($Array3);
	echo "<br>";

	//Циклы
	//WHILE
	$i = 228; 
	while ($i <= 420){
	echo $i++;
	}
	echo "<br>";

	//DO WHILE
	$p = 0;
	do{
	echo $p;
	} while($p > 0);
	echo "<br>";

	//FOR
	for ($d = 1; $d <= 10; $d++){
	echo $d;
	}
	echo "<br>";

	//FOREACH
	$Array4 = array(1, 2, 3);
	foreach($Array4 as $value){
	echo $value;
	}
	echo "<br>";

	//FOR AND BREAK
	for ($g = 1; $g <= 10; $g++){
	if ($g == 5) break;
	echo $g;
	}
	echo "<br>";

	//FOR AND CONTINUE
	for ($g = 1; $g <= 10; $g++){
	if ($g == 5) continue;
	echo $g;
	}
	echo "<br>";

	//Пользовательские функции
	function Test1(){
	echo "Battle for your life";
	}
	Test1();
	echo "<br>";

	function Test2($p1){
	echo "Babylon $p1";
	}
	Test2("Battle for your life");
	echo "<br>";

	$a = 5;
	function Test3(){
	global $a;
	if ($a == 5) return true;
	else return false;
	}
	if(Test3()) echo "911";
	echo "<br>";
	
	//Сессии
	session_start();

	$_SESSION["Race"] = "Human";
	echo $_SESSION["Race"];
	$_SESSION = array();
	session_destroy();
?>