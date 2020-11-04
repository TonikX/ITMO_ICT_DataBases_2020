--01.запрос отображающий имена служащих, работающих по четвергам и отсортированных по ФИО
SELECT DISTINCT workers.surname
FROM timetable, workers
WHERE timetable.day = 'четверг' AND workers.id = timetable.worker ORDER BY surname

--02.запрос выводит код и цену номера, стоимость которых превышает 2000р. и отсортированных по цене
SELECT DISTINCT room.room, roomtype.price
FROM room, roomtype
WHERE roomtype.price > 2000 AND room.roomtype = roomtype.id ORDER BY price

--03.запрос показывает кол-во клиентов из Москвы живших на 2 этаже
SELECT COUNT(DISTINCT(customer.name))
FROM customer, room, contract
WHERE customer.city = 'Moscow' AND contract.passport = customer.passport and contract.room = room.room and room.floor = 2

--04.запрос выводит имена служащих, которые работают на 1 этаже, но при этом не работают в понедельник
SELECT workers.surname
FROM timetable, workers
WHERE timetable.floor=1 and workers.id = timetable.worker
EXCEPT  ( 
SELECT workers.surname
FROM timetable, workers
WHERE day='понедельник' and workers.id = timetable.worker)

--05.показывает ФИО и номер в отеле
SELECT customer.surname, contract.room
FROM contract INNER JOIN customer
ON customer.passport = contract.passport

--06.считает сумму полученную с номеров людей зи СПб
SELECT
    UPPER(daterange(customer.arrival)) -
        LOWER(daterange(customer.arrival)) AS days,
	customer.name,
	roomtype.copacity,
	roomtype.price*(UPPER(daterange(customer.arrival)) -
        LOWER(daterange(customer.arrival))) as totalsum
from customer, room, roomtype, contract
where customer.city = 'Spb' and 
	customer.passport = contract.passport and
	contract.room = room.room and
	room.roomtype = roomtype.id

--07.выводит весь персонал гостиницы
SELECT firstname AS "Имя", surname AS "Фамилия" FROM workerцs
UNION
SELECT firstName, surname FROM administrator

--08.выводит всех клиентов по имени Лаврентий из Москвы
SELECT surname, city
FROM customer
WHERE (surname LIKE 'Лаврентий%') AND city = 'Moscow'
 
--09.выводит кол-во людей выселившихся в ноябре 2020 года
SELECT COUNT(DISTINCT(name))
from customer
where
EXTRACT(month FROM upper(customer.arrival)::date) = 11 and
EXTRACT(year FROM upper(customer.arrival)::date) = 2020

--10.выводит ID договора, ФИО клиентов не из Москвы, их паспортные данные
SELECT contract.contract, name AS name, customer.passport, customer.city
FROM customer INNER JOIN contract 
ON customer.passport = contract.passport 
WHERE city != 'Moscow' ORDER BY name
