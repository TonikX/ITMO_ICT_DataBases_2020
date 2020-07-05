<?php
	
//Переменные различных типов:
$Boolean = true;
$Integer = 100;
$Float = 0.0001;
$String = ';)';


//Условные операторы:
$a = 1;
$b = '2';

if ($a != $b){ 
	if ($a < $b) echo 'a < b;';
	elseif ($a > $b) echo 'a > b;';
	}

$a1 = '3';
$b1 = '3';

if ($a1 <= $b1){
	if ($a1 == $b1) echo '<br> a1 = b1;';
	elseif ($a1 < $b1) echo '<br> a1 < b1;';
	}

elseif ($a1 >= $b1){
	if ($a1 == $b1) echo '<br> a1 = b1;';
	elseif ($a1 > $b1) echo '<br>  a > b;';
	}

$yes = false;

if (!$yes) echo '<br> это ложь. ';
else echo '<br> это истина. ';

$normal = 3;

switch($normal){

case 1:
echo '<br> ужасно';
break;

case 2:
echo '<br> нормально';
break;

case 3:
echo '<br> это потрясающе ';
break;
}


//Массивы:
$Array['Фильм'] = array('НАЗВАНИЕ' => '"Доктор Стрендж"', 'АКТЕР' => 'Бенедикт Камбербэтч', 'ГОД' => '2016', 'лишнее' => 'you');
unset($Array['Фильм']['лишнее']);
echo "<br>";
echo $Array['Фильм']['АКТЕР'];


//Циклы:
foreach ($Array['Фильм'] as $key => $value){
	echo "<br>$key : $value"; 
}

echo "<br>";
for ($i = 1; $i <= 5; $i++){
if ($i == 2) continue;
echo $i;
}

$i = 0;
do {
echo "<br>$i";}
while($i > 0);


//Пользовательские функции:
function Test(){

global $Array; 
echo "<br>";
echo $Array['Фильм']['АКТЕР'];
}

Test();


//Сессии:
session_start();
	$_SESSION['динозавр'] = "птеродактиль";
?>

