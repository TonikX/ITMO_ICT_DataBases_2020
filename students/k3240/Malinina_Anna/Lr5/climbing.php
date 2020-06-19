<!DOCTYPE html>
</head>
<body>

<h2>Восхождения</h2>
<form method="post" action="climbing.php">
    <input type="submit" name="button4"
           class="button" value="Показать восхождения"/>
</form>
<form method="post" action="climbing.php">
    <input type="text" name="id"/>
    <input type="submit" name="button1"
           class="button" value="Найти"/>
    <input type="submit" name="button2"
           class="button" value="Удалить"/>
</form>
<form method="post" action="climbing.php">
    <span>Climbing start</span>
    <input type="date" name="climbing_start"/>
    <span>Climbing end real</span>
    <input type="date" name="climbing_end_real"/>
    <span>Climbing end theory</span>
    <input type="date" name="climbing_end_theory"/>
    <span>id route</span>
    <input type="text" name="id_route"/>
     <span>id group</span>
        <input type="text" name="id_group"/>
    <input type="submit" name="button3"
           class="button" value="Добавить"/>
</form>
</body>
</html>
<?php
$dbuser = 'postgres';
$dbpass = 'a31415926';
$host = 'localhost';
$dbname = 'ClimbingClub';
$pdo = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser, $dbpass);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
if (array_key_exists('button1', $_POST)) {
    find($pdo, $_POST['id']);
} else if (array_key_exists('button2', $_POST)) {
    delete($pdo, $_POST['id']);
} else if (array_key_exists('button3', $_POST)) {
    add($pdo, $_POST['climbing_start'], $_POST['climbing_end_real'], $_POST['climbing_end_theory'], $_POST['id_route'], $_POST['id_group']);
} else if (array_key_exists('button4', $_POST)) {
    show($pdo);
}

function find($pdo, $id)
{
    $stmt = $pdo->query("select * FROM \"Climbing\"");
    $found = false;
    while ($row = $stmt->fetch()) {
        if ($row['id'] == $id) {
            echo "<table>";
            echo "<tr><th>id</th><th>Climbing start</th><th>Climbing end real</th><th>Climbing end theory</th><th>id route</th><th>id group</th><tr>";
            $id = $row['id'];
            $climbing_start = $row['climbing_start'];
            $climbing_end_real = $row['climbing_end_real'];
            $climbing_end_theory = $row['climbing_end_theory'];
            $id_route = $row['id_route'];
            $id_group = $row['id_group'];
            echo "<tr><th>$id</th><th>$climbing_start</th><th>$climbing_end_real</th><th>$climbing_end_theory</th><th>$id_route</th><th>$id_group</th><tr>";
            $found = true;
        }
    }
    if ($found != true) {
        echo "Climbing not found";
    }
}


function delete($pdo, $id)
{
    try {
        $stmt = $pdo->query("delete from \"Accident\" where id_climbing=$id");
        $stmt->execute();
        $stmt = $pdo->query("delete from \"Climbing\" where id=$id");
        $stmt->execute();
        echo "Climbing with id $id deleted";
    } catch (PDOException $e) {
        echo "DataBase Error: climbing cannot be deleted<br>" . $e->getMessage();
    }
}


function add($pdo, $climbing_start, $climbing_end_real, $climbing_end_theory, $id_route, $id_group)
{
    $newid = ($pdo->query("select MAX(id) from \"Climbing\"")->fetch()[0])+1;
    try {
        $stmt=$pdo->prepare("INSERT INTO \"Climbing\" (id, climbing_start, climbing_end_real, climbing_end_theory, id_route, id_group) VALUES ($newid, :climbing_start, :climbing_end_real, :climbing_end_theory, $id_route, $id_group)");
        $stmt->bindParam(':climbing_start', $climbing_start,PDO::PARAM_STR);
        $stmt->bindParam(':climbing_end_real', $climbing_end_real,PDO::PARAM_STR);
        $stmt->bindParam(':climbing_end_theory', $climbing_end_theory,PDO::PARAM_STR);
        $stmt->Execute();
        echo "Climbing added";
    } catch (PDOException $e) {
        echo "DataBase Error: Climbing cannot be added<br>" . $e->getMessage();
    }
}

function show($pdo)
{
    $stmt = $pdo->query("SELECT * FROM \"Climbing\"");
    echo "<table>";
    echo "<tr><th>id</th><th>Climbing start</th><th>Climbing end real</th><th>Climbing end theory</th><th>id route</th><th>id group</th><tr>";
    while ($row = $stmt->fetch()) {
        $id = $row['id'];
        $climbing_start = $row['climbing_start'];
        $climbing_end_real = $row['climbing_end_real'];
        $climbing_end_theory = $row['climbing_end_theory'];
        $id_route = $row['id_route'];
        $id_group = $row['id_group'];
        echo "<tr><th>$id</th><th>$climbing_start</th><th>$climbing_end_real</th><th>$climbing_end_theory</th><th>$id_route</th><th>$id_group</th><tr>";

    }
}

?>