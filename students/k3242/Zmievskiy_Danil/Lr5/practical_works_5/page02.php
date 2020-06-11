<html>
<head>
	<meta charset="utf-8">
	<title>Какой знак зодиака?</title>
	<style type="text/css">
	body {
		zoom:200%;
		background-color:Aquamarine
	}
	h3 {
		text-align:center
	}
	p {
		text-align:center
	}
	</style>
</head>
<body>
	<?php 
	// Сессии
	session_start();
	$_SESSION['date'] = $_POST['date'];
	$_SESSION['month'] = $_POST['month'];
	
	$unsort_signs = array('Водолей', 'Рыбы', 'Овен', 'Телец', 'Близнецы', 'Рак', 'Лев', 'Дева', 'Весы', 'Скорпион', 'Стрелец', 'Козерог');
	// Создание нового массива с знаками, начинающегося с индекса 1, при помощи циклов While, For
	$signs; 
	$i = 1;
	while ($i <= 12) {
		for ($a = 0; $a <= 11; $a++) {
			if ($a == $i) break;
			$signs[$i] = $unsort_signs[$a]; 
		}
		++$i;
	}
	
	$result;
	
	// Пользовательская функция
	function zodiac ($date, $month) {
		global $signs, $result;
		
		// Условные операторы Switch, If
		switch ($month) {
			case 1:
				if ($date >= 21) {
					$result = $signs[1];		
				} else {
					$result = $signs[12];
				}
				break;
			case 2: 
				if ($date >= 19 && $date < 30) {
					$result = $signs[2];
				} elseif ($date >=30) {
					$result = 0;
				} else {
					$result = $signs[1];
				}
				break;
			case 3:
				if ($date >= 21) {
					$result = $signs[3];
				} else {
					$result = $signs[2];
				}
				break;
			case 4:
				if ($date >= 21 && $date < 31) {
					$result = $signs[4];
				} elseif ($date == 31) {
					$result = 0;
				} else {
					$result = $signs[3];
				}
				break;
			case 5:
				if ($date >= 22) {
					$result = $signs[5];
				} else {
					$result = $signs[4];
				}
				break;
			case 6:
				if ($date >= 22 && $date < 31) {
					$result = $signs[6];
				} elseif ($date == 31) {
					$result = 0;
				} else {
					$result = $signs[5];
				}
				break;
			case 7:
				if ($date >= 23) {
					$result = $signs[7];
				} else {
					$result = $signs[6];
				}
				break;
			case 8:
				if ($date >= 24) {
					$result = $signs[8];
				} else {
					$result = $signs[7];
				}
				break;
			case 9:
				if ($date >= 23 && $date < 31) {
					$result = $signs[9];
				} elseif ($date == 31) {
					$result = 0;
				} else {
					$result = $signs[8];
				}
				break;
			case 10:
				if ($date >= 24) {
					$result = $signs[10];
				} else {
					$result = $signs[9];
				}
				break;
			case 11:
				if ($date >= 23 && $date < 31) {
					$result = $signs[11];
				} elseif ($date == 31) {
					$result = 0;
				} else {
					$result = $signs[10];
				}
				break;
			case 12:
				if ($date >= 22) {
					$result = $signs[12];
				} else {
					$result = $signs[11];
				}
				break;
		}

		// Тернарный оператор
		echo ($result) ? "<p>Ваш знак: $result</p>" : "<p>Отсутствует или некорреткный день/месяц</p>";

	}
	
	echo "<h3> Какой знак зодиака? </h3>";
	zodiac($_SESSION['date'], $_SESSION['month']);
	
	
	$_SESSION = array();
	session_destroy();
	
	?>
	<div style="text-align:center">
	<button onclick="location.href='index.php'" type="button">Еще раз!</button>
	</div>
	
</body>
</html>

