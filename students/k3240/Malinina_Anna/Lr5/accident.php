<!DOCTYPE html>
</head>
<body>

<h2>Происшествия</h2>
<form method="post" action="accident.php">
    <input type="submit" name="button4"
           class="button" value="Показать происшествия"/>
</form>
<form method="post" action="accident.php">
    <input type="text" name="id"/>
    <input type="submit" name="button1"
           class="button" value="Найти"/>
    <input type="submit" name="button2"
           class="button" value="Удалить"/>
</form>
<form method="post" action="accident.php">
    <span>Id member</span>
    <input type="text" name="id_member"/>
    <span>Id climbing</span>
    <input type="text" name="id_climbing"/>
    <span>Date</span>
    <input type="date" name="date"/>
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
    add($pdo, $_POST['id_member'], $_POST['id_climbing'], $_POST['date'], $_POST['description']);
} else if (array_key_exists('button4', $_POST)) {
    show($pdo);
}

function find($pdo, $id)
{
    $stmt = $pdo->query("select * FROM \"Accident\"");
    $found = false;
    while ($row = $stmt->fetch()) {
        if ($row['id'] == $id) {
            echo "<table>";
            echo "<tr><th>id</th><th>Name</th><th>Country</th><th>District</th><th>Height</th><tr>";
            $id = $row['id'];
            $name = $row['id_member'];
            $country = $row['description'];
            $district = $row['id_climbing'];
            $height = $row['date'];
            echo "<tr><th>$id</th><th>$name</th><th>$country</th><th>$district</th><th>$height</th><tr>";
            $found = true;
        }
    }
    if ($found != true) {
        echo "Accident not found";
    }
}


function delete($pdo, $id)
{
    try {
        $stmt = $pdo->query("delete from \"Accident\" where id=$id");
        $stmt->execute();
        echo "Accident with id $id deleted";
    } catch (PDOException $e) {
        echo "DataBase Error: Accident cannot be deleted<br>" . $e->getMessage();
    }
}


function add($pdo, $id_member, $id_climbing, $date, $description)
{
    $newid = ($pdo->query("select MAX(id) from \"Accident\"")->fetch()[0])+1;
    try {
        $stmt=$pdo->prepare("INSERT INTO \"Accident\" (id, id_member, id_climbing, date, description) VALUES ($newid, $id_member, $id_climbing, :date, $description)");
        $stmt->bindParam(':date', $date,PDO::PARAM_STR);
        $stmt->Execute();
        echo "Accident added";
    } catch (PDOException $e) {
        echo "DataBase Error: Accident cannot be added<br>" . $e->getMessage();
    }
}

function show($pdo)
{
    $stmt = $pdo->query("SELECT * FROM \"Accident\"");
    echo "<table>";
    echo "<tr><th>id</th><th>id mountain</th><th>id_climbing</th><th>Duration</th><th>Description</th><tr>";
    while ($row = $stmt->fetch()) {
        $id = $row['id'];
        $id_member = $row['id_member'];
        $id_climbing = $row['id_climbing'];
        $date = $row['date'];
        $description = $row['description'];

        echo "<tr><th>$id</th><th>$id_member</th><th>$id_climbing</th><th>$date</th><th>$description</th><tr>";
    }
}

?>