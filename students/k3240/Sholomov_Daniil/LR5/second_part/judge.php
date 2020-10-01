<!DOCTYPE html>
</head>
<body>

<h2>Эксперты</h2>
<form method="post" action="judge.php">
    <input type="submit" name="button4"
           class="button" value="Показать экспертов"/>
</form>
<form method="post" action="judge.php">
    <input type="text" name="id"/>
    <input type="submit" name="button1"
           class="button" value="Найти"/>
    <input type="submit" name="button2"
           class="button" value="Удалить"/>
</form>
<form method="post" action="judge.php">
    <span>Имя </span>
    <input type="text" name="name_judge"/>
    <span>ID клуба</span>
    <input type="text" name="id_club"/>
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
    add($pdo, $_POST['name_judge'], $_POST['id_club']);
} else if (array_key_exists('button4', $_POST)) {
    show($pdo);
}

function find($pdo, $id)
{
    $stmt = $pdo->query("select * FROM \"Judge\"");
    $found = false;
    while ($row = $stmt->fetch()) {
        if ($row['id_judge'] == $id) {
            echo "<table>";
            echo "<tr><th>id</th><th>Name</th><th>Club ID</th><tr>";
            $id = $row['id_judge'];
            $name = $row['name_judge'];
            $id_club = $row['id_club'];
            echo "<tr><th>$id</th><th>$name</th><th>$id_club</th><tr>";
            $found = true;
        }
    }
    if ($found != true) {
        echo "Judge not found";
    }
}


function delete($pdo, $id)
{
    try {
        $stmt = $pdo->query("delete from \"Judge\" where id_judge=$id");
        $stmt->execute();
        echo "Judge with id $id deleted";
    } catch (PDOException $e) {
        echo "DataBase Error: Judge cannot be deleted<br>" . $e->getMessage();
    }
}


function add($pdo, $name_judge, $id_club)
{
    $newid = ($pdo->query("select MAX(id_judge) from \"Judge\"")->fetch()[0])+1;
    try {
	$id_club = (int)$id_club;
        $stmt=$pdo->prepare("INSERT INTO \"Judge\" (id_judge, name_judge, id_club) VALUES ($newid, '$name_judge', $id_club);");
        
        $stmt->Execute();
        echo "Judge added";
    } catch (PDOException $e) {
        echo "DataBase Error: Judge cannot be added<br>" . $e->getMessage();
    }
}

function show($pdo)
{
    $stmt = $pdo->query("SELECT * FROM \"Judge\"");
    echo "<table>";
	echo "<tr><th>id</th><th>Name</th><th>Club ID</th><tr>";
	while ($row = $stmt->fetch()) {
        $id = $row['id_judge'];
            $name = $row['name_judge'];
            $id_club = $row['id_club'];
            echo "<tr><th>$id</th><th>$name</th><th>$id_club</th><tr>";
    }
}

?>