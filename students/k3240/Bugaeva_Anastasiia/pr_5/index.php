<?php

session_start();
$_SESSION['0'] = 'Hello!<br><br>';
echo $_SESSION['0'];

function is_equally($a, $b){
    if ($a === $b){
        echo 'Values and types are equal<br><br>';
    } else if ($a == $b) {
		echo 'Equal values, but not types<br><br>';
	} else {
		echo 'Not equally<br><br>';
	}
}

$a = 8;
$b = '8';
$n = 0;
$str = 'Meow';
$arr = array(1, 1, 2, 3, 5, 8, 13, 21, 34, 55);

is_equally($a, $b);

for ($i = 0; $i < 10; $i++){
    echo "$i ";
}

echo '<br><br>';

while($n <= 10){
	$temp = $n*$n;
    echo "$temp ";
	$n++;
}

echo '<br><br>';

do {
	$temp = $n*10;
    echo "$temp ";
    $n--;
} while ($n > 0);

echo '<br><br>';

foreach($arr as $val) {
	echo "$val ";
}

echo '<br><br>';

switch ($str)
{
    case "Meow":
        echo "Cat";
        break;
    case "Woof":
        echo "Dog";
        break;
    default:
		echo "Someone else";
}

echo '<br><br>';

$_SESSION['1'] = 'Good Bye!';
echo $_SESSION['1'];

$_SESSION = array();
session_destroy();

?>
