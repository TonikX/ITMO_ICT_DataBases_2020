--Вывести длительность всех рейсов
SELECT "ID_flight", ("Время_прилёта" - "Время_вылета") AS "Длительность полёта" FROM public."Рейс"
ORDER BY "Длительность полёта";

--Вывести капитана каждого рейса
SELECT public."Рейс"."ID_flight", public."Сотрудник"."ФИО" AS "ФИО капитана" FROM public."Рейс", public."Экипаж", public."Сотрудник" 
WHERE public."Рейс"."ID_flight"=public."Экипаж"."ID_flight" AND public."Экипаж"."ID_worker"=public."Сотрудник"."ID_worker" AND public."Сотрудник"."Должность"='Капитан'
ORDER BY public."Рейс"."ID_flight" DESC;

--Вывести аэропорты отправки и прибытия для каждого рейса
SELECT p."ID_flight", public."Аэропорт"."Страна" AS "start_country", s."finish_country" FROM public."Рейс" p 
INNER JOIN public."Маршрут" ON public."Маршрут"."ID_route"=p."ID_route" 
INNER JOIN public."Аэропорт" ON public."Аэропорт"."ID_airport"=public."Маршрут"."ID_airport_start"
INNER JOIN 
(SELECT public."Рейс"."ID_flight", public."Аэропорт"."Страна" AS "finish_country" FROM public."Рейс" 
INNER JOIN public."Маршрут" ON public."Маршрут"."ID_route"=public."Рейс"."ID_route" 
INNER JOIN public."Аэропорт" ON public."Аэропорт"."ID_airport"=public."Маршрут"."ID_airport_finish") s
ON p."ID_flight"=s."ID_flight" 
ORDER BY p."ID_flight" DESC;

--Вывести сотрудников с именем "Иван" и стажем > 10 лет
SELECT * FROM public."Сотрудник" WHERE "ФИО" LIKE '% Иван %' AND "Стаж_работы" > INTERVAL '10' YEAR 
ORDER BY "ID_worker" DESC;

--Вывести все рейсы без доп. посадок
SELECT * FROM public."Рейс" 
WHERE NOT EXISTS(
	SELECT * FROM public."Посадка" WHERE public."Рейс"."ID_flight"=public."Посадка"."ID_flight"
);

--Вывести Фамилию и инициалы и возраст сотрудников со средним образованием
SELECT (SUBSTRING("ФИО", 1, POSITION(' ' IN "ФИО"))
		|| SUBSTRING("ФИО", POSITION(' ' IN "ФИО") + 1, 1) || '.' 
		|| SUBSTRING("ФИО", POSITION(' ' IN SUBSTRING("ФИО", POSITION(' ' IN "ФИО"))), 1) || '.') AS "Фамилия и инициалы", "Возраст" 
FROM public."Сотрудник" WHERE "Образование" LIKE 'Среднее общее' 
ORDER BY "ID_worker" DESC;

--Вывести фио капитанов до 35
SELECT (SUBSTRING("ФИО", 1, POSITION(' ' IN "ФИО"))
		|| SUBSTRING("ФИО", POSITION(' ' IN "ФИО") + 1, 1) || '.' 
		|| SUBSTRING("ФИО", POSITION(' ' IN SUBSTRING("ФИО", POSITION(' ' IN "ФИО"))), 1) || '.') AS "Фамилия и инициалы", "Возраст" 
		FROM public."Сотрудник" WHERE "Должность" LIKE 'Капитан' AND "Возраст" <= 35
ORDER BY "ID_worker" DESC;

--Вывести кол-во рейсов для каждого второго пилота, у которого было несколько рейсов
SELECT (SUBSTRING(public."Сотрудник"."ФИО", 1, POSITION(' ' IN public."Сотрудник"."ФИО"))
		|| SUBSTRING(public."Сотрудник"."ФИО", POSITION(' ' IN public."Сотрудник"."ФИО") + 1, 1) || '.' 
		|| SUBSTRING(public."Сотрудник"."ФИО", POSITION(' ' IN SUBSTRING(public."Сотрудник"."ФИО", POSITION(' ' IN public."Сотрудник"."ФИО"))), 1) || '.') "Фамилия и инициалы", COUNT(*) "Кол-во рейсов" 
		FROM public."Рейс" 
INNER JOIN public."Экипаж" ON public."Экипаж"."ID_flight"=public."Рейс"."ID_flight" 
INNER JOIN public."Сотрудник" ON public."Экипаж"."ID_worker"=public."Сотрудник"."ID_worker"
WHERE public."Сотрудник"."Должность" LIKE 'Второй пилот'
GROUP BY public."Сотрудник"."ID_worker"
HAVING COUNT(*) > 1
ORDER BY public."Сотрудник"."ID_worker" DESC;

--Вывести процент проданных билетов для каждого рейса
SELECT public."Рейс"."ID_flight", public."Рейс"."Количество_проданных_билетов"*100/public."Самолёт"."Число_мест" AS "Процент проданных билетов" FROM public."Рейс" 
INNER JOIN public."Самолёт" ON public."Рейс"."ID_airplane"=public."Самолёт"."ID_airplane"
ORDER BY public."Рейс"."ID_flight";

--Вывести все типы самолетов, принадлежащие компаниям
SELECT p."Компания-авиаперевозчик", (SELECT STRING_AGG(s."Тип_самолёта", ', ') FROM public."Самолёт" s WHERE p."Компания-авиаперевозчик"=s."Компания-авиаперевозчик")
FROM public."Самолёт" p
GROUP BY "Компания-авиаперевозчик";
 