<!DOCTYPE html>
</head>
<body>

<h2>Клубы</h2>
<form method="post" action="club.php">
    <input type="submit" name="button4"
           class="button" value="Показать клубы"/>
</form>
<form method="post" action="club.php">
    <input type="text" name="id"/>
    <input type="submit" name="button1"
           class="button" value="Найти"/>
    <input type="submit" name="button2"
           class="button" value="Удалить"/>
</form>
<form method="post" action="club.php">
    <span>Имя клуба</span>
    <input type="text" name="name_club"/>
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
    add($pdo, $_POST['name_club']);
} else if (array_key_exists('button4', $_POST)) {
    show($pdo);
}

function find($pdo, $id)
{
    $stmt = $pdo->query("select * FROM \"Club\"");
    $found = false;
    while ($row = $stmt->fetch()) {
        if ($row['id_club'] == $id) {
            echo "<table>";
            echo "<tr><th>id</th><th>Name</th><tr>";
            $id = $row['id_club'];
            $name = $row['name_club'];
            echo "<tr><th>$id</th><th>$name</th><tr>";
            $found = true;
        }
    }
    if ($found != true) {
        echo "Club not found";
    }
}


function delete($pdo, $id)
{
    try {
        $stmt = $pdo->query("delete from \"Club\" where id_club=$id");
        $stmt->execute();
        echo "Club with id $id deleted";
    } catch (PDOException $e) {
        echo "DataBase Error: Club cannot be deleted<br>" . $e->getMessage();
    }
}


function add($pdo, $name_club)
{
    $newid = ($pdo->query("select MAX(id_club) from \"Club\"")->fetch()[0])+1;
    try {
        $stmt=$pdo->prepare("INSERT INTO \"Club\" (id_club, name_club) VALUES ($newid, '$name_club');");
        
        $stmt->Execute();
        echo "Club added";
    } catch (PDOException $e) {
        echo "DataBase Error: Club cannot be added<br>" . $e->getMessage();
    }
}

function show($pdo)
{
    $stmt = $pdo->query("SELECT * FROM \"Club\"");
    echo "<table>";
    echo "<tr><th>id</th><th>name</th><tr>";
    while ($row = $stmt->fetch()) {
        $id_club = $row['id_club'];
        $name_club = $row['name_club'];
        echo "<tr><th>$id_club</th><th>$name_club</th><tr>";
    }
}

?>