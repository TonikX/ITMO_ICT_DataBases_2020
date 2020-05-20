CREATE DATABASE "Advertizing_Agency_Lych" WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'Russian_Russia.1251' LC_CTYPE = 'Russian_Russia.1251';


ALTER DATABASE "Advertizing_Agency_Lych" OWNER TO postgres;

\connect "Advertizing_Agency_Lych"


CREATE SCHEMA clients;


ALTER SCHEMA clients OWNER TO postgres;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Создание таблицы "Клиент"
--

CREATE TABLE clients.client (
    client_id character(10) NOT NULL,
    legal_ent character varying,
    contact_pers character varying NOT NULL,
    phome_num character varying(11) NOT NULL,
    mail character varying NOT NULL,
    bank_det character varying NOT NULL
);


ALTER TABLE clients.client OWNER TO postgres;

--
-- Создание таблицы "Исполнитель"
--

CREATE TABLE clients.executor (
    exe_id character(10) NOT NULL,
    exe_name character varying NOT NULL,
    exe_ph character varying(11) NOT NULL
);


ALTER TABLE clients.executor OWNER TO postgres;

--
-- Создание таблицы "Счет на оплату"
--

CREATE TABLE clients.invoice (
    inv_id character(10) NOT NULL,
    inv_due date,
    inv_req_id character(10) NOT NULL,
    inv_cl_id character(10) NOT NULL
);


ALTER TABLE clients.invoice OWNER TO postgres;

--
-- Создание таблицы "Прайс-лист на материалы"
--

CREATE TABLE clients.material_pl (
    mat_id character(10) NOT NULL,
    mat_name character varying(30) NOT NULL,
    features character varying(40),
    mat_pr money NOT NULL
);


ALTER TABLE clients.material_pl OWNER TO postgres;

--
-- Создание таблицы "Материалы"
--

CREATE TABLE clients.materials (
    mat_num integer NOT NULL,
    mat_cost money NOT NULL,
    mat_mpl_id character(10) NOT NULL,
    mat_req_id character(10) NOT NULL
);


ALTER TABLE clients.materials OWNER TO postgres;

--
-- Создание таблицы "Платежное поручение"
--

CREATE TABLE clients.pay_order (
    pay_ord_id character(10) NOT NULL,
    pay_date date,
    pay_inv_id character(10) NOT NULL,
    pay_req_id character(10) NOT NULL,
    pay_cl_id character(10) NOT NULL
);


ALTER TABLE clients.pay_order OWNER TO postgres;

--
-- Создание таблицы "Заявка"
--

CREATE TABLE clients.request (
    request_date date NOT NULL,
    request_id character(10) NOT NULL,
    total_cost money NOT NULL,
    work_scope character varying(30),
    status character varying NOT NULL,
    req_cl_id character(10) NOT NULL
);


ALTER TABLE clients.request OWNER TO postgres;

--
-- Создание таблицы "Прайс-лист на услуги"
--

CREATE TABLE clients.service_pl (
    serv_id character(10) NOT NULL,
    serv_type character varying NOT NULL,
    serv_name character varying NOT NULL,
    serv_pr money NOT NULL
);


ALTER TABLE clients.service_pl OWNER TO postgres;

--
-- Создание таблицы "Услуги"
--

CREATE TABLE clients.services (
    gen_cost money NOT NULL,
    serv_spl_id character(10) NOT NULL,
    serv_req_id character(10) NOT NULL
);


ALTER TABLE clients.services OWNER TO postgres;

--
-- Создание таблицы "Рабочая группа"
--

CREATE TABLE clients.work_group (
    start_d date NOT NULL,
    end_d date NOT NULL,
    wg_exe_id character(10) NOT NULL,
    wg_req_id character(1) NOT NULL
);


ALTER TABLE clients.work_group OWNER TO postgres;

--
-- Добавление данных в таблицу "Клиент"
--

INSERT INTO clients.client VALUES ('1         ', NULL, 'Ivanov Alexei Fedorovich', '89211234567', 'alex_ivanov@gmail.com', '40702810500000000001');
INSERT INTO clients.client VALUES ('2         ', 'OOO “Semitsvetik”', 'Fedotov Ilya Dmitrievich', '89112345678', 'ilya_fedotov@gmail.com', '40702810500000000007');
INSERT INTO clients.client VALUES ('3         ', 'OOO “Krasochnyi mir”', 'Sidorov Konstantin Pavlovich', '89313456789', 'konstantin_sidorov@gmail.com', '40356810500000000001');
INSERT INTO clients.client VALUES ('4         ', NULL, 'Ryabinina Ksenia Nikolaevna', '89215678904', 'ks_ryabinina@gmail.com', '40702846500000000001');
INSERT INTO clients.client VALUES ('5         ', 'OOO “Red&White”', 'Didkovskaya Anna Petrovna', '89316748637', 'didkovskaya_anna@gmail.com', '40702884600000000001');


--
-- Добавление данных в таблицу "Исполнитель"
--

INSERT INTO clients.executor VALUES ('1         ', 'Sokolov Petr Alexandrovich', '89215567483');
INSERT INTO clients.executor VALUES ('2         ', 'Grigoryev Maxim Olegovich', '89116654783');
INSERT INTO clients.executor VALUES ('3         ', 'Limonov Anatoliy Arkadyevich', '89115537846');
INSERT INTO clients.executor VALUES ('4         ', 'Filatov Nikolay Igorevich', '89113346678');
INSERT INTO clients.executor VALUES ('5         ', 'Romanov Konstantin Dmitrievich', '89315536784');


--
-- Добавление данных в таблицу "Счет на оплату"
--

INSERT INTO clients.invoice VALUES ('1         ', '2020-05-31', '5         ', '4         ');
INSERT INTO clients.invoice VALUES ('2         ', '2020-04-04', '1         ', '3         ');
INSERT INTO clients.invoice VALUES ('3         ', '2020-04-30', '3         ', '1         ');
INSERT INTO clients.invoice VALUES ('4         ', '2020-04-15', '2         ', '5         ');
INSERT INTO clients.invoice VALUES ('5         ', '2020-05-17', '4         ', '2         ');


--
-- Добавление данных в таблицу "Прайс-лист на материалы"
--

INSERT INTO clients.material_pl VALUES ('1         ', 'acrylic light scattering', 'street use', '11 500,00 ?');
INSERT INTO clients.material_pl VALUES ('2         ', 'PSBS-15', '.', '1 700,00 ?');
INSERT INTO clients.material_pl VALUES ('3         ', 'PSBS-25', '.', '2 300,00 ?');
INSERT INTO clients.material_pl VALUES ('4         ', 'PSBS-25F', '.', '2 700,00 ?');
INSERT INTO clients.material_pl VALUES ('5         ', 'PVX', 'satined', '1 400,00 ?');


--
-- Добавление данных в таблицу "Материалы"
--

INSERT INTO clients.materials VALUES (1, '11 500,00 ?', '1         ', '1         ');
INSERT INTO clients.materials VALUES (2, '23 000,00 ?', '1         ', '2         ');
INSERT INTO clients.materials VALUES (3, '6 900,00 ?', '3         ', '3         ');
INSERT INTO clients.materials VALUES (2, '23 000,00 ?', '1         ', '4         ');
INSERT INTO clients.materials VALUES (2, '3 400,00 ?', '2         ', '5         ');


--
-- Добавление данных в таблицу "Платежное поручение"
--

INSERT INTO clients.pay_order VALUES ('3         ', NULL, '3         ', '3         ', '1         ');
INSERT INTO clients.pay_order VALUES ('4         ', NULL, '4         ', '4         ', '2         ');
INSERT INTO clients.pay_order VALUES ('5         ', NULL, '5         ', '5         ', '4         ');
INSERT INTO clients.pay_order VALUES ('1         ', '2020-04-03', '1         ', '1         ', '3         ');
INSERT INTO clients.pay_order VALUES ('2         ', '2020-04-14', '2         ', '2         ', '5         ');


--
-- Добавление данных в таблицу "Заявка"
--

INSERT INTO clients.request VALUES ('2020-03-05', '1         ', '12 345,00 ?', '1', 'paid', '3         ');
INSERT INTO clients.request VALUES ('2020-03-14', '2         ', '12 345,00 ?', '1', 'paid', '5         ');
INSERT INTO clients.request VALUES ('2020-02-28', '3         ', '12 345,00 ?', '1', 'not paid', '1         ');
INSERT INTO clients.request VALUES ('2020-03-21', '4         ', '12 345,00 ?', '1', 'not paid', '2         ');
INSERT INTO clients.request VALUES ('2020-04-01', '5         ', '12 345,00 ?', '1', 'not paid', '4         ');


--
-- Добавление данных в таблицу "Прайс-лист на услуги"
--

INSERT INTO clients.service_pl VALUES ('1         ', 'outdoor signs', 'Creeping line 32 cm X 96 cm', '9 000,00 ?');
INSERT INTO clients.service_pl VALUES ('2         ', 'outdoor signs', 'double-sided light box', '12 000,00 ?');
INSERT INTO clients.service_pl VALUES ('3         ', 'outdoor advertising', 'advertising stella', '45 000,00 ?');
INSERT INTO clients.service_pl VALUES ('4         ', 'outdoor advertising', 'LED screen', '50 000,00 ?');
INSERT INTO clients.service_pl VALUES ('5         ', 'interior signs', 'Letters with light sides', '115,00 ?');


--
-- Добавление данных в таблицу "Услуги"
--

INSERT INTO clients.services VALUES ('2 000,00 ?', '2         ', '1         ');
INSERT INTO clients.services VALUES ('2 000,00 ?', '5         ', '2         ');
INSERT INTO clients.services VALUES ('1 000,00 ?', '3         ', '3         ');
INSERT INTO clients.services VALUES ('2 000,00 ?', '4         ', '4         ');
INSERT INTO clients.services VALUES ('1 000,00 ?', '1         ', '5         ');


--
-- Добавление данных в таблицу "Рабочая группа"
--

INSERT INTO clients.work_group VALUES ('2020-03-18', '2020-03-24', '1         ', '2');
INSERT INTO clients.work_group VALUES ('2020-03-01', '2020-04-07', '2         ', '3');
INSERT INTO clients.work_group VALUES ('2020-03-07', '2020-03-26', '3         ', '1');
INSERT INTO clients.work_group VALUES ('2020-03-26', '2020-04-13', '4         ', '4');
INSERT INTO clients.work_group VALUES ('2020-04-03', '2020-04-26', '3         ', '5');
INSERT INTO clients.work_group VALUES ('2020-03-18', '2020-03-24', '5         ', '2');


--
-- Установка первичных ключей и ограничений целостности
--

ALTER TABLE ONLY clients.client
    ADD CONSTRAINT client_id UNIQUE (client_id);

ALTER TABLE ONLY clients.client
    ADD CONSTRAINT client_pkey PRIMARY KEY (client_id);



ALTER TABLE ONLY clients.executor
    ADD CONSTRAINT exe_id UNIQUE (exe_id);

ALTER TABLE ONLY clients.executor
    ADD CONSTRAINT executor_pkey PRIMARY KEY (exe_id);



ALTER TABLE ONLY clients.invoice
    ADD CONSTRAINT inv_id UNIQUE (inv_id);

ALTER TABLE ONLY clients.invoice
    ADD CONSTRAINT invoice_pkey PRIMARY KEY (inv_id);



ALTER TABLE ONLY clients.material_pl
    ADD CONSTRAINT mat_id UNIQUE (mat_id);

ALTER TABLE ONLY clients.materials
    ADD CONSTRAINT materials_pkey PRIMARY KEY (mat_mpl_id, mat_req_id);



ALTER TABLE ONLY clients.material_pl
    ADD CONSTRAINT materials_pl_pkey PRIMARY KEY (mat_id);



ALTER TABLE ONLY clients.pay_order
    ADD CONSTRAINT pay_order_id UNIQUE (pay_ord_id);

ALTER TABLE ONLY clients.pay_order
    ADD CONSTRAINT pay_order_pkey PRIMARY KEY (pay_ord_id);



ALTER TABLE ONLY clients.request
    ADD CONSTRAINT request_id UNIQUE (request_id);

ALTER TABLE ONLY clients.request
    ADD CONSTRAINT request_pkey PRIMARY KEY (request_id);



ALTER TABLE ONLY clients.service_pl
    ADD CONSTRAINT serv_id UNIQUE (serv_id);

ALTER TABLE ONLY clients.service_pl
    ADD CONSTRAINT service_pl_pkey PRIMARY KEY (serv_id);



ALTER TABLE ONLY clients.services
    ADD CONSTRAINT services_pkey PRIMARY KEY (serv_spl_id);



ALTER TABLE ONLY clients.work_group
    ADD CONSTRAINT work_group_pkey PRIMARY KEY (wg_exe_id, wg_req_id);


--
-- Установка внешних ключей
--

ALTER TABLE ONLY clients.invoice
    ADD CONSTRAINT inv_cl_id FOREIGN KEY (inv_cl_id) REFERENCES clients.client(client_id);



ALTER TABLE ONLY clients.invoice
    ADD CONSTRAINT inv_req_id FOREIGN KEY (inv_req_id) REFERENCES clients.request(request_id);



ALTER TABLE ONLY clients.materials
    ADD CONSTRAINT mat_mpl_id FOREIGN KEY (mat_mpl_id) REFERENCES clients.material_pl(mat_id);



ALTER TABLE ONLY clients.materials
    ADD CONSTRAINT mat_req_id FOREIGN KEY (mat_req_id) REFERENCES clients.request(request_id);



ALTER TABLE ONLY clients.pay_order
    ADD CONSTRAINT pay_cl_id FOREIGN KEY (pay_cl_id) REFERENCES clients.client(client_id);



ALTER TABLE ONLY clients.pay_order
    ADD CONSTRAINT pay_inv_id FOREIGN KEY (pay_inv_id) REFERENCES clients.invoice(inv_id);



ALTER TABLE ONLY clients.pay_order
    ADD CONSTRAINT pay_req_id FOREIGN KEY (pay_req_id) REFERENCES clients.request(request_id);



ALTER TABLE ONLY clients.request
    ADD CONSTRAINT req_cl_id FOREIGN KEY (req_cl_id) REFERENCES clients.client(client_id);



ALTER TABLE ONLY clients.services
    ADD CONSTRAINT serv_req_id FOREIGN KEY (serv_req_id) REFERENCES clients.request(request_id);



ALTER TABLE ONLY clients.services
    ADD CONSTRAINT serv_spl_id FOREIGN KEY (serv_spl_id) REFERENCES clients.service_pl(serv_id);



ALTER TABLE ONLY clients.work_group
    ADD CONSTRAINT wg_exe_id FOREIGN KEY (wg_exe_id) REFERENCES clients.executor(exe_id);



ALTER TABLE ONLY clients.work_group
    ADD CONSTRAINT wg_req_id FOREIGN KEY (wg_req_id) REFERENCES clients.request(request_id);
