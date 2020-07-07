<?php
echo "<br/>- Переменные различных типов<br/>";
$num1 = 555;
$num2 = 3.7;
$str = "IMadeThisString";
$arr = array('68', 'elem 2', 'elem 3', 'echo');
echo "num1 = $num1, <br/> num2 = $num2, <br/> str = $str <br/>";


echo "<br/>- Массивы<br/>";
echo "Элементы массива: ";
for ($i = 0; $i < sizeof($arr); $i++) {
	echo $arr[$i], ", ";
} echo "<br/>";


echo "<br/>- Условные операторы всех типов<br/>";
if ($num1 < $num2) {
	echo "$num1 < $num2 <br/>";
}elseif ($num1 > $num2){
	echo "$num1 > $num2 <br/>";
}else{
	echo "$num1 = $num2 <br/>";
}


echo "<br/>- Циклы всех типов<br/>";
while ($num1 > 0) {
	$num1-=10;
	echo $num1, ", ";
}
echo "<br/>";
do {
	$num1+=15;
	echo $num1, ", ";
} while ($num1 < 150);
echo "<br/>";
foreach ($arr as $val) {
	echo $val, ", ";
} echo "<br/>";
for ($i = 0; $i < sizeof($arr); $i++) {
	if ($arr[$i] == 'hit'){
		echo "BREAK!";
		break;
	} elseif ($arr[$i] == '808'){
		continue;
	}
	echo $arr[$i], ", ";
} echo "<br/>";


echo "<br/>- Пользовательске функции<br/>";
function Square($a){
	echo "Квадрат $a: ", $a*=$a, "<br/>";
}
Square(10);
Square(99);
echo "<br/>";


echo "<br/>- Сессии<br/>";
session_start();
$_SESSION['Время'] = time();
echo "Время сессии: ";
echo date('Y m d H:i:s', $_SESSION['Время']);
echo "<br/>";
?>
 <a href = 'index.php'>Главная страница</a> 
