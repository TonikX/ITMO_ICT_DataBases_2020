<?php

$dbuser = 'postgres';
$dbpass = 'Apple2001';
$host = 'localhost';
$dbname='advertising_agency';
$pdo = new PDO("pgsql:host=$host; dbname=$dbname", $dbuser, $dbpass);

?>

<!DOCTYPE html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
		<style type="text/css">
		html,
		body,
		header,
		.intro-2 {
		    background-size: cover;
		    background-color: white;
		}
		.navbar {
		    z-index: 1;
		    background-color: rgba(0,0,0,0.92);
		}
		.container-fluid{
			padding-right: 0;
			padding-left: 0;
			margin-bottom: 1em;
		}
		html,
		body,
		header,
		.view {
		  height: 100%;
		}
		</style>
	</head>
	<body>
		<div class="container-fluid">
			<div class="row">
				<div class="container-fluid">
					<nav class="navbar navbar-expand-lg navbar-dark black rgba-black-strong">
						<div class="container">
						  <a class="navbar-brand" href="main.php"><strong>Ермакова Анна</strong></a>
						  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
						    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						    <span class="navbar-toggler-icon"></span>
						  </button>
						  <div class="collapse navbar-collapse" id="navbarSupportedContent">
						    <ul class="navbar-nav mr-auto">
						      <li class="nav-item">
						        <a class="nav-link" href="advertiser.php">Рекламодатель</a>
						      </li>
						      <li class="nav-item">
						        <a class="nav-link" href="advertising_agency.php">Рекламное агенство</a>
						      </li>
						      <li class="nav-item">
						        <a class="nav-link" href="payment_order.php">Платежное поручение</a>
						      </li>
						      <li class="nav-item active">
						        <a class="nav-link" href="request.php">Заявка</a>
						      </li>
						      <li class="nav-item">
						        <a class="nav-link" href="service.php">Рекламная услуга</a>
						      </li>
						      <li class="nav-item">
						        <a class="nav-link" href="work.php">Работа</a>
						      </li>
						      <li class="nav-item">
						        <a class="nav-link" href="worker.php">Сотрудник агенства</a>
						      </li>
						    </ul>
						  </div>
						</div>
					</nav>
	   			</div>
			</div>
<h2>Заявка</h2>
<form method="post" action="request.php">
    <input type="submit" name="button4"
           class="button" value="Показать заявки"/>
</form>
<form method="post" action="request.php">
    <input type="text" name="id"/>
    <input type="submit" name="button1"
           class="button" value="Найти"/>
    <input type="submit" name="button2"
           class="button" value="Удалить"/>
</form>
<form method="post" action="request.php">
    <span>id_advertising_agency</span>
    <input type="text" name="id_advertising_agency"/>
    <span>id_advertiser</span>
    <input type="text" name="id_advertiser"/>
    <span>state</span>
    <input type="text" name="state"/>
    <input type="submit" name="button3"
           class="button" value="Добавить"/>
</form>
			      
		</div>
	</body>
</html>

<?php
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
if (array_key_exists('button1', $_POST)) {
    find($pdo, $_POST['id']);
} else if (array_key_exists('button2', $_POST)) {
    delete($pdo, $_POST['id']);
} else if (array_key_exists('button3', $_POST)) {
    add($pdo, $_POST['id_advertising_agency'], $_POST['id_advertiser'], $_POST['state']);
} else if (array_key_exists('button4', $_POST)) {
    show($pdo);
}

function find($pdo, $id)
{
    $stmt = $pdo->query("select * FROM request");
    $found = false;
    while ($row = $stmt->fetch()) {
        if ($row['id'] == $id) {
            echo "<table>";
            echo "<tr><th>id</th><th>id_advertising_agency</th><th>id_advertiser</th><th>state</th><tr>";
            $id = $row['id'];
            $id_advertising_agency = $row['id_advertising_agency'];
            $id_advertiser = $row['id_advertiser'];
            $state = $row['state'];
            echo "<tr><th>$id</th><th>$id_advertising_agency</th><th>$id_advertiser</th><th>$state</th><tr>";
            $found = true;
        }
    }
    if ($found != true) {
        echo "request not found";
    }
}


function delete($pdo, $id)
{
    try {
        $stmt = $pdo->query("delete from request where id=$id");
        $stmt->execute();
        echo "request with id $id deleted";
    } catch (PDOException $e) {
        echo "DataBase Error: request cannot be deleted<br>" . $e->getMessage();
    }
}


function add($pdo, $id_advertising_agency, $id_advertiser, $state)
{
    $newid = ($pdo->query("select MAX(id) from request")->fetch()[0])+1;
    try {
        $stmt=$pdo->prepare("INSERT INTO request (id, id_advertising_agency, id_advertiser, state) VALUES ($newid, $id_advertising_agency, $id_advertiser, $state)");
        $stmt->Execute();
        echo "request added";
    } catch (PDOException $e) {
        echo "DataBase Error: request cannot be added<br>" . $e->getMessage();
    }
}

function show($pdo)
{
    $stmt = $pdo->query("SELECT * FROM request");
    echo "<table>";
    echo "<tr><th>id</th><th>id_advertising_agency</th><th>id_advertiser</th><th>state</th><tr>";
    while ($row = $stmt->fetch()) {
        $id = $row['id'];
        $id_advertising_agency = $row['id_advertising_agency'];
        $id_advertiser = $row['id_advertiser'];
        $state = $row['state'];

        echo "<tr><th>$id</th><th>$id_advertising_agency</th><th>$id_advertiser</th><th>$state</th><tr>";
    }
}

?>
