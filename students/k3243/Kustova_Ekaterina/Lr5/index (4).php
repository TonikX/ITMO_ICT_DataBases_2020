<?php
$Boolean = true;
$Float = 0.005;
$Integer = 5;
$String = "pine";

$a = 5;
$b = 6;
$c = $a + $b;
echo $c;
echo "<br>";
$m = 4;
$m = $m +10;
echo $m; 
echo "<br>";

//работаем со string - присоединим apple к pine
$String .= "apple,";
echo $String;
echo "<br>";

// условные операторы
if ($a == $b) {
	echo "<br> a = b";

} else if ($b == 6) {echo "<br> =6";
}else { 
echo "<br> a != b";
	}
echo "<br>";
// e - строка
$e = '4';

// проверим равны ли e и m (учитывая тип данных)
if($m === $e) {
	echo "<br> yes";
} else {
echo "<br> no";
}
echo "<br>";

if ($a!= $m) {
	echo "<br> yes";
} else {
	echo "<br> no";
}
echo "<br>";

$test = 10;

switch($test){
case 30 :
echo "<br> nice";
break;

case 10 :
echo "<br> fine";
break;

//когда значение test не соответствует кейсам
default :
echo "<br> it's okay";
break;
}

//массивы

$Array = array("Cobra", "Python", "Viper");
echo "<br>";
echo $Array[1];
echo "<br>";

//ассоциативный массив
$Array1 = array("Band1" => "Iron Maiden", "Band2" => "Metallica", "Band3" => "Depeche Mode");

echo $Array1["Band2"];
echo "<br>";

$Array2["man"] = array("name" => "Dave");
echo $Array2["man"]["name"];
echo "<br>";

//создадим массив и удалим элемент
$Array3 = array("Radiohead", "Nirvana", "Coldplay");
unset($Array3[2]);
var_dump($Array3);
echo "<br>";
//как мы видим, выводится всё кроме удалённого элемента

//циклы

//while
$i = 1; 
while ($i <= 10){
echo $i++;
}
echo "<br>";

//do while
$p = 0;
do{
echo $p;
} while($p > 0);
echo "<br>";

//for
for ($d = 1; $d <= 10; $d++){
echo $d;
}
echo "<br>";

//foreach
$Array4 = array(1, 2, 3);
foreach($Array4 as $value){
echo $value;
}
echo "<br>";

//for с  break
for ($g = 1; $g <= 10; $g++){
if ($g == 5) break;
echo $g;
}
echo "<br>";

//for с continue
for ($g = 1; $g <= 10; $g++){
if ($g == 5) continue;
echo $g;
}
echo "<br>";

//пользовательские функции

function Test1(){
echo "Hello";
}
Test1();
echo "<br>";

function Test2($p1){
echo "Hello $p1";
}
Test2("darkness my old friend");
echo "<br>";

function Test3(){
global $a;
if ($a ==5) return true;
else return false;
}
if(Test3()) echo "123";
echo "<br>";

//создадим сессию
session_start();

$_SESSION["Music"] = "Iron Maiden";
echo $_SESSION["Music"];
//разрушим сессию
$_SESSION = array();
session_destroy();
?> 
