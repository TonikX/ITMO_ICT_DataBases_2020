<?php
session_start();
function resolve($lang){
    if ($lang == "php"){
        echo "будем менять <br>";
    }
    $lang = "Kotlin";
    echo "теперь конфетка <br><br>";
}

$val = 28;
echo "int_10 = $val <br>"; 
$lang = "php";
$isPhp = true;
$array = array(1,2,3,4,5);

if ($isPhp){
    echo "php <br>";
}
else{
    echo "есть языки хуже <br><br>";
}

switch ($lang)
{
    case "php":
        echo "пхп <br>";
        break;
    case "kotlin":
        echo "котлин <br>";
        break;
    default:
		echo "не пхп и не котлин <br>";
}

$z = $val < 0 ? "да" : "нет";

for ($i = 1; $i < 10; $i++){
    echo $i, "<br/>";
}

while(--$val > 20){
    echo $val,"<br/>";
}

do{
    echo $val,"<br/>";
    $val--;
}
while($val>10);

resolve($lang);
$_SESSION['123'] = 123;
echo $_SESSION['123'];

$_SESSION = array();
session_destroy();

?>