<?php
session_start();
$_SESSION['Сессия'] = "Старт сессии";

echo '<p>К3240 Ермакова Анна</p>';


$boo = true;
$int = 1;
$float = 0.001;
$str = "текст";
$array = array("Какой","-","либо","текст");

if ($boo){
    echo "Какой-либо текст <br>";
}
else{
    echo "Другой какой-либо текст <br><br>";
}

switch ($str)
{
    case "текст":
        echo "Это наш текст <br>";
        break;
    case "другой текст":
        echo "Это другой текст <br>";
        break;
    default:
	echo "Это не наш и не другой текст <br>";
}

for ($i = 0; $i < 10; $i++){
    echo "Наш вывод: $i <br/>";
}

$num = 0; 
while ($num < 5) 
{
   echo "Эта строка выведется 5 раз <br>"; 
   $num++;
}

$num1 = 0;
do
{
   echo "А эта строка выведется 1 раз <br>"; 
   $num1++;
}
while ($num1 < 5);

foreach ($array as $value)
{
   echo " ... $value "; 
}

echo substr("Снова текст", 6, 5);

function func($i, $j){
    return ($i - $j) * $i;
}

echo func(100,10);


$_SESSION = array();
session_destroy();
?>
