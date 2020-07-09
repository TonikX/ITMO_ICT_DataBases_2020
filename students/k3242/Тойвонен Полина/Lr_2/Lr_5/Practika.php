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


	echo 'Hello, World!';
	echo"<br>";

	//Математические операторы
	$Boolean = true;
	$Integer = 100;
	$Float = 0.01;
	$String = 'Hello';

	$a = 9;
	$b = 9;
	$c = $a + $b; 
	echo $c;
	echo"<br>";
	$a = 9;
	$b = 9;
	$c = $a - $b; 
	echo $c;
	echo"<br>";
	$a = ($b = 5) +7;
	echo $a;
	echo"<br>";
	$a = 15;
	$b =3;
	$c = $a / $b;
	echo $c;
	echo"<br>";
	$a = 9;
	$b = 6;
	$c = $a * $b;
	echo $c;
	echo"<br>";

	//Строковые операторы 
	$String .= ' Hello';
	echo $String;
	echo"<br>";

	//Define
	define('Me', 0, true);
	echo You;
	echo"<br>";

	//Условные операторы
	$a = 156;
	$b = 980;

	if ($a == $b) {

		echo 'Smart cookie';

	}else {

		echo 'Flimflam';
	}
	echo"<br>";

	$a = 4;
	$b = 10;

	if ($a == $b) echo 'A равно B';

	else if ($b == 10) echo 'Got it';

	else echo 'Nope:(';
	echo "<br>";

	if($a === $b) echo "<br> yes";

	else echo "<br> no"; 
	echo "<br>";

	//Switch
	$test = 598;

	Switch($test) {

		Case 420 : 
		echo 'Amazing';
		break;

		Case 598 : 
		echo 'Cool!';
		break;

		default :
		echo "PERIODT";
		break;
	}
	echo "<br>";

	//Массивы

	$Array[0] = 'Student';
	$Array[1] = 'Teacher';
	$Array[2] = 'Decanat';
	echo $Array[1];
	echo "<br>";

	$Array = array("Student", "Teacher", "Decanat");
	echo "<br>";
	echo $Array[1];
	echo "<br>";

	$Array1 = array("Tired" => "Student", "Lab" => "Teacher", "Documents" => "Decanat");

	echo $Array1["Lab"];
	echo "<br>";

	$Array2['Uni'] = array("walking" => "Srudent");
	echo $Array2["Uni"]["walking"];
	echo "<br>";

	$Array3 = array("Teacher", "Student", "Decanat");
	unset($Array3[2]);
	var_dump($Array3);
	echo "<br>";

	//Циклы
	//WHILE
	$i = 698; 
	while ($i <= 900){
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
	for ($c = 1; $c <= 10; $c++){
	echo $c;
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
	echo "Thats the way the cookie crumbles";
	}
	Test1();
	echo "<br>";

	function Test2($p1){
	echo "Bosh, $p1";
	}
	Test2("Thats the way the cookie crumbles");
	echo "<br>";

	$a = 5;
	function Test3(){
	global $a;
	if ($a == 5) return true;
	else return false;
	}
	if(Test3()) echo "Same old";
	echo "<br>";

	//Сессии
	session_start();

	$_SESSION["Walking"] = "Student";
	echo $_SESSION["Walking"];
	$_SESSION = array();
	session_destroy();
?> 