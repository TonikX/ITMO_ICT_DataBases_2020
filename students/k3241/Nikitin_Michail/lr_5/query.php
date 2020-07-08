<!doctype html>
<html lang="ru">
<head>
  <meta charset="utf-8" />
  <title>Lab 5</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-black bg-black">
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul>
	<li class="nav-item">
        <a class="nav-link" href="query.php"><b>QUERIES</b></a>
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
        <a class="nav-link" href="treaty.php">Treaty</a>
      </li>
    </ul>
  </div>
</nav>
<?php

	

	$dbuser = 'postgres';
	$dbpass = '1';
	$host = 'localhost';
	$dbname = 'exchange';

	$db = pg_connect("host=$host dbname=$dbname user=$dbuser password=$dbpass");
	
	$st1 = 'информация о биржах и суммах их сделок за товары, цена которых больше 1000 ';
	$query1 = 'select exchange.exchange_name, deal.deal_sum from exchange.deal 
inner join exchange.exchange on exchange.deal.id_exchange=exchange.exchange.id_exchange
where id_batch = any(
	select id_batch from exchange.batch 
	where price > 1000)
group by deal_sum, exchange_name';
	
	$st2 = "информация о типе, сумме и дате договора с брокером, который работает в компании, начинающийся на 'S'";
	$query2 = 'select treaty.treaty_type, treaty.treaty_sum, treaty.treaty_date from exchange.treaty 
where id_broker = some(
	select id_broker from exchange.broker 
	where company_name like \'S%\')
group by treaty_type, treaty_sum, treaty_date;';
		
	$st3 = 'информация о клиентах и суммах их договоров, при условии, что договор заключен на сумму больше 10000';
	$query3 = 'select client.client_name, treaty.treaty_sum from exchange.treaty
left join exchange.client on exchange.client.id_client=exchange.treaty.id_client
group by client_name, treaty_sum having treaty_sum > 10000;';

	$st4 = 'производители, сделки по продуктам которых были совершены в первой половине месяца';
	$query4 = 'select firm_name from exchange.manufacturer 
where id_manufacturer = any(select id_manufacturer from exchange.batch
			where id_batch = any(select id_batch from exchange.deal
					where extract(day from deal.deal_date) < 15))
group by firm_name
order by firm_name;';
	
	$st5 = 'информация о биржах, суммарная сумма сделок которых больше 10000';
	$query5 = 'select exchange_name, sum(deal.deal_sum) from exchange.exchange 
inner join exchange.deal on exchange.deal.id_exchange=exchange.exchange.id_exchange
group by exchange_name having sum(deal.deal_sum) > 10000
order by exchange_name;';
echo '<div align="center">';
	$queries = array($query1, $query2, $query3, $query4, $query5);
	$strs = array($st1, $st2, $st3, $st4, $st5);
	
	for($i=0; $i<5; $i++) {
		$result = pg_query($db, $queries[$i]);
		$NumFields = pg_num_fields($result);
		echo '<b>'; echo $strs[$i];echo '</b>'; echo '<br>';
		
		while ($row = pg_fetch_assoc($result)) {
			foreach ($row as $data) {
				echo $data, ' ';
			}
			echo '<br>';
		}
		echo '<br>';
		echo '<br>';
	}
	pg_close($db);
	
?>
</body>
</html>