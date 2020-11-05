<!DOCTYPE html>

<head>
    <title>Teacher</title>
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
    </style>
</head>
<body>
	<h2>Учителя</h2>
	<form method="post" action="teacher.php">
		<input type="submit" name="button1"
			   class="button" value="Показать cписок учителей"/>
	</form>
	<hr>
	Найти или удалить запись:
	<br><br>
	<form method="post" action="teacher.php">
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
	<form method="post" action="teacher.php">
		<input type="text" name="id" placeholder="id" required/>
		<br>
		<input type="text" name="name" placeholder="ФИО" required/>
		<br>
		<input type="text" name="cabinet" placeholder="Номер кабинета"/>
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
    add($pdo, $_POST['id'], $_POST['name'], $_POST['cabinet']);
} else if(array_key_exists('button5', $_POST)) {
    update($pdo, $_POST['id'], $_POST['name'], $_POST['cabinet']);
}

function show_many($pdo) {
    $stmt = $pdo->query('SELECT * FROM "Школа"."Учитель" ORDER BY id');
    echo "<table>";
    echo "<tr><th>id</th><th>ФИО</th><th>Номер кабинета</th><tr>";
    while ($row = $stmt->fetch()) {
		$id = $row['id'];
        $name = $row['ФИО'];
        $cabinet = $row['Кабинет'];
        echo "<tr><th>$id</th><th>$name</th><th>$cabinet</th><tr>";
    }
}

function show_one($pdo, $id) {
    $stmt = $pdo->query("SELECT * FROM \"Школа\".\"Учитель\" WHERE id = $id");
    $found = false;
	if($row = $stmt->fetch()) {
		echo "<table>";
		echo "<tr><th>id</th><th>ФИО</th><th>Номер кабинета</th><tr>";
		$name = $row['ФИО'];
		$cabinet = $row['Кабинет'];
		echo "<tr><th>$id</th><th>$name</th><th>$cabinet</th><tr>";
		$found = true;
    }
    if($found != true) {
		echo "<table>";
		echo "<tr><th>Учитель с id = $id не найден!</th><tr>";
    }
}

function delete($pdo, $id) {
	if($id == 100) {
		echo "<table>";
		echo "<tr><th>Невозможно удалить учителя с id = $id!!!</th><tr>";
		return;
	}
    try {
        $stmt = $pdo->query("UPDATE \"Школа\".\"Расписание\" SET Учитель = DEFAULT WHERE Учитель = $id;");
        $stmt = $pdo->query("UPDATE \"Школа\".\"Класс\" SET Классный_руководитель = DEFAULT WHERE Классный_руководитель = $id;");
        $stmt = $pdo->query("DELETE FROM \"Школа\".\"Учитель\" WHERE id = $id");
		echo "<table>";
		echo "<tr><th>Учитель с id = $id удалён</th><tr>";
    } catch (PDOException $e) {
        echo "ОШИБКА: Учитель не может быть удалён!<br>" . $e->getMessage();
    }
}

function add($pdo, $id, $name, $cabinet) {
	$cabinet_number = $cabinet ? $cabinet : 'null';
    try {
        $stmt=$pdo->query("INSERT INTO \"Школа\".\"Учитель\" VALUES ($id, '$name', $cabinet_number)");
		echo "<table>";
		echo "<tr><th>Учитель добавлен</th><tr>";
    } catch (PDOException $e) {
        echo "ОШИБКА: Учитель не может быть добавлен!<br>" . $e->getMessage();
    }
}

function update($pdo, $id, $name, $cabinet) {
	if($id == 100) {
		echo "<table>";
		echo "<tr><th>Невозможно обновить учителя с id = $id!!!</th><tr>";
		return;
	}
	$cabinet_number = $cabinet ? $cabinet : 'null';
    try {
        $stmt=$pdo->query("UPDATE \"Школа\".\"Учитель\" SET ФИО = '$name', Кабинет = $cabinet_number WHERE id = $id");
		echo "<table>";
		echo "<tr><th>Учитель обновлен</th><tr>";
    } catch (PDOException $e) {
        echo "ОШИБКА: Учитель не может быть обновлен!<br>" . $e->getMessage();
    }
}

?>