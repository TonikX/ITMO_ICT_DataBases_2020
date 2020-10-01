<!DOCTYPE html>
</head>
<body>

<h2>Горы</h2>
<form method="post" action="mountain.php">
    <input type="submit" name="button4"
           class="button" value="Показать горы"/>
</form>
<form method="post" action="mountain.php">
    <input type="text" name="id"/>
    <input type="submit" name="button1"
           class="button" value="Найти"/>
    <input type="submit" name="button2"
           class="button" value="Удалить"/>
</form>
<form method="post" action="mountain.php">
    <span>Name</span>
    <input type="text" name="name"/>
    <span>Country</span>
    <input type="text" name="country"/>
    <span>District</span>
    <input type="text" name="district"/>
    <span>Height</span>
    <input type="text" name="height"/>
    <span>id</span>
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
    add($pdo, $_POST['name'], $_POST['country'], $_POST['district'], $_POST['height']);
} else if (array_key_exists('button4', $_POST)) {
    show($pdo);
}

function find($pdo, $id)
{
    $stmt = $pdo->query("select * FROM mountain");
    $found = false;
    while ($row = $stmt->fetch()) {
        if ($row['id'] == $id) {
            echo "<table>";
            echo "<tr><th>id</th><th>Name</th><th>Country</th><th>District</th><th>Height</th><tr>";
            $id = $row['id'];
            $name = $row['name'];
            $country = $row['country'];
            $district = $row['district'];
            $height = $row['height'];
            echo "<tr><th>$id</th><th>$name</th><th>$country</th><th>$district</th><th>$height</th><tr>";
            $found = true;
        }
    }
    if ($found != true) {
        echo "Mountain not found";
    }
}


function delete($pdo, $id)
{
    try {
        $stmt = $pdo->query("delete from \"Accident\" where id_climbing in (select id from \"Climbing\" where Id_route in (select id from \"Route\" where id_mountain=$id))");
        $stmt->execute();
        $stmt = $pdo->query("delete from \"Climbing\" where Id_route in (select id from \"Route\" where id_mountain=$id)");
        $stmt->execute();
        $stmt = $pdo->query("delete from \"Route\" where id_mountain=$id");
        $stmt->execute();
        $stmt = $pdo->query("delete from mountain where id=$id");
        $stmt->execute();
        echo "mountain with id $id deleted";
    } catch (PDOException $e) {
        echo "DataBase Error: Mount cannot be deleted<br>" . $e->getMessage();
    }
}


function add($pdo, $name, $country, $district, $height)
{
    $newid = ($pdo->query("select MAX(id) from mountain")->fetch()[0])+1;
    try {
        $stmt=$pdo->prepare("INSERT INTO mountain(id, name, country, district, height) VALUES ($newid, $name, $country, $district, $height)");
        $stmt->Execute();
        echo "mountain added";
    } catch (PDOException $e) {
        echo "DataBase Error: Mount cannot be added<br>" . $e->getMessage();
    }
}

function show($pdo)
{
    $stmt = $pdo->query("SELECT * FROM mountain");
    echo "<table>";
    echo "<tr><th>id</th><th>Name</th><th>Country</th><th>District</th><th>Height</th><tr>";
    while ($row = $stmt->fetch()) {
        $id = $row['id'];
        $name = $row['name'];
        $country = $row['country'];
        $district = $row['district'];
        $height = $row['height'];

        echo "<tr><th>$id</th><th>$name</th><th>$country</th><th>$district</th><th>$height</th><tr>";
    }
}

?>