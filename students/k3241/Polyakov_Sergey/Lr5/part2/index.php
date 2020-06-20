<!DOCTYPE html>
<html>

	<style>
		table, th, td {
	  		border: 1px solid black;
	  		border-collapse: collapse;
		}
	</style>

	<body>
		<a href='interface.php?table_name=Аэропорт'> Форма для таблицы "Аэропорт" </a><br>
		<a href='interface.php?table_name=Маршрут'> Форма для таблицы "Маршрут" </a><br/>
		<a href='interface.php?table_name=Посадка'> Форма для таблицы "Посадка" </a><br>
		<a href='interface.php?table_name=Рейс'> Форма для таблицы "Рейс" </a><br>
		<a href='interface.php?table_name=Самолёт'> Форма для таблицы "Самолёт" </a><br>
		<a href='interface.php?table_name=Сотрудник'> Форма для таблицы "Сотрудник" </a><br>
		<a href='interface.php?table_name=Экипаж'> Форма для таблицы "Экипаж" </a><br>

		<?php
			$dbuser = 'postgres';
			$dbpass = 'qwerty';
			$host = 'localhost';
			$dbname = 'airport_system';

			$db = pg_connect("host=$host dbname=$dbname user=$dbuser password=$dbpass");
			echo '<br><h3>Запросы из 4 лабораторной:</h3>';

			$st1 = 'Вывести длительность всех рейсов';
			$query1 = 'SELECT "ID_flight", ("Время_прилёта" - "Время_вылета") AS "Длительность полёта" FROM public."Рейс"
				ORDER BY "Длительность полёта";';
			
			$st2 = 'Вывести капитана каждого рейса';
			$query2 = 'SELECT public."Рейс"."ID_flight", public."Сотрудник"."ФИО" AS "ФИО капитана" FROM public."Рейс", public."Экипаж", public."Сотрудник" 
				WHERE public."Рейс"."ID_flight"=public."Экипаж"."ID_flight" AND public."Экипаж"."ID_worker"=public."Сотрудник"."ID_worker" AND public."Сотрудник"."Должность"=\'Капитан\'
				ORDER BY public."Рейс"."ID_flight" DESC;';
				
			$st3 = 'Вывести аэропорты отправки и прибытия для каждого рейса';
			$query3 = 'SELECT p."ID_flight", public."Аэропорт"."Страна" AS "start_country", s."finish_country" FROM public."Рейс" p 
				INNER JOIN public."Маршрут" ON public."Маршрут"."ID_route"=p."ID_route" 
				INNER JOIN public."Аэропорт" ON public."Аэропорт"."ID_airport"=public."Маршрут"."ID_airport_start"
				INNER JOIN 
				(SELECT public."Рейс"."ID_flight", public."Аэропорт"."Страна" AS "finish_country" FROM public."Рейс" 
				INNER JOIN public."Маршрут" ON public."Маршрут"."ID_route"=public."Рейс"."ID_route" 
				INNER JOIN public."Аэропорт" ON public."Аэропорт"."ID_airport"=public."Маршрут"."ID_airport_finish") s
				ON p."ID_flight"=s."ID_flight" 
				ORDER BY p."ID_flight" DESC;';

			$st4 = 'Вывести сотрудников с именем "Иван" и стажем > 10 лет';
			$query4 = 'SELECT * FROM public."Сотрудник" WHERE "ФИО" LIKE \'% Иван %\' AND "Стаж_работы" > INTERVAL \'10\' YEAR 
				ORDER BY "ID_worker" DESC;';
			
			$st5 = 'Вывести все рейсы без доп. посадок';
			$query5 = 'SELECT * FROM public."Рейс" 
				WHERE NOT EXISTS(
					SELECT * FROM public."Посадка" WHERE public."Рейс"."ID_flight"=public."Посадка"."ID_flight"
				);';
			
			$queries = array($query1, $query2, $query3, $query4, $query5);
			$strs = array($st1, $st2, $st3, $st4, $st5);
			
			for($i = 0; $i < 5; $i++) {
				$result = pg_query($db, $queries[$i]);
				$num_f = pg_num_fields($result);
				echo '<li>', $strs[$i], '</li><br>';
				echo '<table> <tr> ';

				for ($j = 0; $j < $num_f; $j++) {
					echo '<th>', pg_field_name($result, $j), '</th>';
				}
				echo '</tr> ';
				
				
				while ($row = pg_fetch_row($result)) {
					echo '<tr>';
					foreach ($row as $data) {
						echo '<td>', $data, '</td>';
					}
					echo '</tr> ';
				}
				echo " </table><br>";
			}

			pg_close($db);
		?>

	</body>
</html>