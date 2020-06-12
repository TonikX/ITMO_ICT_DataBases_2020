<?php
//заводим сессиюб
session_start();
$_SESSION['username'] = 'Даниил Константинович';
$_SESSION['status'] = 'Смотрящий';

echo '<h1>ну че там с деньгами</h1><br>';
echo 'юзернейм: ', $_SESSION['username'], '<br>', 'масть: ', $_SESSION['status'], '<br/><br>';


//создание пользовательской функции с форич
function shizopredki() {
$true_math = array("ноль","целковый","полушка","четвертушка","осьмушка","подувичок","медичок","серебрячок","золотничок","девятичок","десятичок");

echo 'как считали наши шизопредки:<br>';
foreach ($true_math as $shiz) {
	echo $shiz, ' ';
}
}

//создание пользовательской функции с иф, эльзиф
function comparing (){

	global $a, $b;

	if ($a > $b) {
		echo '$a больше, чем $b<br><br>';
	}
	else if ($a < $b) {
		echo '$a меньше, чем $b<br><br>';
	}
	else {
		echo '$a равна $b<br><br>';
	}
}

//создание пользовательской функции с кейс
function yankee() {

	global $brim;

	switch ($brim) {
		case false:
			echo 'woahhh, yankee with no brim<br><br>';
			break;
		case true:
			echo 'woahhh, yankee with brim<br><br>';
			break;
		default:
			echo 'woahhh, no yankee with no brim<br><br>';
			break;
	}
}
//использование функций
echo '======================================================<br><br>';
$a = 1.2;
$b = 5;
echo '$a = ', $a, ' $b = ', $b, '<br>';

comparing();

$a = 54;
$b = 5.4;

echo '$a = ', $a, ' $b = ', $b, '<br>';

comparing();

$a = 5;
$b = 5;

echo '$a = ', $a, ' $b = ', $b, '<br>';

comparing();

echo '======================================================<br><br>';

echo 'brim = true<br>';
$brim = true;
yankee();

echo 'brim = false<br>';
$brim = false;
yankee();

echo '======================================================<br><br>';

$my_func = shizopredki();
echo $my_func;

echo '<br>';
echo '<br>======================================================<br><br>';

$numbers = array();
for ($i = 0; $i < 10; $i++){
    $numbers[$i] = $i;
}

echo "<br/>" . "new array: ";

foreach ($numbers as $value){
    echo $value . "\n";
}

echo '<br>';
echo '<br>======================================================<br><br>';

$num = 10;
echo "<br/>" . 'значение $num до цикла while: ' . $num;

while ($num > 0){
    $num--;
};

echo "<br/>" . 'значение $num после цикла while: ' . $num . "<br/>";

echo '<br>======================================================<br><br>';

do {
    $num++;
} while ($num < 10);

echo "<br/>" . 'та же переменная, но тут навалили do-while: ' . $num . "<br/>";

echo '<br>======================================================<br><br>';

echo '<HTML>
     <HEAD>
     <META HTTP-EQUIV="Refresh" CONTENT="15; URL=fecalfunny.php">
     <TITLE>это я</TITLE>
     </HEAD>
     <BODY>
     <h2>!групповое перенаправление начнется через 15 секунд!<h2>
     </BODY>
     </HTML>';
?>

