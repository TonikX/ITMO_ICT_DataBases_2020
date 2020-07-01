<!DOCTYPE html>
</head>
<body>

<h2>Ринги</h2>
<form method="post" action="ring.php">
    <input type="submit" name="button4"
           class="button" value="Показать ринги"/>
</form>
<form method="post" action="ring.php">
    <input type="text" name="id"/>
    <input type="submit" name="button1"
           class="button" value="Найти"/>
    <input type="submit" name="button2"
           class="button" value="Удалить"/>
</form>
<form method="post" action="ring.php">
    <span> Номер </span>
    <input type="text" name="number_ring"/>
    <span>ID выставки</span>
    <input type="text" name="exhibition_ring"/>
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
    add($pdo, $_POST['number_ring'], $_POST['exhibition_ring']);
} else if (array_key_exists('button4', $_POST)) {
    show($pdo);
}

function find($pdo, $id)
{
    $stmt = $pdo->query("select * FROM \"Ring\"");
    $found = false;
    while ($row = $stmt->fetch()) {
        if ($row['id_ring'] == $id) {
            echo "<table>";
            echo "<tr><th>id</th><th>Number</th><th>Exhibition ID</th><tr>";
            $id = $row['id_ring'];
            $number = $row['number_ring'];
            $id_exh = $row['exhibition_ring'];
            echo "<tr><th>$id</th><th>$number</th><th>$id_exh</th><tr>";
            $found = true;
        }
    }
    if ($found != true) {
        echo "Ring not found";
    }
}


function delete($pdo, $id)
{
    try {
        $stmt = $pdo->query("delete from \"Ring\" where id_ring=$id");
        $stmt->execute();
        echo "Ring with id $id deleted";
    } catch (PDOException $e) {
        echo "DataBase Error: Ring cannot be deleted<br>" . $e->getMessage();
    }
}


function add($pdo, $number_ring, $id_exh)
{
    $newid = ($pdo->query("select MAX(id_ring) from \"Ring\"")->fetch()[0])+1;
    try {
	$id_exh = (int)$id_exh;
	$number_ring = (int)$number_ring;
        $stmt=$pdo->prepare("INSERT INTO \"Ring\" (id_ring, number_ring, exhibition_ring) VALUES ($newid, $number_ring, $id_exh);");
        
        $stmt->Execute();
        echo "Ring added";
    } catch (PDOException $e) {
        echo "DataBase Error: Ring cannot be added<br>" . $e->getMessage();
    }
}

function show($pdo)
{
    $stmt = $pdo->query("SELECT * FROM \"Ring\"");
    echo "<table>";
	echo "<tr><th>id</th><th>Number</th><th>Exhibition ID</th><tr>";
	while ($row = $stmt->fetch()) {
        $id = $row['id_ring'];
            $name = $row['number_ring'];
            $id_club = $row['exhibition_ring'];
            echo "<tr><th>$id</th><th>$name</th><th>$id_club</th><tr>";
    }
}

?>