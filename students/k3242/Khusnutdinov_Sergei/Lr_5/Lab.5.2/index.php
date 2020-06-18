<?php
$dbuser = 'postgres';
$dbpass = '?';
$host = 'localhost';
$dbname ='Exchange';

	echo "<h3> Вывод 1-го запроса Лабораторной работы 4.</h3>";
	$db = pg_connect("host=$host dbname=$dbname user=$dbuser password=$dbpass");
	$info = '
	select "Broker"."ID_broker", "Broker"."Sales_price", "Office"."Office_name"
	from "Exchange"."Broker"
	inner join "Exchange"."Office" ON "Broker"."FK_ID_office" = "Office"."ID_office"
	';
	$result = pg_query($db, $info);
	$result = pg_fetch_all($result);
	foreach ($result as $value) {
		echo "~~~~~~~~~~~~~~~~~~~~~~~<br/>";
		foreach ($value as $key => $value) {
			echo "|  $key = $value <br/>";
		}; echo "~~~~~~~~~~~~~~~~~~~~~~~<br/>";
	};


	echo "<br/><h3> Вывод 2-го запроса Лабораторной работы 4.</h3>";
	$db = pg_connect("host=$host dbname=$dbname user=$dbuser password=$dbpass");
	$info = '
	select "Broker"."ID_broker", "Broker"."Sales_price", "Office"."Office_name"
	from "Exchange"."Broker"
	inner join "Exchange"."Office" ON "Broker"."FK_ID_office" = "Office"."ID_office"
	where "Broker"."Sales_price" > money(100000) and "Office"."ID_office" > 3
	';
	$result = pg_query($db, $info);
	$result = pg_fetch_all($result);
	foreach ($result as $value) {
		echo "~~~~~~~~~~~~~~~~~~~~~~~<br/>";
		foreach ($value as $key => $value) {
			echo "|  $key = $value <br/>";
		}; echo "~~~~~~~~~~~~~~~~~~~~~~~<br/>";
	};


	echo "<br/><h3> Вывод 3-го (3.1) запроса Лабораторной работы 4.</h3>";
	$db = pg_connect("host=$host dbname=$dbname user=$dbuser password=$dbpass");
	$date = "date('2020-04-14')";
	$deal = '"Exchange"."Deal"';
	$lot = '"Exchange"."Lot"';
	$FK_ID_lot = '"Deal"."FK_ID_lot"';
	$ID_lot = '"Lot"."ID_lot"';
	$deal_date = '"Deal_date"';
	$info = "select * from $deal inner join $lot ON $FK_ID_lot = $ID_lot where $deal_date = $date";
	$result = pg_query($db, $info);
	$result = pg_fetch_assoc($result);
	echo "~~~~~~~~~~~~~~~~~~~~~~~<br/>";
	foreach ($result as $key => $value) {
		echo "|  $key = $value <br/>";
	}; echo "~~~~~~~~~~~~~~~~~~~~~~~<br/>";


	echo "<br/><h3> Вывод 4-го запроса Лабораторной работы 4.</h3>";
	$db = pg_connect("host=$host dbname=$dbname user=$dbuser password=$dbpass");
	$info = '
	select "Client"."Client_name", length("Client_name"), upper("Client_name"), reverse("Client_name"), initcap("Client_name")
	from "Exchange"."Client"
	';
	$result = pg_query($db, $info);
	$result = pg_fetch_all($result);
	foreach ($result as $value) {
		echo "~~~~~~~~~~~~~~~~~~~~~~~<br/>";
		foreach ($value as $key => $value) {
			echo "|  $key = $value <br/>";
		}; echo "~~~~~~~~~~~~~~~~~~~~~~~<br/>";
	};


	echo "<br/><h3> Вывод 7-го запроса Лабораторной работы 4.</h3>";
	$db = pg_connect("host=$host dbname=$dbname user=$dbuser password=$dbpass");
	$info = '
	select "Client_name", max("Account") as "Max_amount_of_money"
	from "Exchange"."Client"
	group by "Client_name"
	having max("Account") < money(490000)
	order by "Max_amount_of_money"
	';
	$result = pg_query($db, $info);
	$result = pg_fetch_all($result);
	foreach ($result as $value) {
		echo "~~~~~~~~~~~~~~~~~~~~~~~<br/>";
		foreach ($value as $key => $value) {
			echo "|  $key = $value <br/>";
		}; echo "~~~~~~~~~~~~~~~~~~~~~~~<br/>";
	};
?>
