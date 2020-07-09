<?php

$Boolean = true;
$Float = 0.07;
$Integer = 46;
$String = 'php';

$a = 20;
$b = 3;
$c = $a - $b;
echo $c;
echo "<br>";

$String .= " code";
echo $String;
echo "<br>";

if ($a == $b) echo 'А равно Б';
else if ($b == 8) echo 'b = 8';
else echo 'А не равно Б';
echo "<br>";

$test = 5;

switch($test){
case 20 :
echo "значение переменной - 20";
break;

case 10 :
echo "значение переменной - 10";
break;

default :
echo "значение переменной - не 20 и не 10";
break;
}

// массивы
echo "<br>";
$Array[0] = 'C#';
$Array[1] = 'C++';
$Array[2] = 'Python';

echo $Array[2];
echo "<br>";

$Array1 = array('season1' => 'Summer', 'season2' => 'Spring', 'season3' => 'Autumn', 'season4' => 'Winter');
echo $Array1['season2'];
echo "<br>";

$Array2['cat'] = array('colour' => 'red');
echo $Array2['cat']['colour'];
echo "<br>";

$Array3 = array('Summer', 'Spring', 'Autumn', 'Winter');
unset($Array3[3]);
var_dump($Array3);
echo "<br>";

//циклы
$i = 10;
while($i <= 20) echo $i++;
echo "<br>";

$k = 5;
do {
echo $k;
} while($k > 5);
echo "<br>";

for ($io = 1; $io <= 10; $io++){
if ($io == 6) continue;
echo $io;
}
echo "<br>";

foreach($Array1 as $key => $value){
echo "<br> $key: $value";
}
echo "<br>";

//user functions
function test1($p1){
echo"hello $p1";
}

test1('everyone');
echo "<br>";

function test2(){
global $a;
if ($a == 20) return true;
else return false;
}
if ( test2()) echo 'something';
echo "<br>";

function test3(){
function t(){
echo 'hhhh';
}
echo 'bbbb';
}

test3();
t();
echo"<br>";

//sessions
session_start();
$_SESSION['flower'] = 'hyacinth';
echo $_SESSION['flower'];

$_SESSION = array ();
session_destroy();
?>