<?php ob_start();

$ing = 1;
$float = 1.1;
$string = "Привет";
$bool = True;

$arr = ['city' => 'Москва', 'country' => 'Россия'];
$numeric_arr = ['один', 'два', 'три'];

if ($arr['city'] == 'Москва') {
	echo "Москва";
	echo "<br>";
} else if ($arr['city'] == 'Киев') {
	echo "Санкт Петербург";
	echo "<br>";
} else {
	echo "Ангарск";
	echo "<br>";
}

switch ($arr['country']) {
	case 'Россия':
		echo 'Россия';
		echo '<br>';
		break;
	case 'Казахстан':
		echo 'Казахстан';
		echo '<br>';
		break;
	default:
		echo 'Россия';
}

echo '<br>';
foreach ($arr as $key => $value) {
	echo "$key - $value <br>";
}

while ($bool === True) {
	echo '<br>While<br>';
	break;
}

do {
	echo '<br>Do While<br>';
} while ($bool === False);

echo '<br>';

for ($i=0; $i < count($numeric_arr); $i++) { 
	echo "$i: $numeric_arr[$i]<br>";
}

echo '<br>';
function Greetings($name = 'Andrey') {
	global $string;
	echo "$string, $name! Как ваши дела?";
}

Greetings('Антон');

echo '<br>';
echo '<br>';

session_start();
$_SESSION['username'] = 'TonikX';
echo("Ваш username - ".$_SESSION['username']);
unset($_SESSION['username']);
session_destroy();


?>