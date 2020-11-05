--1. Список классных руководителей для каждого класса
SELECT Учитель.ФИО AS Классрук, Класс.Код AS Класс
FROM "Школа"."Учитель", "Школа"."Класс"
WHERE Класс.Классный_руководитель = Учитель.id ORDER BY Учитель.ФИО;

--2. Расписание с ФИО учителя и временем вместо id
SELECT Класс, concat_ws(', ', День_недели, Номер_урока) AS Время, Предмет, Учитель.ФИО, Расписание.Кабинет
FROM "Школа"."Расписание", "Школа"."Учитель", "Школа"."Время"
WHERE Расписание.Время = Время.id AND Расписание.Учитель = Учитель.id;
 
--3. Списки учителей, выходных в понедельник
SELECT * FROM "Школа"."Учитель" WHERE Учитель.id NOT IN
(SELECT DISTINCT Учитель.id 
FROM "Школа"."Расписание", "Школа"."Учитель", "Школа"."Время"
WHERE Расписание.Время = Время.id AND День_недели = 'Пн' 
AND Расписание.Учитель = Учитель.id) ORDER BY id;
 
--4. Списки учеников каждого класса
SELECT Класс, json_agg(concat_ws(', ', id, ФИО, Пол)) 
FROM "Школа"."Ученик" GROUP BY Класс;
 
--5. Информация обо всех 10-х классах
SELECT * FROM "Школа"."Класс" WHERE Код LIKE '10%';
 
--6. Определение профильности предметов на основании кабинетов, в которых по ним проводят занятия
SELECT DISTINCT Расписание.Предмет AS Предмет, Кабинет.Профильный
FROM "Школа"."Расписание", "Школа"."Кабинет"
WHERE Расписание.Кабинет = Кабинет.Номер;
 
--7.1. Список учеников, у которых по неведомым причинам нет ни одной четвертной оценки
SELECT * FROM "Школа"."Ученик"
LEFT JOIN "Школа"."Оценка" ON Ученик.id = Оценка.Ученик
WHERE Оценка.Ученик IS NULL;

--7.2. Количество учеников, у которых по неведомым причинам нет ни одной четвертной оценки
SELECT COUNT(*) FROM "Школа"."Ученик"
LEFT JOIN "Школа"."Оценка" ON Ученик.id = Оценка.Ученик
WHERE Оценка.Ученик IS NULL;
 
--8.1. Средние оценки каждого ученика
SELECT Ученик.ФИО, avg(Оценка.Оценка) AS Оценки
FROM "Школа"."Ученик", "Школа"."Оценка"
WHERE Ученик.id = Оценка.Ученик GROUP BY Ученик.ФИО;
 
--8.2. Средние оценки по классам
SELECT Ученик.Класс, avg(Оценка.Оценка) AS Оценки
FROM "Школа"."Ученик", "Школа"."Оценка"
WHERE Ученик.id = Оценка.Ученик GROUP BY Ученик.Класс;

--8.3. Средние оценки по предметам
SELECT Оценка.Предмет, avg(Оценка.Оценка) AS Оценки
FROM "Школа"."Оценка" GROUP BY Оценка.Предмет;

--8.4. Средний балл по школе
SELECT avg(Оценка.Оценка) AS Оценки FROM "Школа"."Оценка";
 
--9. Список учеников, средняя оценка которых ниже средней оценки по школе
SELECT Ученик.ФИО, avg(Оценка.Оценка) AS Оценки
FROM "Школа"."Ученик", "Школа"."Оценка"
WHERE Ученик.id = Оценка.Ученик GROUP BY Ученик.ФИО
HAVING avg(Оценка.Оценка) < (SELECT avg(Оценка.Оценка) AS ОценкиFROM "Школа"."Оценка");
 