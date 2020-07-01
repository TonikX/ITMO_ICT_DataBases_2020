-- Показать число мест и количество проданных билетов на рейс с сортировкой по числу мест. 
SELECT chislo_mest, kolichestvo_prodannych_biletov FROM airport."samolet", airport."polet" ORDER BY chislo_mest; 

-- Показать инициалы работников при условии наличия высшего образования и возраста после 30 лет с сортировкой по алфавиту.
SELECT fio FROM airport."rabotnik" WHERE "rabotnik".uroven_obrazovania = 'Vysshee' and "rabotnik".vozrast > 30 ORDER BY fio ASC;

-- Показать инициалы работника и занимаемую им должность и снова отсортируем.
SELECT fio, zanimaemaya_dolzhnost FROM airport."rabotnik", airport."aviacompany" WHERE "aviacompany".kod_rabotnika = "rabotnik".kod_rabotnika ORDER BY fio; 		

-- Показать только те позывные и код их полёта, у которых количество проданных билетов на последний рейс превышает 120 и общее количество рейсов больше 50.
SELECT pozyvnoi, kod_poleta FROM airport."polet" WHERE kolichestvo_soverchennych_reysov > 50 and kolichestvo_prodannych_biletov > 120; 

-- Найдём только те полёты, которые случились 14 марта 2020. 
SELECT * FROM airport."polet" WHERE "data_vyleta" = date('2020-03-14'); 

-- Найдём длину в символах у выбранных позывных.
SELECT pozyvnoi, LENGTH("pozyvnoi") FROM airport."samolet"; 

-- Объединим тип самолёта (компании производителя) с номером его модели, чтобы сразу получить название всей модели.
SELECT CONCAT (tip, nomer_modeli) AS model FROM airport."samolet"; 

-- Посчитаем, сколько самолётов в ремонте с причиной поломки «шасси».
SELECT COUNT(*) FROM airport."remont" WHERE polomka = 'Shassi';

-- Вывод фамилии и возраста тех работников, “id” которых в авиакомпании занимают должность «штурмана».
SELECT fio, vozrast FROM airport."rabotnik" WHERE kod_rabotnika = (SELECT kod_rabotnika FROM airport."aviacompany" WHERE zanimaemaya_dolzhnost = 'Shturman'); 

-- Выведем “id” и занимаемую должность только того работника авиакомпании, у которого уровень образования значится как «средний».
SELECT zanimaemaya_dolzhnost, kod_rabotnika FROM airport."aviacompany" WHERE kod_rabotnika IN (SELECT kod_rabotnika FROM airport."rabotnik" WHERE uroven_obrazovania = 'Srednee'); 

-- Показать даты вылетов и сколько времени с тех пор прошло (до 19.05.2020 - день создания файла) в период с 16 марта 2020-ого по 16 апреля.
SELECT data_vyleta, age(data_vyleta) FROM airport."polet" WHERE data_vyleta BETWEEN '2020-03-16' AND '2020-04-16';

-- Показать возраст самого пожилого работника в компании.
SELECT MAX(vozrast) FROM airport."rabotnik"; 

-- Показать тип модели с агрегатной функцией подсчёта общего количество моделей с группировкой с условием.
SELECT tip, COUNT(tip) AS kolichestvo_modeley FROM airport."samolet" GROUP BY tip HAVING COUNT(tip) < 4; 

-- Показать общий возраст всех сотрудников и число мест в самолётах всего (для математической задачки, к примеру).
SELECT sum(vozrast) AS obshiy_vozrast, sum(chislo_mest) AS chislo_mest_vsego FROM airport."rabotnik", airport."samolet"; 

-- Показать номера рейсов, к которым у экипажа 120 есть допуск.
SELECT nomer_reysa FROM airport."dopusk" WHERE kod_ekipazha = 120 and EXISTS (SELECT * FROM airport."dopusk" WHERE nalichie_dopuska = true);

-- Показать информацию о модели(-ях) (тип, номер, число мест), у которой(-ых) скорость полёта больше, чем у любого лайнера от компании «Airbus».
SELECT tip, nomer_modeli, chislo_mest FROM airport."samolet" WHERE skorost_poleta > ALL (SELECT skorost_poleta FROM airport."samolet" WHERE tip = 'Airbus');
