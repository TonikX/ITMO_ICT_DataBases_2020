-- Выбор значений, заданных атрибутов из более, чем двух таблиц, с сортировкой – от 1 балла;
-- Выводит данные о том, какие услуги и материалы соответствуют каким заявкам;

SELECT request.request_id, request.request_date, service_pl.serv_name, material_pl.mat_name, request.total_cost
FROM clients.request
  INNER JOIN clients.materials
  ON materials.mat_req_id = request.request_id
  INNER JOIN clients.services
  ON services.serv_req_id = request.request_id
  INNER JOIN clients.service_pl
  ON services.serv_spl_id = service_pl.serv_id
  INNER JOIN clients.material_pl
  ON materials.mat_mpl_id = material_pl.mat_id
ORDER BY request.request_date;


-- Использование условий WHERE, состоящих из более, чем одного условия – от 1 балла;
-- Выводит данные о неоплаченных заявках с датой заявки раньше указанной;

SELECT request.request_id, request.request_date, request.total_cost, client.contact_pers, client.phone_num
FROM clients.request 
  INNER JOIN clients.client
  ON request.req_cl_id = client.client_id
WHERE (status = 'not paid') AND (request_date < '2020/03/30');


-- Использование функций для работы с датами – от 2 баллов;
-- Выводит данные об объеме, стоимости работ, выполненных исполнителями за последний квартал;

SELECT request.request_id, executor.exe_name, services.gen_cost, (work_group.end_d - work_group.start_d) AS work_scope
FROM clients.work_group 
  INNER JOIN clients.executor
  ON executor.exe_id = work_group.wg_exe_id
  INNER JOIN clients.request
  ON request.request_id = work_group.wg_req_id
  INNER JOIN clients.services
  ON services.serv_req_id = request.request_id
WHERE EXTRACT(QUARTER FROM end_d) = EXTRACT(QUARTER FROM CURRENT_DATE);

-- Использование строковых функций – от 2 баллов;
-- Перевод первого символа каждого слова в верхний регистр, а остальных в нижний регистр(исправление ошибок при заполнении базы);

SELECT INITCAP (contact_pers) AS FIO
FROM clients.client;


-- Запрос с использованием подзапросов – от 2 баллов (многострочный подзапрос - от 2 баллов); 
-- Выводит данные о заявках клиентов, у которых верно указаны банковские реквизиты;

SELECT * FROM clients.request
WHERE request.req_cl_id IN (SELECT client.client_id FROM clients.client 
							WHERE LENGTH (bank_det) = 20);


-- Вычисление групповой (агрегатной) функции – от 1 балла (с несколькими таблицами – от 2 баллов);
-- Выводит данные о суммарной стоимости материалов для оплаченных и неоплаченных заявок;

SELECT request.status, SUM(material_pl.mat_pr*materials.mat_num) AS materials_cost
FROM clients.request
  INNER JOIN clients.materials
  ON materials.mat_req_id = request.request_id
  INNER JOIN clients.material_pl
  ON materials.mat_mpl_id = material_pl.mat_id
GROUP BY request.status;


-- Вычисление групповой (агрегатной) функции с условием HAVING – от 2 баллов;
-- Выводит данные о клиентах, общая стоимость услуг в заявке которых превышает установленную(например, для предоставления скидки);

SELECT client.contact_pers, client.phone_num, client.mail, SUM(service_pl.serv_pr) 
FROM clients.request 
  INNER JOIN clients.services
  ON services.serv_req_id = request.request_id
  INNER JOIN clients.service_pl
  ON services.serv_spl_id = service_pl.serv_id
  INNER JOIN clients.client
  ON client.client_id = request.req_cl_id
GROUP BY client.contact_pers, client.phone_num, client.mail HAVING SUM(service_pl.serv_pr) > 10000;


--использование предикатов EXISTS, ALL, SOME и ANY - от 2 баллов;
-- Вывод данных о клиентах и заявках, которые они не оплатили;
				 
SELECT c.client_id, c.contact_pers, c.phone_num, request.request_id 
FROM clients.client AS c
  INNER JOIN clients.request
  ON c.client_id = request.req_cl_id
WHERE EXISTS
(SELECT req_cl_id 
 FROM clients.request AS z
 WHERE c.client_id = z.req_cl_id
 AND status = 'not paid');


-- Использование запросов с операциями реляционной алгебры (объединение, пересечение и т.д.) - от 2 баллов;
-- Выводит смежную таблицу заявок и рабочих групп, включая те заявки, в которых рабочая группа не указана;

SELECT * FROM clients.request
  LEFT JOIN clients.work_group
  ON request.request_id = work_group.wg_req_id;


-- Использование объединений запросов (inner join и т.д.) - от 2 баллов.
-- Телефонная база клиентов и сотрудников

SELECT 'client' AS relation, contact_pers AS person, phone_num
FROM clients.client
UNION
SELECT 'executor', exe_name, exe_ph
FROM clients.executor
ORDER BY person;
