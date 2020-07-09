--Вывести все номера заявок, статус которых – «выполнено» и дата заявки ранее 2020 года
SELECT id_application FROM luch.application WHERE application.status = 'completed' 
AND application.date_application < '2020/01/01';

--Показать информацию о заказах, оставленных 6 марта 2020 года
SELECT * FROM luch.application WHERE date_application = '2020/03/06';

--Показать информацию о самом опытном работнике агентства
SELECT * FROM luch.worker WHERE "work_experience" IN (SELECT MAX("work_experience") FROM luch.worker);

--Показать номер заявки, код услуги, дату оплаты заявки и количество времени, прошедшего с того момента
SELECT id_application, id_service, date_payment, age(date_payment) FROM luch.payment_order;

--Показать все рекламные продукты и их объем, выполненные сотрудником Марией Петровой
SELECT ad_product, amount FROM luch.application JOIN luch.application_list 
ON application_list.id_application = application.id_application JOIN luch.worker 
ON worker.id_number = application_list.id_number WHERE worker.name = 'Maria Petrova' 
AND application.status = 'completed';

--Подсчет количества знаков в телефонных номерах работников и вывод имени, 
--номеров телефонов и количества знаков в их записи тех, у кого корректно указан номер телефона (12 знаков)
SELECT name, contacts, length(contacts) FROM luch.worker WHERE length(contacts) = 12;

--Показать стоимость самой бюджетной услуги агентства
SELECT MIN(price) FROM luch.price_list;

--Найдем выручку агентства за все время работы
SELECT SUM(total_price) FROM luch.manufactory;

--Выведем название и тип материала, а также количество продукции, при изготовлении которой был использован этот материал. 
--Сгруппируем по количеству продукции, от большего к меньшему.
SELECT name_material, type_material, quantity FROM luch.material JOIN luch.manufactory 
ON manufactory.id_material = material.id_material ORDER BY quantity DESC;

--Вывести информацию об услугах, стоимость которых находится между 2 и 3 тысячами рублей за единицу продукции
SELECT * FROM luch.price_list WHERE price BETWEEN 2000 AND 3000;

--Найдем количество времени, в течение которого Михаил Ефимов оплачивал свой заказ
SELECT client.name_client, age(payment_order.date_payment, application.date_application) 
AS duration FROM luch.client JOIN luch.application 
ON application.id_client = client.id_client JOIN luch.payment_order 
ON payment_order.id_application = application.id_application 
WHERE client.name_client = 'Mikhail Efimov';

--Показать информацию о материалах, которые были использованы в любом заказе с общей стоимостью выше 40 тысяч
SELECT * FROM luch.material 
WHERE id_material IN (SELECT id_material FROM luch.manufactory WHERE total_price > 40000);

--Показать номера заказов, для изготовления которых необходим материал с названием «backlit».
SELECT id_application FROM luch.manufactory WHERE id_material = 
ANY (SELECT id_material FROM luch.material WHERE name_material = 'backlit');

--Вывести информацию о клиентах, чей заказ находится в процессе исполнения
SELECT * FROM luch.client WHERE EXISTS 
(SELECT id_client FROM luch.application WHERE application.id_client = client.id_client 
AND application.status = 'processed');

--Создадим базу работников и заказчиков для удобного поиска по людям, фигурирующим в агентстве. 
--Найдем ФИ, контактные данные и роль в агентстве людей, чье имя начинается на букву К; отсортируем в алфавитном порядке.
SELECT name, contacts, 'worker' AS role FROM luch.worker WHERE worker.name LIKE 'K%'
UNION
SELECT name_client, phone_client, 'client' AS role FROM luch.client 
WHERE client.name_client LIKE 'K%' ORDER BY name ASC;

--Теперь проверим, все ли работники указали российские номера. 
--Так как мы уже знаем, что все они имеют длину 12 цифр – выведем 2 первых символа, чтобы проверить код страны.
SELECT name, substring(worker.contacts from 1 for 2) FROM luch.worker;

--Выведем количество изделий и найдем сумму, вырученную за заказы, в которых было данное количество изделий. 
--Используем фильтр по количеству изделий: меньше или равно 15.
SELECT quantity, SUM(total_price) FROM luch.manufactory GROUP BY quantity HAVING quantity <= 15;

--С помощью операции разности реляционной алгебры проверим, какие услуги агентство еще ни разу не оказывало 
--(их коды услуг отсутствуют в таблице «заявки»)
SELECT id_service FROM luch.price_list EXCEPT SELECT id_service FROM luch.application;
