<!DOCTYPE html>
</head>
<body>

<h2>Ринги-Эксперты</h2>
<form method="post" action="ring_judge.php">
    <input type="submit" name="button4"
           class="button" value="Показать ринги-эксперты"/>
</form>
<form method="post" action="ring_judge.php">
    <span> ID эксперта </span>
    <input type="text" name="id_j"/>
    <span>ID ринга</span>
    <input type="text" name="id_r"/>
        <input type="submit" name="button1"
           class="button" value="Найти"/>
    <input type="submit" name="button3"
           class="button" value="Добавить"/>
    <input type="submit" name="button2"
           class="button" value="Удалить"/>
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
    find($pdo, $_POST['id_j'], $_POST['id_r']);
} else if (array_key_exists('button2', $_POST)) {
    delete($pdo, $_POST['id_j'], $_POST['id_r']);
} else if (array_key_exists('button3', $_POST)) {
    add($pdo, $_POST['id_j'], $_POST['id_r']);
} else if (array_key_exists('button4', $_POST)) {
    show($pdo);
}

function find($pdo, $id_r, $id_j)
{
    $stmt = $pdo->query("select * FROM \"Ring_judge\"");
    $found = false;
    while ($row = $stmt->fetch()) {
        if ($row['id_ring'] == $id_r and $row['id_judge'] == $id_j) {
            echo "<table>";
            echo "<tr><th>ring ID</th><th>judge ID</th><tr>";
            $id_r = $row['id_ring'];
	$id_j = $row['id_judge'];
            echo "<tr><th>$id_r</th><th>$id_j</th><tr>";
            $found = true;
        }
    }
    if ($found != true) {
        echo "Ring_judge not found";
    }
}


function delete($pdo, $id_r, $id_j)
{
    try {
        $stmt = $pdo->query("delete from \"Ring_judge\" where id_ring=$id_r and id_judge=$id_j ");
        $stmt->execute();
        echo "Ring_judge $id_r, $id_j deleted";
    } catch (PDOException $e) {
        echo "DataBase Error: Ring_judge cannot be deleted<br>" . $e->getMessage();
    }
}


function add($pdo, $id_r, $id_j)
{
    try {
	$id_r = (int)$id_r;
	$id_j = (int)$id_j;
        $stmt=$pdo->prepare("INSERT INTO \"Ring_judge\" (id_ring, id_judge) VALUES ($id_r, $id_j);");
        
        $stmt->Execute();
        echo "Ring_judge added";
    } catch (PDOException $e) {
        echo "DataBase Error: Ring_judge cannot be added<br>" . $e->getMessage();
    }
}

function show($pdo)
{
    $stmt = $pdo->query("SELECT * FROM \"Ring_judge\"");
    echo "<table>";
	echo "<tr><th>ring ID</th><th>judge ID</th><tr>";
	while ($row = $stmt->fetch()) {
        $id_r = $row['id_ring'];
        $id_j = $row['id_judge'];
            echo "<tr><th>$id_r</th><th>$id_j</th><tr>";
    }
}

?>