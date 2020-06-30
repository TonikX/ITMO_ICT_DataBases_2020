<?php
        header("Content-Type: text/plain; charset=utf-8");
	function my_session_start()
        {
            if (ini_get('session.use_cookies') && isset($_COOKIE['PHPSESSID'])) {
                $sessid = $_COOKIE['PHPSESSID'];
            } elseif (!ini_get('session.use_only_cookies') && isset($_GET['PHPSESSID'])) {
                $sessid = $_GET['PHPSESSID'];
            } else {
                session_start();
                return false;
            }

           if (!preg_match('/^[a-z0-9]{32}$/', $sessid)) {
                return false;
            }
            session_start();

           return true;
        }
?>
<?php	
$a = 100;
echo $a;
echo " переменная типа integer","\n";
$x = True; 
echo $x;
echo " переменная типа boolean","\n";
$b = 1.234;
echo $b;
echo " переменная типа float","\n";
$s = "Привет";
echo $s;
echo " тоже переменная","\n\n";
if ($a > $b) echo "значение $a больше, чем $b\n";
if (!$a) echo "false\n";
if ($a) echo "true\n";
if ($a > $b) {
     echo "$a больше, чем $b\n\n";
} else {
     echo "$a НЕ больше, чем $b\n\n";
}
if ($a > $b) {
     echo "$a больше, чем $b\n\n";
} elseif ($a == $b) {
     echo "$a равен $b\n\n";
} else {
     echo "$a меньше, чем $b\n\n";
}
?>
<?php
$arr[]=1;
$arr[]=2;
$arr[]=3;
$arr[]=4;
$arr[]=5;
echo "Выводим элементы массива: ", "\n";
for ($q=0; $q<=4; $q++) 
{
echo $arr[$q]." ";
}

function find_max($arr){
	echo "\nНахождение максимума в массиве \n";
	if (count($arr) < 0){
		echo "Пусто", "\n";
		return 0; 
	}
	$max = -INF;
	foreach ($arr as $a){
		if ($a > $max){
			$max = $a;
		}
	}
	return $max;
}
echo find_max(array(1, 2, 3, 4, 5)),"\n\n";
?>
<?php
$a = array("a"=>"aa", "x"=>"xx");
$b = array("c"=>"cc", "d"=>"dd");
$c = $a + $b;
print_r($c);
$i = 100;
	while ($i > 90) {
		echo $i--, "\n"; 
	}
?>