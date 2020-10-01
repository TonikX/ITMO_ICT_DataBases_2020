CREATE SCHEMA luch;

ALTER SCHEMA luch OWNER TO postgres;

--Создание таблицы "Заявка"

CREATE TABLE luch.application (
    id_application integer NOT NULL,
    id_service integer NOT NULL,
    id_client integer NOT NULL,
    date_application date NOT NULL,
    ad_product text NOT NULL,
    status text NOT NULL,
    amount text NOT NULL
);

ALTER TABLE luch.application OWNER TO postgres;

--Создание таблицы "Список заказов" (связующей сущности для связи работников и заявок)

CREATE TABLE luch.application_list (
    id_number integer NOT NULL,
    id_service integer NOT NULL,
    id_application integer NOT NULL
);

ALTER TABLE luch.application_list OWNER TO postgres;

-- Создание таблицы "клиент"

CREATE TABLE luch.client (
    id_client integer NOT NULL,
    name_client text NOT NULL,
    phone_client text NOT NULL,
    email text NOT NULL
);

ALTER TABLE luch.client OWNER TO postgres;

--Создание таблицы "Производство" (связующей сущности для связи материалов и заявок)

CREATE TABLE luch.manufactory (
    id_material integer NOT NULL,
    id_application integer NOT NULL,
    id_service integer NOT NULL,
    quantity integer NOT NULL,
    total_price integer NOT NULL
);

ALTER TABLE luch.manufactory OWNER TO postgres;

-- Создание таблицы "Материал"

CREATE TABLE luch.material (
    id_material integer NOT NULL,
    type_material text NOT NULL,
    name_material text NOT NULL,
    characteristics text NOT NULL
);

ALTER TABLE luch.material OWNER TO postgres;

--Создание таблицы "Платежное поручение"

CREATE TABLE luch.payment_order (
    id_oreder integer NOT NULL,
    id_application integer NOT NULL,
    id_client integer NOT NULL,
    id_service integer NOT NULL,
    date_payment date NOT NULL
);

ALTER TABLE luch.payment_order OWNER TO postgres;

-- Создание таблицы "Прайс-лист"

CREATE TABLE luch.price_list (
    id_service integer NOT NULL,
    price integer NOT NULL,
    type_service text NOT NULL
);

ALTER TABLE luch.price_list OWNER TO postgres;

-- Создание таблицы "сотрудник"

CREATE TABLE luch.worker (
    id_number integer NOT NULL,
    name text NOT NULL,
    contacts text NOT NULL,
    work_experience integer NOT NULL
);

ALTER TABLE luch.worker OWNER TO postgres;

--Заполнение таблицы "заявка"

INSERT INTO luch.application (id_application, id_service, id_client, date_application, ad_product, status, amount) VALUES (1, 21, 1, '2020/02/20', 'taxi advertisement in a subway car', 'transferred', '10 banners');
INSERT INTO luch.application (id_application, id_service, id_client, date_application, ad_product, status, amount) VALUES (2, 25, 3, '2019/07/17', 'widescreen banner bike sale', 'completed', '15 banners');
INSERT INTO luch.application (id_application, id_service, id_client, date_application, ad_product, status, amount) VALUES (3, 24, 5, '2020/03/06', 'flower shop flyer advertisement', 'processed', '1000 flyers');
INSERT INTO luch.application (id_application, id_service, id_client, date_application, ad_product, status, amount) VALUES (4, 23, 2, '2020/04/05', 'animal shelter metro ad', 'completed', '20 banners');
INSERT INTO luch.application (id_application, id_service, id_client, date_application, ad_product, status, amount) VALUES (5, 22, 4, '2019/08/07', 'bus ad for clothing store', 'completed', '15 ads');

--Заполнение таблицы "список заказов"

INSERT INTO luch.application_list (id_number, id_service, id_application) VALUES (10, 22, 5);
INSERT INTO luch.application_list (id_number, id_service, id_application) VALUES (11, 23, 4);
INSERT INTO luch.application_list (id_number, id_service, id_application) VALUES (12, 21, 1);
INSERT INTO luch.application_list (id_number, id_service, id_application) VALUES (13, 25, 2);
INSERT INTO luch.application_list (id_number, id_service, id_application) VALUES (14, 24, 3);

--Заполнение таблицы "клиент"

INSERT INTO luch.client (id_client, name_client, phone_client, email) VALUES (1, 'Ivan Ivanov', '+79991110011', 'supervanya@mail.ru');
INSERT INTO luch.client (id_client, name_client, phone_client, email) VALUES (2, 'Ksenia Efremova', '+79876543210', 'ksu01@mail.ru');
INSERT INTO luch.client (id_client, name_client, phone_client, email) VALUES (3, 'Anna Smirnova', '+79112334045', 'smanya@mail.ru');
INSERT INTO luch.client (id_client, name_client, phone_client, email) VALUES (4, 'Mikhail Efimov', '+79213876544', 'efimov@mail.ru');
INSERT INTO luch.client (id_client, name_client, phone_client, email) VALUES (5, 'Leonid Gerasimov', '+79056789900', 'gerasimov@mail.ru');

--Заполнение таблицы "производство"

INSERT INTO luch.manufactory (id_material, id_application, id_service, quantity, total_price) VALUES (1, 1, 21, 10, 15000);
INSERT INTO luch.manufactory (id_material, id_application, id_service, quantity, total_price) VALUES (3, 2, 25, 10, 45000);
INSERT INTO luch.manufactory (id_material, id_application, id_service, quantity, total_price) VALUES (4, 3, 24, 1000, 200000);
INSERT INTO luch.manufactory (id_material, id_application, id_service, quantity, total_price) VALUES (5, 4, 23, 20, 50000);
INSERT INTO luch.manufactory (id_material, id_application, id_service, quantity, total_price) VALUES (2, 5, 22, 15, 30000);

--Заполнение таблицы "материал"

INSERT INTO luch.material (id_material, type_material, name_material, characteristics) VALUES (1, 'banner canvass', 'backlit', 'laminated');
INSERT INTO luch.material (id_material, type_material, name_material, characteristics) VALUES (2, 'photo paper', 'for glossy ink', 'matte');
INSERT INTO luch.material (id_material, type_material, name_material, characteristics) VALUES (3, 'canvas', 'natural cotton', 'matte');
INSERT INTO luch.material (id_material, type_material, name_material, characteristics) VALUES (4, 'PET film', 'backlit', 'satin');
INSERT INTO luch.material (id_material, type_material, name_material, characteristics) VALUES (5, 'self-adhesive films', 'light reflective', 'red/green/yellow');

--Заполнение таблицы "платежное поручение"

INSERT INTO luch.payment_order (id_oreder, id_application, id_client, id_service, date_payment) VALUES (1, 1, 1, 21, '2020/02/20');
INSERT INTO luch.payment_order (id_oreder, id_application, id_client, id_service, date_payment) VALUES (2, 3, 5, 24, '2020/03/14');
INSERT INTO luch.payment_order (id_oreder, id_application, id_client, id_service, date_payment) VALUES (3, 2, 3, 25, '2019/07/24');
INSERT INTO luch.payment_order (id_oreder, id_application, id_client, id_service, date_payment) VALUES (4, 4, 2, 23, '2020/04/06');
INSERT INTO luch.payment_order (id_oreder, id_application, id_client, id_service, date_payment) VALUES (5, 5, 4, 22, '2019/08/09');

--Заполнение таблицы "прайс-лист"

INSERT INTO luch.price_list (id_service, price, type_service) VALUES (21, 1500, 'banner');
INSERT INTO luch.price_list (id_service, price, type_service) VALUES (22, 2000, 'bus advertisement');
INSERT INTO luch.price_list (id_service, price, type_service) VALUES (23, 2500, 'advertisement in metro');
INSERT INTO luch.price_list (id_service, price, type_service) VALUES (24, 200, 'flyer advertisement');
INSERT INTO luch.price_list (id_service, price, type_service) VALUES (25, 3000, 'widescreen banner');

--Заполнение таблицы "сотрудник"

INSERT INTO luch.worker (id_number, name, contacts, work_experience) VALUES (10, 'Victor Korablev', '+79066769911', 3);
INSERT INTO luch.worker (id_number, name, contacts, work_experience) VALUES (11, 'Maria Petrova', '+79112324567', 1);
INSERT INTO luch.worker (id_number, name, contacts, work_experience) VALUES (12, 'Julia Zelenina', '+79154678893', 8);
INSERT INTO luch.worker (id_number, name, contacts, work_experience) VALUES (13, 'Konstantin Sviridov', '+79304807762', 10);
INSERT INTO luch.worker (id_number, name, contacts, work_experience) VALUES (14, 'Veronika Smirnova', '+79817160052', 2);

--Задание первичных ключей и ограничений

ALTER TABLE ONLY luch.application
    ADD CONSTRAINT id_application UNIQUE (id_application);

ALTER TABLE ONLY luch.application
    ADD CONSTRAINT application_pkey PRIMARY KEY (id_application, id_service);

ALTER TABLE ONLY luch.application_list
    ADD CONSTRAINT application_list_pkey PRIMARY KEY (id_number, id_service, id_application);

ALTER TABLE ONLY luch.client
    ADD CONSTRAINT client_pkey PRIMARY KEY (id_client);

ALTER TABLE ONLY luch.manufactory
    ADD CONSTRAINT manufactory_pkey PRIMARY KEY (id_material, id_application, id_service);

ALTER TABLE ONLY luch.material
    ADD CONSTRAINT material_pkey PRIMARY KEY (id_material);

ALTER TABLE ONLY luch.payment_order
    ADD CONSTRAINT payment_order_pkey PRIMARY KEY (id_oreder, id_application, id_client, id_service);

ALTER TABLE ONLY luch.price_list
    ADD CONSTRAINT id_service UNIQUE (id_service);

ALTER TABLE ONLY luch.price_list
    ADD CONSTRAINT price_list_pkey PRIMARY KEY (id_service);

ALTER TABLE ONLY luch.worker
    ADD CONSTRAINT worker_pkey PRIMARY KEY (id_number);

--Задание внешних ключей

ALTER TABLE ONLY luch.application
    ADD CONSTRAINT id_client FOREIGN KEY (id_client) REFERENCES luch.client(id_client);
    
ALTER TABLE ONLY luch.application
    ADD CONSTRAINT id_service FOREIGN KEY (id_service) REFERENCES luch.price_list(id_service);

ALTER TABLE ONLY luch.application_list
    ADD CONSTRAINT id_application FOREIGN KEY (id_application) REFERENCES luch.application(id_application);

ALTER TABLE ONLY luch.application_list
    ADD CONSTRAINT id_number FOREIGN KEY (id_number) REFERENCES luch.worker(id_number);

ALTER TABLE ONLY luch.application_list
    ADD CONSTRAINT id_service FOREIGN KEY (id_service) REFERENCES luch.price_list(id_service);

ALTER TABLE ONLY luch.manufactory
    ADD CONSTRAINT id_application FOREIGN KEY (id_application) REFERENCES luch.application(id_application);

ALTER TABLE ONLY luch.manufactory
    ADD CONSTRAINT id_material FOREIGN KEY (id_material) REFERENCES luch.material(id_material);

ALTER TABLE ONLY luch.manufactory
    ADD CONSTRAINT id_service FOREIGN KEY (id_service) REFERENCES luch.price_list(id_service);

ALTER TABLE ONLY luch.payment_order
    ADD CONSTRAINT id_application FOREIGN KEY (id_application) REFERENCES luch.application(id_application);

ALTER TABLE ONLY luch.payment_order
    ADD CONSTRAINT id_client FOREIGN KEY (id_client) REFERENCES luch.client(id_client);

ALTER TABLE ONLY luch.payment_order
    ADD CONSTRAINT id_service FOREIGN KEY (id_service) REFERENCES luch.price_list(id_service);