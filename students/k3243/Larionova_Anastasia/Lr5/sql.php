<?php

 	$dbuser = 'postgres';
	$dbpass = '???';
	$host = '127.0.0.1';
	$dbname= 'PoultryFarm';
	$db = pg_connect("host=$host dbname=$dbname user=$dbuser
password=$dbpass");

	$st1 = 'Вывод данных о клетке, учитывая номер ряда и цеха из других таблиц, с сортировкой';
 	$query1 = 'select "ID_cell", number_cellinrow from "PoultryFarm"."Cell"
	inner join "PoultryFarm"."Row"
	on "PoultryFarm"."Cell".number_row = "PoultryFarm"."Row".number_row
	inner join "PoultryFarm"."Tsekh"
	on "PoultryFarm"."Row".number_tsekh = "PoultryFarm"."Tsekh".number_tsekh
	order by number_cellinrow';
 	
 	$result1 = pg_query($db, $query1);
	$result1 = pg_fetch_assoc($result1);
	echo $st1;
	echo '</br>' . $result1["ID_cell"];

	$st2 = 'Вычисление общей ЗП сотрудников на фабрике';
 	$query2 = 'select sum(salary) from "PoultryFarm"."Worker"';
 	
 	$result2 = pg_query($db, $query2);
	$result2 = pg_fetch_assoc($result2);
	echo '</br>' . '</br>' . $st2;
	echo '</br>' . $result2["sum"];
	
	$st3 = 'Определение номеров цеха, которые не заняты, методом исключений';
 	$query3 = 'select number_tsekh from "PoultryFarm"."Tsekh"
except
select number_tsekh from "PoultryFarm"."Row"';
 
 	$result3 = pg_query($db, $query3);
	$result3 = pg_fetch_assoc($result3);
	echo '</br>' . '</br>' . $st3;
	echo '</br>' . $result3["number_tsekh"];
	
	$st4 = 'Вывод паспортных данных сотрудников, учитывая ограничения на ЗП и клетки';
 	$query4 = 'select passport from "PoultryFarm"."Worker"
where (salary > 19000)
order by "ID_worker" desc';
 	
 	$result4 = pg_query($db, $query4);
	$result4 = pg_fetch_assoc($result4);
	echo '</br>' . '</br>' . $st4;
	echo '</br>' . $result4["passport"];
	
	$st5 = 'Вывод длины текста паспортных данных сотрудников';
 	$query5 = 'select char_length (passport) from "PoultryFarm"."Worker"';
 
 	$result5 = pg_query($db, $query5);
	$result5 = pg_fetch_assoc($result5);
	echo '</br>' . '</br>' . $st5;
	echo '</br>' . $result5["char_length"];
	
	pg_close($db); 
	
?>
