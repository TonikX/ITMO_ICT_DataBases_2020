<?php
echo "<title>Запросы</title>";

    $dbuser = 'postgres';
	$dbpass = '123456789';
	$host = '127.0.0.1';
	$dbport = '5433';
	$dbname= 'lab3';
	$db = pg_connect("host=$host port=$dbport dbname=$dbname user=$dbuser
	password=$dbpass");

	$query1desc = 'Вывести время и день недели приёма в кабинете с идентификатором «1»:';
	$query1 = 'SELECT "Clinic"."Reception".Reception_Date_Time FROM "Clinic"."Reception" 
	INNER JOIN "Clinic"."Room" ON "Clinic"."Reception".ID_reception = "Clinic"."Room".ID_room
	WHERE "Clinic"."Room".ID_room = 1
	GROUP BY "Clinic"."Reception".Reception_Date_Time';

    $query2desc = 'Вывести пациентов и их диагнозы:';
    $query2 = 'SELECT "Clinic"."Medical_book".Owner_name, "Clinic"."Medical_book".FK_ID_Diagnose, "Clinic"."Diagnoses".Diagnose_name FROM "Clinic"."Medical_book" 
	INNER JOIN "Clinic"."Diagnoses" ON "Clinic"."Medical_book".FK_ID_Diagnose = "Clinic"."Diagnoses".ID_Diagnose 
	ORDER BY FK_ID_Diagnose';

    $query3desc = 'Вывести количество пациентов:';
    $query3 = 'SELECT COUNT(*) FROM "Clinic"."Patient"';

    $query4desc = 'Вывести всю информацию из медицинской карты с наивысшим номером приёма:';
    $query4 = 'SELECT DISTINCT "Clinic"."Medical_book".* 
	FROM "Clinic"."Medical_book" 
	WHERE NOT "Clinic"."Medical_book".Receptions < SOME (SELECT "Clinic"."Medical_book".Receptions FROM "Clinic"."Medical_book")';

    $query5desc = 'Вывести суммарный доход со всех уже оплаченных приёмов:';
    $query5 = 'SELECT SUM("Clinic"."Payment".Summ) AS Income FROM "Clinic"."Payment" WHERE Status = 1' ;

	$res1 = pg_fetch_all(pg_query($db, $query1));
    $res2 = pg_fetch_all(pg_query($db, $query2));
    $res3 = pg_fetch_all(pg_query($db, $query3));
    $res4 = pg_fetch_all(pg_query($db, $query4));
    $res5 = pg_fetch_all(pg_query($db, $query5));

    pg_close($db);
?>

<a href = 'index.php'>Главная страница</a> 

<h2><?php echo $query1desc; ?></h2>
<table>
  <thead>
    <tr>
      <th><?php echo implode('</th><th>', array_keys($res1[0])); ?></th>
    </tr>
  </thead>
  <tbody>
<?php foreach ($res1 as $row): array_map('htmlentities', $row); ?>
    <tr>
      <td><?php echo implode('</td><td>', $row); ?></td>
    </tr>
<?php endforeach; ?>
  </tbody>
</table>
<br>

<h2><?php echo $query2desc; ?></h2>
<table>
  <thead>
    <tr>
      <th><?php echo implode('</th><th>', array_keys($res2[0])); ?></th>
    </tr>
  </thead>
  <tbody>
<?php foreach ($res2 as $row): array_map('htmlentities', $row); ?>
    <tr>
      <td><?php echo implode('</td><td>', $row); ?></td>
    </tr>
<?php endforeach; ?>
  </tbody>
</table>
<br>

<h2><?php echo $query3desc; ?></h2>
<table>
  <thead>
    <tr>
      <th><?php echo implode('</th><th>', array_keys($res3[0])); ?></th>
    </tr>
  </thead>
  <tbody>
<?php foreach ($res3 as $row): array_map('htmlentities', $row); ?>
    <tr>
      <td><?php echo implode('</td><td>', $row); ?></td>
    </tr>
<?php endforeach; ?>
  </tbody>
</table>
<br>

<h2><?php echo $query4desc; ?></h2>
<table>
  <thead>
    <tr>
      <th><?php echo implode('</th><th>', array_keys($res4[0])); ?></th>
    </tr>
  </thead>
  <tbody>
<?php foreach ($res4 as $row): array_map('htmlentities', $row); ?>
    <tr>
      <td><?php echo implode('</td><td>', $row); ?></td>
    </tr>
<?php endforeach; ?>
  </tbody>
</table>
<br>

<h2><?php echo $query5desc; ?></h2>
<table>
  <thead>
    <tr>
      <th><?php echo implode('</th><th>', array_keys($res5[0])); ?></th>
    </tr>
  </thead>
  <tbody>
<?php foreach ($res5 as $row): array_map('htmlentities', $row); ?>
    <tr>
      <td><?php echo implode('</td><td>', $row); ?></td>
    </tr>
<?php endforeach; ?>
  </tbody>
</table>
<br>
