
<?php
	
	$dbuser = 'postgres';
	$dbpass = '626626';
	$host = 'localhost';
	$dbname = 'dogs';
	$db = pg_connect("host=$host dbname=$dbname user=$dbuser
	password=$dbpass");
	$query1 = 'select count("name_exhibition") as "number_of_exh", extract(year from "date_exhibition") from "Exhibition" group by extract(year from "date_exhibition")' ;
    $query2 = 'select min("points"), "name_judge" from "Evaluation" inner join "Judge" on "judge_evaluation"
= "id_judge" where "number_evaluation" = 3 group by "name_judge"' ;
    $query3 = 'select "name_owner" from "Owner" inner join "Dog" on "Dog"."owner_dog"="Owner"."id_owner" where "Dog"."last_vac_date" <some(select"date_exhibition" from "Exhibition")' ;
    $query4 = 'select "name_exhibition" from "Exhibition" where "date_exhibition" between \'2010-01-21\' and \'2020-01-01\'' ;
    $query5 = 'select count("Dog"."club_dog") as "number_of_members", "name_club" from "Club" inner join "Dog" on "Dog"."club_dog" = "Club"."id_club" group by "name_club"' ;
	$result1 = pg_fetch_all(pg_query($db, $query1));
    $result2 = pg_fetch_all(pg_query($db, $query2));
    $result3 = pg_fetch_all(pg_query($db, $query3));
    $result4 = pg_fetch_all(pg_query($db, $query4));
    $result5 = pg_fetch_all(pg_query($db, $query5));


    pg_close($db);
?>


<h2>  Количество выставок по годам. </h2>
<table>
    <tr><th><?php echo implode('</th><th>', array_keys($result1[0])); ?></th></tr>
<?php foreach ($result1 as $row): array_map('htmlentities', $row); ?>
    <tr><td><?php echo implode('</td><td>', $row); ?></td></tr>
<?php endforeach; ?>
</table>

<br>
<h2> Минимальное количество баллов, которое каждый из судей ставил за 3е упражнение </h2>
<table>
<tr><th><?php echo implode('</th><th>', array_keys($result2[0])); ?></th></tr>
<?php foreach ($result2 as $row): array_map('htmlentities', $row); ?>
    <tr><td><?php echo implode('</td><td>', $row); ?></td></tr>
<?php endforeach; ?>
</table>

<br>
<h2>Имена владельцев, собаки которых делали прививку ранее даты какой-нибудь выставки</h2>
<table>
    <tr><th><?php echo implode('</th><th>', array_keys($result3[0])); ?></th></tr>
<?php foreach ($result3 as $row): array_map('htmlentities', $row); ?>
    <tr><td><?php echo implode('</td><td>', $row); ?></td></tr>
<?php endforeach; ?>
</table>

<br>
<h2>Названия всех выставок в период с 1.1.2010 по 21.1.2020</h2>
<table>
    <tr><th><?php echo implode('</th><th>', array_keys($result4[0])); ?></th></tr>
<?php foreach ($result4 as $row): array_map('htmlentities', $row); ?>
    <tr><td><?php echo implode('</td><td>', $row); ?></td></tr>
<?php endforeach; ?>
</table>

<br>
<h2>Число собак в каждом из клубов</h2>>
<table>
    <tr><th><?php echo implode('</th><th>', array_keys($result5[0])); ?></th></tr>
<?php foreach ($result5 as $row): array_map('htmlentities', $row); ?>
    <tr><td><?php echo implode('</td><td>', $row); ?></td></tr>
<?php endforeach; ?>
</table>
