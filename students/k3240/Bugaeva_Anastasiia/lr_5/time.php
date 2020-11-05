<!DOCTYPE html>

<head>
    <title>Time</title>
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
			background-color: #f5fffa;
		}
		
		.button {
			border: 1.5px solid rgba(0, 255, 255, 0.3);
			border-radius: 10px;
			padding: 10px;
			outline: 0;
		}
		
		.button:active {
			border: 1.5px solid rgba(0, 0, 0, 0.3);
			border-radius: 10px;
			padding: 10px;
		}
		
		input {
			border: 1.5px solid rgba(0, 0, 0, 0.3);
			padding: 10px;
			background-color: #f8f8ff;
			outline: 0;
			margin-bottom: 5px;
		}
		
		select {
			border: 1.5px solid rgba(0, 0, 0, 0.3);
			padding: 10px;
			background-color: #f8f8ff;
			outline: 0;
			margin-bottom: 5px;
		}
    </style>
</head>
<body>
	<h2>Время уроков</h2>
	<form method="post" action="time.php">
		<input type="submit" name="button1"
			   class="button" value="Показать cписок"/>
	</form>
	<hr>
	Найти или удалить запись:
	<br><br>
	<form method="post" action="time.php">
		<input type="text" name="id" placeholder="id" required/>
		<br>
		<input type="submit" name="button2"
			   class="button" value="Найти"/>
		<input type="submit" name="button3"
			   class="button" value="Удалить"/>
	</form>
	<hr>
	Добавить или обновить данные:
	<br><br>
	<form method="post" action="time.php">
		<input type="text" name="id" placeholder="id" required/>
		<br>
		<select name="day" required>
			<option value="">Выберите день</option>
			<?php
			$dayArray = ['Пн', 'Вт', 'Ср', 'Чт', 'Пт'];
			foreach ($dayArray as $day) {
				echo '<option value="'.$day.'">'.$day.'</option>';
			}
			?>
		</select>
		<br>
		<select name="lesson" required>
			<option value="">Выберите номер урока</option>
			<?php
			$lessonArray = [1, 2, 3, 4, 5, 6];
			foreach ($lessonArray as $lesson) {
				echo '<option value="'.$lesson.'">'.$lesson.'</option>';
			}
			?>
		</select>
		<br>
		<input type="submit" name="button4"
			   class="button" value="Добавить"/>
		<input type="submit" name="button5"
			   class="button" value="Обновить"/>
	</form>
	<hr>
</body>
</html>
<?php
$dbuser = 'postgres';
$dbpass = 'ILoveHukumka';
$host = 'localhost';
$dbname= 'School';

$pdo = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser, $dbpass);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
if(array_key_exists('button1', $_POST)) {
    show_many($pdo);
} else if(array_key_exists('button2', $_POST)) {
	show_one($pdo, $_POST['id']);
} else if(array_key_exists('button3', $_POST)) {
    delete($pdo, $_POST['id']);
} else if(array_key_exists('button4', $_POST)) {
    add($pdo, $_POST['id'], $_POST['day'], $_POST['lesson']);
} else if(array_key_exists('button5', $_POST)) {
    update($pdo, $_POST['id'], $_POST['day'], $_POST['lesson']);
}

function show_many($pdo) {
    $stmt = $pdo->query('SELECT * FROM "Школа"."Время" ORDER BY id');
    echo "<table>";
    echo "<tr><th>id</th><th>День недели</th><th>Номер урока</th><tr>";
    while ($row = $stmt->fetch()) {
		$id = $row['id'];
        $day = $row['День_недели'];
        $lesson = $row['Номер_урока'];
        echo "<tr><th>$id</th><th>$day</th><th>$lesson</th><tr>";
    }
}

function show_one($pdo, $id) {
    $stmt = $pdo->query("SELECT * FROM \"Школа\".\"Время\" WHERE id = $id");
    $found = false;
	if($row = $stmt->fetch()) {
		echo "<table>";
		echo "<tr><th>id</th><th>День недели</th><th>Номер урока</th><tr>";
        $day = $row['День_недели'];
        $lesson = $row['Номер_урока'];
        echo "<tr><th>$id</th><th>$day</th><th>$lesson</th><tr>";
		$found = true;
    }
    if($found != true) {
		echo "<table>";
		echo "<tr><th>Время с id = $id не найдено!</th><tr>";
    }
}

function delete($pdo, $id) {
	if($id == 100) {
		echo "<table>";
		echo "<tr><th>Невозможно удалить Время с id = $id!!!</th><tr>";
		return;
	}
    try {
        $stmt = $pdo->query("UPDATE \"Школа\".\"Расписание\" SET Время = DEFAULT WHERE Время = $id;");
        $stmt = $pdo->query("DELETE FROM \"Школа\".\"Время\" WHERE id = $id");
		echo "<table>";
		echo "<tr><th>Время с id = $id удалёно</th><tr>";
    } catch (PDOException $e) {
        echo "ОШИБКА: Время не может быть удалёно!<br>" . $e->getMessage();
    }
}

function add($pdo, $id, $day, $lesson) {
    try {
        $stmt=$pdo->query("INSERT INTO \"Школа\".\"Время\" VALUES ($id, '$day', $lesson)");
		echo "<table>";
		echo "<tr><th>Время добавлено</th><tr>";
    } catch (PDOException $e) {
        echo "ОШИБКА: Время не может быть добавлено!<br>" . $e->getMessage();
    }
}

function update($pdo, $id, $day, $lesson) {
	if($id == 100) {
		echo "<table>";
		echo "<tr><th>Невозможно обновить Время с id = $id!!!</th><tr>";
		return;
	}
    try {
		$stmt=$pdo->query("UPDATE \"Школа\".\"Время\" SET День_недели = '$day', Номер_урока = $lesson WHERE id = $id");
		echo "<table>";
		echo "<tr><th>Время обновлено</th><tr>";
    } catch (PDOException $e) {
        echo "ОШИБКА: Время не может быть обновлено!<br>" . $e->getMessage();
    }
}

?>