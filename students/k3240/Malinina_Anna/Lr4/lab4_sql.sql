--1.1	Показать имена участников клуба, название клуба, страну клуба, отсортировав по ид клубов и именам участников.
SELECT members.name, "Club".name AS club, "Club".country FROM members, "Club" WHERE "Club".id = members.id_club ORDER BY members.id_club, members.name;
 
--1.2	Показать название горы, сложность маршрута, проходящего через эту гору, высоту горы, отсортировав по названию горы.
SELECT mountain.name, difficulty, height FROM mountain, "Route" WHERE "Route".id_mountain = mountain.id ORDER BY mountain.name;
 
--2.1	Показать название горы и страну, где район горы – Гималаи и высота меньше 8000.
SELECT name, country FROM mountain WHERE district = 'Гималаи' AND height < 8000;
 
--2.2	Показать имена участников и описание происшествий, которые с ними произошли между 5 января 2020 и 10 января 2020.
SELECT members.name, description FROM members, "Accident" WHERE ("Accident".id_member = members.id) AND ("Accident".date BETWEEN '2020-01-05' AND '2020-01-10');
 
--3.1	Показать день недели, в который случилось происшествие между 1 февраля 2020 и 1 мая 2020.
SELECT EXTRACT(isodow FROM (SELECT date FROM "Accident" INNER JOIN members ON (id_member = members.id) WHERE date BETWEEN '2020-02-1' AND '2020-05-01'));
 
--3.2	Показать дату происшествия и сколько времени прошло с происшествия, случившегося между 1 февраля 2020 и 1 мая 2020
SELECT date, age(date) FROM "Accident" INNER JOIN members ON (id_member = members.id) WHERE date BETWEEN '2020-02-1' AND '2020-05-01';
 	
--4.1    Вывести дату происшествия, описание и имя участника через запятую.
SELECT concat_ws(', ',name, date, description) FROM "Accident" INNER JOIN members ON "Accident".id_member=members.id;
 
--4.2	Показать перевернутые имена участников
SELECT REVERSE(name) FROM members;
 
--5.1	Пользователь вводит диапазон дат и ему выводится список альпинистов, участвовавших в восхождениях за этот период (Запрос из текста задания)
SELECT DISTINCT members.name FROM members, "Climbing", "Group_member" WHERE members.id IN (SELECT "Group_member".id_member FROM "Climbing" INNER JOIN "Group_member" ON "Climbing".id_group = "Group_member".id_group WHERE "Climbing".climbing_end_real BETWEEN '2018-10-01' AND '2020-10-01');
 
--5.2	Пользователь может просмотреть горы, на которых не было восхождений  (запрос из текста задания)
SELECT mountain.name FROM mountain WHERE mountain.id NOT IN (SELECT "Route".id_mountain FROM "Route", "Climbing" WHERE "Climbing".id_route = "Route".id AND "Climbing".climbing_end_real IS NOT NULL);
 
--6.1	Пользователь выбирает гору и ему показывается количество альпинистов, побывавших на этой горе (запрос из текста задания)
SELECT count(*) FROM members WHERE members.id IN (SELECT "Group_member".id_member FROM mountain INNER JOIN "Route" ON mountain.id = "Route".id_mountain INNER JOIN "Climbing" ON "Route".id = "Climbing".id_route INNER JOIN "Group_member" ON "Climbing".id_group = "Group_member".id_group WHERE "Climbing".climbing_end_real IS NOT NULL AND mountain.name = 'Белуха');
 
--6.2 Показать гору с минимальной высотой
SELECT name , height FROM mountain WHERE height = (SELECT MIN(height) FROM mountain);
 
--7.1	Вывести названия гор и их высоты, где высота ниже 6130м
SELECT name, max(height) FROM mountain GROUP BY name HAVING max(height) <6135;
 
--7.2	Вывести названия гор и их высоты, где название начинается с “Г”, а высота больше 6136
SELECT name, min(height) FROM mountain WHERE district LIKE 'Г%' GROUP BY name HAVING min(height) > 6136;
 
--8.1	Выбрать участников, которые состоят в альпинистских группах
SELECT members.name FROM members WHERE EXISTS(SELECT id_member FROM "Group_member", members WHERE id_member = members.id)
 
--8.2	Вывести информацию о клубах, ид которых 2 и 3.
SELECT * FROM "Club" WHERE id = ANY(ARRAY[2,4]);
 
--9.1	 Показать страны, в которых расположены клубы или горы.
SELECT country FROM "Club" UNION SELECT country FROM mountain;
 
--9.2	Выбрать страны, в которых расположены клубы и горы.
SELECT country FROM "Club" INTERSECT SELECT country FROM mountain;
 
--10.1	Показать имена участников клуба, название клуба, страну клуба, отсортировав по ид клубов и именам участников.
SELECT members.name, "Club".name AS club, "Club".country FROM members INNER JOIN "Club" ON ("Club".id = members.id_club) ORDER BY "Club".country;
 
--10.2	Показать имена участников, ид группы, в которую они входят, и статус восхождения
SELECT name, "Group".id, climbing_status FROM members LEFT OUTER JOIN "Group_member" ON members.id = "Group_member".id_member INNER JOIN "Group" ON "Group_member".id_group = "Group".id;	

