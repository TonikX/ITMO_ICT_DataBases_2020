<?php

$ing = 1;
$float = 1.1;
$string = "Hello";
$bool = True;

$arr = ['city' => 'Moscow', 'country' => 'Russia'];
$numeric_arr = ['one', 'two', 'three'];

if ($arr['city'] == 'Moscow') {
	echo "Moscow";
	echo "<br>";
} else if ($arr['city'] == 'Saint Petersburg') {
	echo "Saint Petersburg";
	echo "<br>";
} else {
	echo "Unknown";
	echo "<br>";
}

switch ($arr['country']) {
	case 'Russia':
		echo 'Russia';
		echo '<br>';
		break;
	case 'USA':
		echo 'USA';
		echo '<br>';
		break;
	default:
		echo 'Unknown';
}

echo '<br>';
foreach ($arr as $key => $value) {
	echo "$key => $value <br>";
}

echo '<br>';
for ($i=0; $i < count($numeric_arr); $i++) { 
	echo "$i: $numeric_arr[$i]<br>";
}

while ($bool === True) {
	echo '<br>while action<br>';
	break;
}

do {
	echo '<br>do while action<br>';
} while ($bool === False);

echo '<br>';

function Hello($name = 'Dmitry') {
	echo "Hello, $name!";
}

Hello('Anton');

echo '<br>';
echo '<br>';

session_start();
$_SESSION['name'] = 'Anton';
echo($_SESSION['name']);
unset($_SESSION['name']);
session_destroy();


?>