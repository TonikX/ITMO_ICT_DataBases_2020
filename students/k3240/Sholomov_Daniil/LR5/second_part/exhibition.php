<!DOCTYPE html>
</head>
<body>

<h2>Выставки</h2>
<form method="post" action="exhibition.php">
    <input type="submit" name="button4"
           class="button" value="Показать выставки"/>
</form>
<form method="post" action="exhibition.php">
    <input type="text" name="id"/>
    <input type="submit" name="button1"
           class="button" value="Найти"/>
    <input type="submit" name="button2"
           class="button" value="Удалить"/>
</form>
<form method="post" action="exhibition.php">
    <span> Название </span>
    <input type="text" name="name"/>
    <span> Дата </span>
    <input type="date" name="date"/>
    <span>Описание</span>
    <input type="text" name="desc"/>
    <input type="submit" name="button3"
           class="button" value="Добавить"/>
</form>
</body>
</html>
<?php
$dbuser = 'postgres';
$dbpass = '626626';
$host = 'localhost';
$dbname = 'dogs';
$pdo = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser, $dbpass);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
if (array_key_exists('button1', $_POST)) {
    find($pdo, $_POST['id']);
} else if (array_key_exists('button2', $_POST)) {
    delete($pdo, $_POST['id']);
} else if (array_key_exists('button3', $_POST)) {
    add($pdo, $_POST['name'], $_POST['date'], $_POST['desc']);
} else if (array_key_exists('button4', $_POST)) {
    show($pdo);
}

function find($pdo, $id)
{
    $stmt = $pdo->query("select * FROM \"Exhibition\"");
    $found = false;
    while ($row = $stmt->fetch()) {
        if ($row['id_exhibition'] == $id) {
            echo "<table>";
            echo "<tr><th>id</th><th>Name</th><th>Date</th><th>Description</th><tr>";
            $id = $row['id_exhibition'];
            $name = $row['name_exhibition'];
            $date = $row['date_exhibition'];
            $info= $row['info_exhibition'];
            echo "<tr><th>$id</th><th>$name</th><th>$date</th><th>$info</th><tr>";
            $found = true;
        }
    }
    if ($found != true) {
        echo "Exhibition not found";
    }
}


function delete($pdo, $id)
{
    try {
        $stmt = $pdo->query("delete from \"Exhibition\" where id_exhibition=$id");
        $stmt->execute();
        echo "Exhibition with id $id deleted";
    } catch (PDOException $e) {
        echo "DataBase Error: Exhibition cannot be deleted<br>" . $e->getMessage();
    }
}


function add($pdo, $name, $date, $desc)
{
    $newid = ($pdo->query("select MAX(id_exhibition) from \"Exhibition\"")->fetch()[0])+1;
    try {
        $stmt=$pdo->prepare("INSERT INTO \"Exhibition\" (id_exhibition, name_exhibition, date_exhibition, info_exhibition) VALUES ($newid, '$name', '$date', '$desc');");
        
        $stmt->Execute();
        echo "Exhibition added";
    } catch (PDOException $e) {
        echo "DataBase Error: Exhibition cannot be added<br>" . $e->getMessage();
    }
}

function show($pdo)
{
    $stmt = $pdo->query("SELECT * FROM \"Exhibition\"");
    echo "<table>";
	echo "<tr><th>id</th><th>Name</th><th>Date</th><th>Description</th><tr>";
	while ($row = $stmt->fetch()) {
	    $id = $row['id_exhibition'];
            $name = $row['name_exhibition'];
            $date = $row['date_exhibition'];
            $info= $row['info_exhibition'];
            echo "<tr><th>$id</th><th>$name</th><th>$date</th><th>$info</th><tr>";
    }
}

?>