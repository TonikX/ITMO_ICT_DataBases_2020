--
-- По какому адресу печатается конкретная партия газеты под конкретным названием
--
SELECT printery_address
	FROM newspapers.printery 
INNER JOIN newspapers.print ON printery.printery_name = print.printery_name
INNER JOIN newspapers.newspapers_party ON newspapers_party.party_number = print.party_number
WHERE newspapers_name = 'Herald' AND newspapers_party.party_number = 2;

--
-- Вся информация о газетах, включая количество экземпляров в каждой партии, количество экземпляров, распределяемых в каждое отделения и номера отделений, в которые есть поставка. Сортировка по названиям газет
--
SELECT newspaper.newspapers_name, editors_surname, editors_name, index, price, newspapers_party.party_number, newspapers_party.amount_of_copies, distribution_report.print_amount, post_office.office№
	FROM newspapers.newspaper
JOIN newspapers.newspapers_party ON newspapers_party.newspapers_name = newspaper.newspapers_name
JOIN newspapers.distribution_report ON distribution_report.party_number = newspapers_party.party_number
JOIN newspapers.post_office ON post_office.office№ = distribution_report.office№
ORDER BY newspaper.newspapers_name;

--
-- Объединим имя и фамилию редактора каждой газеты. Отсортируем по цене.
--
SELECT  CONCAT(newspaper.editors_name, ' ', newspaper.editors_surname )
	FROM newspapers.newspaper
ORDER BY price;

--
-- Узнаем названия газет и цены на них, стоимость которых превышает минимальную стоимость газеты
--
SELECT newspapers_name, price
	FROM newspapers.newspaper
WHERE price > (SELECT MIN(price) 
		FROM newspapers.newspaper);
		
--
-- Номер и адрес отделения, куда поступает больше минимального количества экземпляров газеты News, но в партии итого количетство газет меньше максимального
--
SELECT post_office.office№, office_address
	FROM newspapers.post_office
JOIN newspapers.distribution_report ON distribution_report.office№ = post_office.office№
JOIN newspapers.newspapers_party ON newspapers_party.party_number = distribution_report.party_number
WHERE newspapers_name = 'News' AND print_amount > (SELECT MIN(print_amount) FROM newspapers.distribution_report) AND amount_of_copies < (SELECT MAX(amount_of_copies) FROM newspapers.newspapers_party);

--
-- Покупатель решил купить ко экземпляру каждой газеты, которая продаётся в почтовом офисе №2. Сколько он должен будет заплатить?
--
SELECT SUM (price)
	FROM newspapers.newspaper
JOIN newspapers.newspapers_party ON newspapers_party.newspapers_name = newspaper.newspapers_name
JOIN newspapers.distribution_report ON distribution_report.party_number = newspapers_party.party_number
WHERE office№ = 2;
	
--
-- Выведем информацию по всем газетам, стоимость которых превышает стоимость газеты Herald
--
SELECT newspapers_name, editors_surname, editors_name, index, price
	FROM newspapers.newspaper
	WHERE price > ALL
	(SELECT price FROM newspapers.newspaper WHERE newspapers_name = 'Herald');
	
--
-- Получим полный список имеющихся в БД адресов
--
SELECT office_address
	FROM newspapers.post_office
UNION
SELECT printery_address
	FROM newspapers.printery;
	
--
-- Какие типографии, печатающие конкретную газету открыты в данный момент
--

SELECT printery.printery_name
	FROM newspapers.printery
INNER JOIN newspapers.print ON printery.printery_name = print.printery_name
INNER JOIN newspapers.newspapers_party ON newspapers_party.party_number = print.party_number
WHERE newspapers_name = 'News' AND now()::time >= printery.opening_time AND now()::time <= printery.closing_time;

--
-- Вывести названия газет и среднее количество газет в каждой партии для партий, в которых меньше 3000 экземпляров
--

SELECT  newspapers_party.newspapers_name, AVG(newspapers_party.amount_of_copies)
FROM  newspapers.newspapers_party
INNER JOIN newspapers.newspaper ON newspapers_party.newspapers_name = newspaper.newspapers_name
GROUP BY newspapers_party.newspapers_name, newspapers_party.amount_of_copies
HAVING AVG(newspapers_party.amount_of_copies) < 3000;
