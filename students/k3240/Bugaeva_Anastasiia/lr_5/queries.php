<!DOCTYPE html>

<head>
    <title>Queries</title>
    <meta http-equiv="Content-Type" content="text/html;
charset=utf-" ;/>
    <style>
		table {
			font-family: arial, sans-serif;
			font-size: 15px;
			border-collapse: collapse;
		}
		
		td, th {
			border: 1.5px solid rgba(0, 255, 255, 0.3);
			text-align: center;
			padding: 10px;
		}

		tr:nth-child(even) {
			background-color: #f8f8ff;
		}

		tr:nth-child(odd) {
			background-color: #f5fffa;
		}
		
		input {
			border: 1.5px solid rgba(0, 255, 255, 0.3);
			border-radius: 10px;
			padding: 10px;
			background-color: #f8f8ff;
			outline: 0;
		}
		
		input:active {
			border: 1.5px solid rgba(0, 0, 0, 0.3);
			border-radius: 10px;
			padding: 10px;
			background-color: #f8f8ff;
		}
    </style>
</head>
<body>
	<h2>5 запросов:</h2>
	<form method="get">
		<input type="submit" name="button1"
			   class="button" value="Первый запрос" />
		<input type="submit" name="button2"
			   class="button" value="Второй запрос" />
		<input type="submit" name="button3"
			   class="button" value="Третий запрос" />
		<input type="submit" name="button4"
		   	   class="button" value="Четвертый запрос" />
		<input type="submit" name="button5"
			   class="button" value="Пятый запрос" />
	</form>
</body>
</html>

<?php
$dbuser = 'postgres';
$dbpass = 'ILoveHukumka';
$host = 'localhost';
$dbname= 'School';

$db = pg_connect("host=$host dbname=$dbname user=$dbuser password=$dbpass");
if(array_key_exists('button1', $_GET)) {
	one($db);
} else if(array_key_exists('button2', $_GET)) {
	two($db);
} else if(array_key_exists('button3', $_GET)) {
	three($db);
} else if(array_key_exists('button3+', $_GET)) {
	three_plus($db);
} else if(array_key_exists('button4', $_GET)) {
	four($db);
} else if(array_key_exists('button5', $_GET)) {
	five($db);
}

function one($db) {
	echo "<br>Расписание на понедельник с ФИО учителя и временем вместо id<br><br>";
	$query = 'SELECT Класс, Номер_урока, Предмет, Учитель.ФИО, Расписание.Кабинет
		FROM "Школа"."Расписание", "Школа"."Учитель", "Школа"."Время"
		WHERE Расписание.Время = Время.id AND Время.День_недели = \'Пн\' AND Расписание.Учитель = Учитель.id
		ORDER BY Класс, Номер_урока';
	$header = "<th>Класс</th><th>Урок</th><th>Предмет</th><th>Учитель</th><th>Кабинет</th>";
	$result = pg_query($db, $query);
	
	table($result, $header);
}

function two($db) {
	echo "<br>Определение профильности предметов на основании кабинетов, в которых по ним проводят занятия<br><br>";
	$query = 'SELECT DISTINCT Расписание.Предмет, Кабинет.Профильный
	FROM "Школа"."Расписание", "Школа"."Кабинет"
	WHERE Расписание.Кабинет = Кабинет.Номер';
	$result = pg_query($db, $query);
	$header = "<th>Предмет</th><th>Профильный ли</th>";
	
	table($result, $header);
}

function three($db) {
	echo "<br>Количество учеников, у которых по неведомым причинам нет ни одной четвертной оценки<br><br>";
	$query = 'SELECT COUNT(*) FROM "Школа"."Ученик"
		LEFT JOIN "Школа"."Оценка" ON Ученик.id = Оценка.Ученик
		WHERE Оценка.Ученик IS NULL';
	$result = pg_query($db, $query);
	$header = "<th>Количество</th>";

	table($result, $header);
	
	$n = pg_fetch_result($result, 0, 0);
	if($n != 0) {
		echo "
		<br>
		<form method=\"get\">
			<input type=\"submit\" name=\"button3+\"
			class=\"button\" value=\"Посмотреть список\" />
		</form>";
	}
}

function three_plus($db) {
	echo "<br>Список учеников, у которых по неведомым причинам нет ни одной четвертной оценки<br><br>";
	$query = 'SELECT Класс, ФИО, id FROM "Школа"."Ученик"
		LEFT JOIN "Школа"."Оценка" ON Ученик.id = Оценка.Ученик
		WHERE Оценка.Ученик IS NULL';
	$result = pg_query($db, $query);
	$header = "<th>Класс</th><th>ФИО</th><th>id</th>";

	table($result, $header);
}

function four($db) {
	echo "<br>Средние оценки каждого ученика<br><br>";
	$query = 'SELECT Ученик.ФИО, avg(Оценка.Оценка)
		FROM "Школа"."Ученик", "Школа"."Оценка"
		WHERE Ученик.id = Оценка.Ученик GROUP BY Ученик.ФИО';
	$result = pg_query($db, $query);
	$header = "<th>ФИО</th><th>Оценка</th>";
	
	table($result, $header);
}

function five($db) {
	echo "<br>Средний балл по школе: ";
	$query = 'SELECT avg(Оценка.Оценка) AS Оценки FROM "Школа"."Оценка"';
	$result = pg_query($db, $query);
	$m = pg_fetch_result($result, 0, 0);
	echo "<b>$m</b><br>";
	
	echo "<br>Список учеников, средняя оценка которых ниже средней оценки по школе<br><br>";
	$query = "SELECT Ученик.ФИО, avg(Оценка.Оценка)
		FROM \"Школа\".\"Ученик\", \"Школа\".\"Оценка\"
		WHERE Ученик.id = Оценка.Ученик GROUP BY Ученик.ФИО
		HAVING avg(Оценка.Оценка) < $m";
	$result = pg_query($db, $query);
	$header = "<th>ФИО</th><th>Оценка</th>";
	
	table($result, $header);
}

function table($result, $header) {
	$NumRows = pg_num_rows($result);
    $NumFields = pg_num_fields($result);
    echo "<table style=\"width:auto\">
    <tr>$header</tr>";
    for ($i = 0; $i < $NumRows; $i++) {
		$result_array = pg_fetch_row($result, $i);
        echo "<tr>";
        for ($j = 0; $j < $NumFields; $j++) {
			if($result_array[$j] == 'f') {
				echo "<th>Нет</th>";
			} else if($result_array[$j] == 't') {
				echo "<th>Да</th>";
			} else {
				echo "<th>$result_array[$j]</th>";
			}
        }
        echo "</tr>";
	}
	echo "</table>";
}

pg_close($db);

?>