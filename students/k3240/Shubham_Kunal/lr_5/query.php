<!doctype html>
<html>
<head>
  <meta charset="utf-8" />
  <title>Labwork 5</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<h1><center><b>Interface for Database</b></center></h1>
<body style="background-color:rgb(253, 245, 230);">
<nav class="navbar navbar-expand-lg navbar-black bg-black">
  <div class="collapse navbar-collapse" id="navbarNav">
    <ol><b>
	<li class="nav-item">
        <a class="nav-link" href="query.php">Queries</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php">Exchange</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="client.php">Client</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="broker.php">Broker</a>
      </li>
	  <li class="nav-item">
        <a class="nav-link" href="contract.php">Contract</a>
      </li>
    </ul></b>
  </div>
</nav>
<?php
	$dbuser = 'postgres';
	$dbpass = '123';
	$host = 'localhost';
	$dbname = 'labwork';

	$db = pg_connect("host=$host dbname=$dbname user=$dbuser password=$dbpass");
	
	$string1 = 'Информация о биржах и суммах их сделок за товары, цена которых больше 1000 ';
	$query1 = 'select exchange.name_exchange, cost_transaction from transaction
	inner join exchange on	transaction.id_exchange=exchange.id_exchange
	where id_batch = any(select id_batch from parties where cost_product > 1000) group by cost_transaction, name_exchange;';
	
	$string2 = "Информация о типе, сумме и дате договора с брокером, который работает в компании, начинающийся на 'S'";
	$query2 = 'select type_contract, cost, date_of_purchase from contract
	where id_broker = some( select id_broker from broker where name_company like \'S%\')
	group by type_contract, cost, date_of_purchase;';
		
	$string3 = 'Информация о клиентах и суммах их договоров, при условии, что договор заключен на сумму больше 10000';
	$query3 = 'select client.name_client, cost from contract
	left join client on client.id_client=contract.id_client
	group by name_client, cost having cost > 10000;';

	$string4 = 'Производители, сделки по продуктам которых были совершены в первой половине месяца';
	$query4 = 'select name_of_firm from producer
	where id_firm = any(select id_firm from parties where id_batch = any(select id_batch from transaction
	where extract(day from transaction.date_transaction) < 15))
	group by name_of_firm
	order by name_of_firm;';
	
	$string5 = 'Информация о биржах, суммарная сумма сделок которых больше 10000';
	$query5 = 'select name_exchange, sum(transaction.cost_transaction) from exchange
	inner join transaction on
	transaction.id_exchange= exchange.id_exchange
	group by name_exchange having sum(transaction.cost_transaction) > 10000
	order by name_exchange;';
echo '<div align="center">';
	$queries = array($query1, $query2, $query3, $query4, $query5);
	$strs = array($string1, $string2, $string3, $string4, $string5);
	for($i=0; $i<5; $i++) {
		$result = pg_query($db, $queries[$i]);
		$NumFields = pg_num_fields($result);
		echo '<span style="font-size:30px"><i><tt>'; echo $strs[$i];echo '</tt></i></span>'; echo '<br>';
		while ($row = pg_fetch_assoc($result)) {
			foreach ($row as $data) {
				echo '<span style="font-size:30px">'.$data.'</span>';
			}
			echo '<br>';
		}
		echo '<br>';
	}
	pg_close($db);
?>
</body>
</html>