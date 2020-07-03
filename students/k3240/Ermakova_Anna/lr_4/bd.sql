

--Показать контактное лицо и телефон рекламодателя, и состояние заявки, отсортировав по коду рекламодателя и состоянию заявки.

SELECT public.advertiser.contact_person, public.advertiser.number, public.request.state FROM public.advertiser, public.request WHERE public.advertiser.id = public.request.id_advertiser ORDER BY public.advertiser.id, public.request.state;


--Показать дату платежного поручения, состояние поручения и состояние заявки, отсортировав по дате платежного поручения.

SELECT public.payment_order.data_order, public.payment_order.state, public.request.state FROM public.payment_order, public.request WHERE public.request.id = public.payment_order.id_request ORDER BY public.payment_order.data_order;


--Показать данные о оплаченных платежных поручениях и с датой поручения позже указанной даты.

SELECT public.payment_order.id, public.payment_order.id_request, public.payment_order.data_order, public.payment_order.state FROM public.payment_order WHERE (status = ‘оплачено’) AND (data_order < timestamp ‘2020-01-01’);


--Показать смежную таблицу всех рекламодателей, оформивших заявку с помощью join.

SELECT * FROM public.advertiser INNER JOIN public.request ON public.advertiser.id = public.request.id_advertiser;


--Показать среднюю стоимость работ.

SELECT round(avg(public.work.cost),2) FROM public.work;
 

--Показать среднюю стоимость рекламной услуги.

SELECT round(avg(public.service.cost),2) FROM public.service;


--Показать объединенную строку даты создания и даты выполнения работы и материалы.

SELECT CONCAT(‘Создана ‘, public.work.data_of_creation, ‘, выполнена ’, public.work.data_of_completion), public.work.materials FROM public.work;


--Показать количество заявок, оформленных в агентстве.

SELECT public.adverting_agency.name, COUNT(public.request.id) FROM public.adverting_agency, public.request WHERE public.adverting_agency.id = public.request.id_advertising_agency;


--Показать статусы заявок, у которых платежное поручение создано до 2020 года.

SELECT public.request.state, public.payment_order.data_order FROM public.request, public.payment_order WHERE (data_order < timestamp ‘2020-01-01’) AND (public.request.id = public.payment_order.id_request);


--Показать запрос ФИО сотрудников с исправлением регистра, в случае ошибки при вводе данных.

SELECT INITCAP (full_name) AS FIO FROM pyblic.worker;


--Показать данные о заявках клиентов, у которых верно введен контактный номер.

SELECT * FROM public.request WHERE public.request.id_advertiser IN (SELECT public.advertiser.id FROM public.advertiser WHERE LENGTH (number) = 11);


--Показать данные о работе через запятую.

SELECT CONCAT_WS(‘,’, cost, volume, materials) FROM public.work;
 

--Показать реверсные имена рекламодателей.

SELECT REVERSE(contact_person) FROM public.advertiser;


--Показать услугу с наименьшей стоимостью.

SELECT public.service.name, public.service.cost FROM public.service WHERE cost = (SELECT MIN(cost) FROM public.service);
 
