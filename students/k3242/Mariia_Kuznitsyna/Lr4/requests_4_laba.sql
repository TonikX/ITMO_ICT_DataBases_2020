-- 1_1 Выводим номер работника, номер экипажа и номер транзита из соответсвующих таблиц, отсортированных по возрастанию номера работника

SELECT worker.id_worker, crew.id_crew, transit.id_transit FROM airport.worker, airport.crew, airport.transit ORDER BY id_worker

--1_2 Выводим номер самолёта и название компании из соответсвующих таблиц, отсортированных по возрастанию номера самолёта

SELECT plane.id_plane, company.name_company FROM airport.plane, airport.company ORDER BY id_plane

--2_1 Выводим номер рейса(когда он между 1004 и 1005), кол-во проданных билетов(когда их больше 193) и номер транзита(равный 1) из соответсвующих таблиц,  отсортированных по возрастанию кол-ва проданных билетов

SELECT flight.id_flight, voyage.number_of_sold_tickets, transit.id_transit FROM airport.transit, airport.flight, airport.voyage WHERE transit.id_transit = 1 AND voyage.number_of_sold_tickets > 193 AND flight.id_flight BETWEEN 1004 AND 1005 ORDER BY voyage.number_of_sold_tickets 

--2_2 Выводим имя работника, его контакты и номер экипажа, при условии, что номер экиажа не равен 141

SELECT worker.name_worker, worker.contacts_worker, crew.id_crew FROM airport.crew, airport.worker WHERE worker.id_crew = crew.id_crew AND crew.id_crew <> 141  

--2_3 Выводим выводим имя работника, его возраст и самолёт, на котором он работает. Работники должны иметь степень магистра, а его служебный номер не должен быть от 3 до 6

SELECT worker.name_worker, worker.age, plane.id_plane FROM airport.plane, airport.worker WHERE worker.id_plane = plane.id_plane AND worker.education = 'Master degree' AND (worker.id_worker < 3 OR worker.id_worker > 6)  

--3_1 Считаем вручную время полёта для полёта номер 1

SELECT age(voyage.date_arrival, voyage.date_departure) FROM airport.voyage WHERE voyage.id_voyage = 1

--3_2 Округяем время отправления в полёте с точностью до часа

SELECT date_trunc('hour', voyage.date_departure) FROM airport.voyage 

--4_1 Выведем имя работника и число байт в строке, отсторитуря по этому числу

SELECT worker.name_worker, octet_length(worker.name_worker) AS n FROM airport.worker ORDER BY n

--4_2 Выведем номер команды и имя его командира в верхнем регистре, второго пилота в нижнем регистре, где стюардом не является Ninth F.F.

SELECT crew.id_crew, upper(crew.commander), lower(crew.second_pilot) FROM airport.crew WHERE crew.stewards <> 'Ninth F.F.'

--4_3 Выведем авиалинию и полное название самолёта, где номер самолёта больше 1255

SELECT plane.airline, CONCAT(plane.id_plane, plane.type) FROM airport.plane WHERE plane.id_plane > 1255

--5_1 Найдём номер экипажа, где второй пилот младше 43 и имеет степень магистра

SELECT id_crew FROM airport.crew WHERE second_pilot = (SELECT name_worker FROM airport.worker WHERE education = 'Master degree' AND age < 43)

--5_2 Выведем командира и номер экипжа, где стюардессы и стюарды имеют степень бакалавра

SELECT commander, id_crew FROM airport.crew WHERE stewards IN (SELECT name_worker FROM airport.worker WHERE education = 'Bachelor degree')

--6_1 Найдём средний возраст командиров 

SELECT AVG(age) FROM airport.worker WHERE worker.name_worker IN (SELECT DISTINCT commander FROM airport.crew)

--6_2 Найдём дату самого позднего отправления и самого раннего транзита

SELECT MAX(date_departure), MIN(date_departure_transit) FROM airport.voyage, airport.transit

--6_3 Найдём суммарный опыт всех работников чей номер телефона начинается на 88001

SELECT SUM(experience) FROM airport.worker WHERE contacts_worker LIKE '88001%' 

--7_1 Найдём тип и суммарную скорость каждого типа самолётов

SELECT plane.type, SUM(speed) FROM airport.plane GROUP BY plane.type HAVING (plane.type LIKE 'f%' OR plane.type LIKE 'j%')

--7_2 Выведем поломки и количество самолётов с каждой поломкой, где кол-во в категории меньше 5

SELECT issues, COUNT (id_plane) FROM airport.repair GROUP BY issues HAVING COUNT(id_plane) < 5;

--8_1 Найдём пункты назначения в рейсах, в которых есть транзит

SELECT arrival_point FROM airport.flight WHERE EXISTS (SELECT 1 FROM airport.transit WHERE id_transit = flight.id_transit);

--8_2 Найдём командира и номера экипажа, в котором стюарды имеют степень бакалавра

SELECT commander, id_crew FROM airport.crew WHERE stewards = ANY (SELECT DISTINCT name_worker FROM airport.worker WHERE education = 'Bachelor degree')

--8_3 Выведем номер допуска, номер экипажа и наличине допуска для всех лицензий с номером большим, чем наибольший возраст из опытных рабочих и номером экипажа больше 145

SELECT id_license, id_crew, license_existence FROM airport.license WHERE id_license > ALL (SELECT age FROM airport.worker WHERE experience > 1) AND id_crew > 145

--9_1 Найдём номера самолётов, которым нужен ремонт

SELECT id_plane FROM airport.plane INTERSECT SELECT id_plane FROM airport.repair;

--9_2 Найдём номера самолётов, которым не нужен ремонт

SELECT id_plane FROM airport.plane EXCEPT SELECT id_plane FROM airport.repair;

--10_1 Выведем номер авиалинии и поломок из соединнных таблиц "самолёт" и "ремонт"

SELECT airline, issues FROM airport.plane INNER JOIN airport.repair ON repair.id_plane = plane.id_plane

--10_2 Найдём пункт отправления и транзиты из соединнных таблиц "рейс" и "транзит".

SELECT departure_point, transit_points FROM airport.transit left JOIN airport.flight ON flight.id_transit = transit.id_transit