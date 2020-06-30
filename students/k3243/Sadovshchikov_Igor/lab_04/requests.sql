-- Получаем имя, фамилию и дату рождения водителей, отсортированных по стажу вождения
SELECT first_name, last_name, experience, birthday
FROM driver
INNER JOIN passport ON passport.serial_num = driver.serial_num
ORDER BY experience

-- Получаем информацию обо всех автобусах, которые не находятся в ремонте и используют дизельное топливо
SELECT *
FROM bus
WHERE status='в эксплуатации' AND fuel_type='дизель'

-- Получаем имя, фамилию, и опыт водителей, родившихся после 1980-го года, отсортировав по убыванию возраста
SELECT first_name, last_name, experience, birthday FROM driver
INNER JOIN passport ON passport.serial_num = driver.serial_num
WHERE birthday > '01.01.1980'
ORDER BY birthday

-- Для водителей, имя которых заканчивается на '-ий' получаем гос. номера автобусов, на которых они осуществляли выезд, дату выездов и стоимость проезда
SELECT first_name, last_name, gos_nomer, tariff
FROM driver
INNER JOIN passport ON passport.serial_num = driver.serial_num
INNER JOIN departure ON departure.serial_num = driver.serial_num
WHERE first_name LIKE '%ий'


-- Получаем серию и номер паспорта вместе с объединенными именем и фамилией водителей
SELECT serial_num, CONCAT_WS('',
							 first_name,
							 ' ',
							 last_name) AS name_surmane
FROM passport

-- Информация об органе, выдавшем паспорт записана капсом, что может вызвать неудобства
-- Выведем информацию, озаглавив только первую букву
SELECT serial_num, first_name, last_name,
CONCAT_WS(
	'',
	UPPER(LEFT(issued_by, 1)),
	LOWER(SUBSTRING(issued_by, 2, length(issued_by))))
FROM passport

-- С помощью более лаконичного выражения, можно озаглавить первую букву каждого слова
SELECT INITCAP(issued_by) FROM passport

-- Вычисляем водителей, попадавших в неприятности
SELECT serial_num, first_name, last_name
FROM passport
WHERE serial_num
IN (SELECT serial_num
	FROM departure
	WHERE departure_num
	IN (SELECT departure_num
		FROM incident))

-- Вычисляем среднюю длительность всех маршрутов, начальными пунктами которых являются станции метро
SELECT ROUND(AVG(route_length)) AS avg_length
FROM route
INNER JOIN departure ON departure.route_num = route.route_num
WHERE start_point LIKE ANY (ARRAY['м.%', 'ст. м.%', 'метро%'])


-- Получаем информацию о количестве водителей, получающих определенную зарплату, при условии, что водителей в данной категории больше двух
SELECT salary, COUNT(serial_num) AS driver_amount
FROM driver
GROUP BY salary
HAVING COUNT(serial_num) > 2

-- Получаем информацию об автобусах, которые не попадали в происшествия
SELECT bus.*
FROM departure AS dep
INNER JOIN bus ON bus.gos_nomer = dep.gos_nomer
WHERE dep.status = 'завершен'
AND NOT EXISTS (SELECT departure_num FROM incident WHERE departure_num=dep.departure_num)

-- Какие из автобусов, имеющихся в автопарке, хотя бы раз выезжали по маршруту?
SELECT gos_nomer FROM bus
INTERSECT
SELECT gos_nomer FROM departure

-- Какие не выезжали ни разу?
SELECT gos_nomer FROM bus
EXCEPT
SELECT gos_nomer FROM departure
