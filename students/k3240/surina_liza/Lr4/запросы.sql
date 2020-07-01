--01.запрос отображающий имена служащих, работающих по вторникам и отсортированных по ФИО
SELECT DISTINCT service.full_name
FROM hotel.timetable, hotel.service
WHERE timetable.weekday = 'tuesday' AND service.id_service = timetable.id_service ORDER BY full_name

--02.запрос выводит код и цену номера, стоимость которых превышает 20000р. и отсортированных по цене
ELECT DISTINCT number.number_code, type.price
FROM hotel.number, hotel.type
WHERE type.price > 20000 AND number.type_number = type.type_number ORDER BY price

--03.запрос показывает кол-во клиентов прибывших из Москвы в 2020
SELECT COUNT(DISTINCT(full_name)) 
FROM hotel.client, hotel.reserv
WHERE city = 'Moscow' AND Right(reserv.input, 4) = '2020'

--04.запрос выводит ID служащих, которые работают на 12 этаже, но при этом не работают в воскресенье
SELECT timetable.id_service 
FROM hotel.timetable, hotel.number
WHERE number.floor = 12
AND timetable.number_code = number.number_code
AND NOT EXISTS ( 
SELECT timetable.id_service
FROM hotel.timetable, hotel.number
WHERE weekday='sunday')

--05.показывает ФИО и номер в отеле
SELECT client.full_name, reserv.code_number
FROM hotel.reserv INNER JOIN hotel.client
ON client.id_client = reserv.id_client

--06.считает сумму полученную с номеров на 3 и 4 этаже
SELECT SUM(total) AS SUM_floor
FROM hotel.report, hotel.number
WHERE report.number_code = number.number_code AND (floor = 4 OR floor = 3)

--07.выводит цену и номер, у которых общая цена больше цены всех номеров и отсортированных по цене  
SELECT DISTINCT number_code, total
FROM hotel.report, hotel.type
WHERE total > ALL(
SELECT price
FROM hotel.type) ORDER BY total

--08.выводит всех клиентов по имени Рита из Москвы, сортировка по имени
SELECT full_name, city
FROM hotel.client
WHERE (full_name LIKE 'Rita%') AND city = 'Moscow'
 
--09.выводит кол-во людей выселившихся в июне 2020 года
SELECT COUNT(DISTINCT(full_name))
FROM hotel.client, hotel.reserv
WHERE client.id_client = reserv.id_client
AND left(reserv.output, 5) LIKE '%.06' AND right(reserv.output, 4) = '2020'

--10.выводит ID регистрации, ФИО клиентов не из Москвы, их паспортные данные
SELECT code_reservation, full_name AS name, passport_number AS passport
FROM hotel.client INNER JOIN hotel.reserv 
ON client.id_client = reserv.id_client 
WHERE city != 'Moscow' ORDER BY name
