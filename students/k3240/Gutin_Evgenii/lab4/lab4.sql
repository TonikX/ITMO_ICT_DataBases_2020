--- Запрос№1 ---
SELECT delivery.newspaper_name, delivery.edition_number, edition.cost, post_office.post_office_number
FROM delivery, edition, post_office WHERE post_office.post_office_number = delivery.post_office_number 
GROUP BY delivery.newspaper_name, delivery.edition_number, edition.cost, post_office.post_office_number

--- Запрос№2 ---
select delivery.amount, edition.cost from delivery, edition
where edition.edition_number = delivery.edition_number
and delivery.amount > 100
and edition.cost > money(1500)
group by delivery.amount, edition.cost

--- Запрос№3 ---
SELECT EXTRACT(EPOCH FROM timestamptz '2020-05-13 12:00:00') -
       EXTRACT(EPOCH FROM timestamptz '2019-05-13 12:00:00') /
	   EXTRACT(DAY FROM INTERVAL '100000 days 1 minute');
	   
--- Запрос№4 ---
SELECT CONCAT (newspaper.editor_name ||' '|| newspaper.editor_surname 
			   ||' '|| newspaper.editor_patronymic)
AS FIO FROM newspaper;

--- Запрос№5 ---
SELECT LOWER (newspaper.editor_name ), UPPER (newspaper.editor_surname)
AS lowerNameUperSurname FROM newspaper;

--- Запрос№6 ---
SELECT newspaper_name ||' '|| editor_name ||' '|| editor_surname
FROM newspaper
WHERE newspaper_name IN (
  SELECT newspaper_name
  FROM (
    SELECT newspaper_name, sum(amount)
    FROM delivery
    GROUP BY newspaper_name
  ) AS results
  WHERE sum > 100 );
  
--- Запрос№7 ---  
SELECT (MAX(cost) - MIN(cost)) AS diff
FROM edition ;

--- Запрос№8 --- 
SELECT edition.edition_number, MIN(delivery.amount) AS minKPDdelivery 
FROM edition, delivery 
WHERE edition.edition_number = delivery.edition_number
GROUP BY edition.edition_number 
HAVING MAX(delivery.amount) > 1000;

--- Запрос№9 ---
SELECT DISTINCT newspaper_name
FROM newspaper
WHERE NOT newspaper_name = ANY (SELECT newspaper_name
FROM delivery);

--- Запрос№10 ---
SELECT newspaper_name, editor_surname FROM newspaper WHERE newspaper_name='Газета 1' OR newspaper_name = 'Газета 2'
UNION
SELECT newspaper_name, editor_surname FROM newspaper  WHERE newspaper_name='Газета 3'
EXCEPT
SELECT newspaper_name,editor_surname FROM newspaper WHERE newspaper_name='Газета 1';

--- Запрос№11 ---
SELECT post_office_number ||' '|| adres
FROM post_office
WHERE post_office_number IN (
  SELECT post_office_number
  FROM (
    SELECT post_office_number, sum(amount)
    FROM delivery
    GROUP BY post_office_number
  ) AS results
  WHERE sum > 5 );
  
--- Запрос№12 ---
SELECT SUM(cost)
FROM edition 
WHERE newspaper_name = 'Газета 1'


---Запрос№13
SELECT edition.edition_number, MAX(delivery.amount) AS max_ 
FROM edition, delivery 
WHERE edition.edition_number = delivery.edition_number
GROUP BY edition.edition_number 
HAVING MAX(delivery.amount) > 1000;

--- Запрос№14 ---
SELECT newspaper.editor_name
|| ' ' || newspaper.editor_surname ||' продается по адресу ' || post_office.adres 
FROM newspaper, post_office, delivery
WHERE delivery.newspaper_name = newspaper.newspaper_name
AND delivery.post_office_number = post_office.post_office_number


--- Запрос№15 ---
SELECT * FROM edition, newspaper, post_office, printing_office, printing_order

--- Запрос№16 ---
SELECT post_office.adres, printing_office.adres from printing_office, post_office