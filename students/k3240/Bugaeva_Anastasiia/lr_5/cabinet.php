<!DOCTYPE html>

<head>
    <title>Cabinet</title>
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
		
		.check {
			width: 13px;
			height: 13px;
		}
    </style>
</head>
<body>
	<h2>Кабинеты</h2>
	<form method="post" action="cabinet.php">
		<input type="submit" name="button1"
			   class="button" value="Показать cписок кабинетов"/>
	</form>
	<hr>
	Найти или удалить запись:
	<br><br>
	<form method="post" action="cabinet.php">
		<input type="text" name="cabinet_number" placeholder="Номер кабинета" required/>
		<br>
		<input type="submit" name="button2"
			   class="button" value="Найти"/>
		<input type="submit" name="button3"
			   class="button" value="Удалить"/>
	</form>
	<hr>
	Добавить или обновить данные:
	<br><br>
	<form method="post" action="cabinet.php">
		<input type="text" name="cabinet_number" placeholder="Номер кабинета" required/>
		<br>
		<input type="checkbox" name="is_profile" class="check"/>
		Профильный кабинет
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
	show_one($pdo, $_POST['cabinet_number']);
} else if(array_key_exists('button3', $_POST)) {
    delete($pdo, $_POST['cabinet_number']);
} else if(array_key_exists('button4', $_POST)) {
	if(isset($_POST['is_profile'])) {
		add($pdo, $_POST['cabinet_number'], true);
	} else {
		add($pdo, $_POST['cabinet_number'], false);
	}
} else if(array_key_exists('button5', $_POST)) {
    if(isset($_POST['is_profile'])) {
		update($pdo, $_POST['cabinet_number'], true);
	} else {
		update($pdo, $_POST['cabinet_number'], false);
	}
}

function show_many($pdo) {
    $stmt = $pdo->query('SELECT * FROM "Школа"."Кабинет" ORDER BY Номер');
    echo "<table>";
    echo "<tr><th>Номер кабинета</th><th>Профильный</th><tr>";
    while ($row = $stmt->fetch()) {
        $number = $row['Номер'];
        $is_profile = $row['Профильный'];
		$profile = $is_profile ? 'Да' : 'Нет';
        echo "<tr><th>$number</th><th>$profile</th><tr>";
    }
}

function show_one($pdo, $cabinet_number) {
    $stmt = $pdo->query("SELECT * FROM \"Школа\".\"Кабинет\" WHERE Номер = $cabinet_number");
    $found = false;
	if($row = $stmt->fetch()) {
		echo "<table>";
		echo "<tr><th>Номер кабинета</th><th>Профильный</th><tr>";
        $is_profile = $row['Профильный'];
		$profile = $is_profile ? 'Да' : 'Нет';
		echo "<tr><th>$cabinet_number</th><th>$profile</th><tr>";
		$found = true;
    }
    if($found != true) {
		echo "<table>";
		echo "<tr><th>Кабинет с Номером $cabinet_number не найден!</th><tr>";
    }
}

function delete($pdo, $cabinet_number) {
	if($cabinet_number == 0) {
		echo "<table>";
		echo "<tr><th>Невозможно удалить кабинет с Номером $cabinet_number!!!</th><tr>";
		return;
	}
    try {
        $stmt = $pdo->query("UPDATE \"Школа\".\"Расписание\" SET Кабинет = DEFAULT WHERE Кабинет = $cabinet_number;");
        $stmt = $pdo->query("UPDATE \"Школа\".\"Учитель\" SET Кабинет = NULL WHERE Кабинет = $cabinet_number;");
        $stmt = $pdo->query("DELETE FROM \"Школа\".\"Кабинет\" WHERE Номер = $cabinet_number");
		echo "<table>";
		echo "<tr><th>Кабинет с Номером $cabinet_number удалён</th><tr>";
    } catch (PDOException $e) {
        echo "ОШИБКА: Кабинет не может быть удалён!<br>" . $e->getMessage();
    }
}

function add($pdo, $cabinet_number, $is_profile) {
	$profile = $is_profile ? 'true' : 'false';
    try {
        $stmt=$pdo->query("INSERT INTO \"Школа\".\"Кабинет\" VALUES ($cabinet_number, $profile)");
		echo "<table>";
		echo "<tr><th>Кабинет добавлен</th><tr>";
    } catch (PDOException $e) {
        echo "ОШИБКА: Кабинет не может быть добавлен!<br>" . $e->getMessage();
    }
}

function update($pdo, $cabinet_number, $is_profile) {
	if($cabinet_number == 0) {
		echo "<table>";
		echo "<tr><th>Невозможно обновить кабинет с Номером $cabinet_number!!!</th><tr>";
		return;
	}
	$profile = $is_profile ? 'true' : 'false';
    try {
        $stmt=$pdo->query("UPDATE \"Школа\".\"Кабинет\" SET Профильный = $profile WHERE Номер = $cabinet_number");
		echo "<table>";
		echo "<tr><th>Кабинет обновлен</th><tr>";
    } catch (PDOException $e) {
        echo "ОШИБКА: Кабинет не может быть обновлен!<br>" . $e->getMessage();
    }
}

?>