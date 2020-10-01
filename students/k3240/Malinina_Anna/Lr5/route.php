<!DOCTYPE html>
</head>
<body>

<h2>Маршруты</h2>
<form method="post" action="route.php">
    <input type="submit" name="button4"
           class="button" value="Показать маршруты"/>
</form>
<form method="post" action="route.php">
    <input type="text" name="id"/>
    <input type="submit" name="button1"
           class="button" value="Найти"/>
    <input type="submit" name="button2"
           class="button" value="Удалить"/>
</form>
<form method="post" action="route.php">
    <span>Id mountain</span>
    <input type="text" name="id_mountain"/>
    <span>Difficulty</span>
    <input type="text" name="difficulty"/>
    <span>Duration (hours)</span>
    <input type="text" name="duration_hours"/>
    <span>Description</span>
    <input type="text" name="description"/>
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
    add($pdo, $_POST['id_mountain'], $_POST['difficulty'], $_POST['duration_hours'], $_POST['description']);
} else if (array_key_exists('button4', $_POST)) {
    show($pdo);
}

function find($pdo, $id)
{
    $stmt = $pdo->query("select * FROM \"Route\"");
    $found = false;
    while ($row = $stmt->fetch()) {
        if ($row['id'] == $id) {
            echo "<table>";
            echo "<tr><th>id</th><th>Name</th><th>Country</th><th>District</th><th>Height</th><tr>";
            $id = $row['id'];
            $name = $row['id_mountain'];
            $country = $row['description'];
            $district = $row['difficulty'];
            $height = $row['duration_hours'];
            echo "<tr><th>$id</th><th>$name</th><th>$country</th><th>$district</th><th>$height</th><tr>";
            $found = true;
        }
    }
    if ($found != true) {
        echo "Route not found";
    }
}


function delete($pdo, $id)
{
    try {
        $stmt = $pdo->query("delete from \"Accident\" where id_climbing in (select id from \"Climbing\" where id_route=$id)");
        $stmt->execute();
        $stmt = $pdo->query("delete from \"Climbing\" where id_route=$id");
        $stmt->execute();
        $stmt = $pdo->query("delete from \"Route\" where id=$id");
        $stmt->execute();
        echo "route with id $id deleted";
    } catch (PDOException $e) {
        echo "DataBase Error: route cannot be deleted<br>" . $e->getMessage();
    }
}


function add($pdo, $id_mountain, $difficulty, $duration_hours, $description)
{
    $newid = ($pdo->query("select MAX(id) from \"Route\"")->fetch()[0])+1;
    try {
        $stmt=$pdo->prepare("INSERT INTO \"Route\" (id, id_mountain, difficulty, duration_hours, description) VALUES ($newid, $id_mountain, $difficulty, $duration_hours, $description)");
        $stmt->Execute();
        echo "route added";
    } catch (PDOException $e) {
        echo "DataBase Error: Route cannot be added<br>" . $e->getMessage();
    }
}

function show($pdo)
{
    $stmt = $pdo->query("SELECT * FROM \"Route\"");
    echo "<table>";
    echo "<tr><th>id</th><th>id mountain</th><th>Difficulty</th><th>Duration</th><th>Description</th><tr>";
    while ($row = $stmt->fetch()) {
        $id = $row['id'];
        $id_mountain = $row['id_mountain'];
        $difficulty = $row['difficulty'];
        $duration_hours = $row['duration_hours'];
        $description = $row['description'];

        echo "<tr><th>$id</th><th>$id_mountain</th><th>$difficulty</th><th>$duration_hours</th><th>$description</th><tr>";
    }
}

?>