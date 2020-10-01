-- PostgreSQL
-- Нужно создать базу данных для хранения информации о
-- торгах на товарно-сырьевой бирже, Вариант 13
-- Выолнил студент K3243 Шахназаров Илья
-- Dumped from database version 12.2
-- Dumped by pg_dump version 12.2

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;





--
-- Создания основной схемы
--

CREATE SCHEMA Bargain;

ALTER SCHEMA Bargain OWNER TO postgres;

COMMENT ON SCHEMA Bargain IS 'Lab3_Var13';

SET default_tablespace = '';





--
-- Создание таблиц
--

-- ТАБЛИЦА СДЕЛКА

CREATE TABLE Bargain.Deal (
    ID_deal integer NOT NULL,
    FK_ID_broker integer NOT NULL,
    FK_ID_Consignment integer NOT NULL,
    Deal_date date NOT NULL,
    Transaction_amount integer NOT NULL
);
ALTER TABLE Bargain.Deal OWNER TO postgres;



-- ТАБЛИЦА ПАРТИЯ

CREATE TABLE Bargain.Consignment (
    ID_Consignment integer NOT NULL,
    W text NOT NULL,
    FK_ID_product integer NOT NULL
);
ALTER TABLE Bargain.Consignment OWNER TO postgres;



-- ТАБЛИЦА БРОКЕР

CREATE TABLE Bargain.Broker (
    ID_broker integer NOT NULL,
    Broker_salary integer NOT NULL,
    FK_Bureau_name text NOT NULL
);
ALTER TABLE Bargain.Broker OWNER TO postgres;



-- ТАБЛИЦА ПРОИЗВОДИТЕЛЬ

CREATE TABLE Bargain.Manufacturer (
    Manufacturer_name text NOT NULL,
    Production_volume integer NOT NULL
);
ALTER TABLE Bargain.Manufacturer OWNER TO postgres;


-- ТАБЛИЦА КОНТОРА

CREATE TABLE Bargain.Bureau (
    Bureau_name text NOT NULL,
    Employees_amount integer NOT NULL
);
ALTER TABLE Bargain.Bureau OWNER TO postgres;



-- ТАБЛИЦА ТОВАР

CREATE TABLE Bargain.Product (
    ID_product integer NOT NULL,
    Expiration_date date NOT NULL,
    Date_of_manufacture date NOT NULL,
    Amount integer NOT NULL,
    FK_Manufacturer_name text NOT NULL,
    FK_ID_Consignment integer NOT NULL,
    Shipping_date date NOT NULL
);
ALTER TABLE Bargain.Product OWNER TO postgres;



-- ТАБЛИЦА ДОГОВОР НА ПОКУПКУ

CREATE TABLE Bargain.Buy_contract (
    ID_buy_contract integer NOT NULL, 
    FK_ID_broker integer NOT NULL,
    FK_ID_client integer NOT NULL,
    Buy_date date NOT NULL,
    Amount_of_bought_product integer NOT NULL,
    Buy_price integer NOT NULL,
    Terms_of_purchase text NOT NULL,
    FK_ID_deal integer NOT NULL
);
ALTER TABLE Bargain.Buy_contract OWNER TO postgres;



-- ТАБЛИЦА ДОГОВОР НА ПРОДАЖУ

CREATE TABLE Bargain.Sale_contract (
    ID_sale_contract integer NOT NULL,
    FK_ID_broker integer NOT NULL,
    FK_ID_client integer NOT NULL,
    Sale_date date NOT NULL,
    Amount_of_sold_product integer NOT NULL,
    Sale_price integer NOT NULL,
    Terms_of_sale text NOT NULL,
    FK_ID_deal integer NOT NULL
);
ALTER TABLE Bargain.Sale_contract OWNER TO postgres;



-- ТАБЛИЦА КЛИЕНТ

CREATE TABLE Bargain.Client (
    ID_client integer NOT NULL,
    Client_name text NOT NULL
);
ALTER TABLE Bargain.Client OWNER TO postgres;









-- Заполнил таблицы данными через insert into 'SCHEMA_NAME'.'TABLE_NAME' values

INSERT INTO Bargain.Deal VALUES
    (1, 4, 1, '2020-04-20', 284936),
    (2, 2, 2, '2020-03-24', 3868258),
    (3, 3, 3, '2020-03-18', 296725),
    (4, 1, 4, '2020-02-10', 229632),
    (5, 2, 5, '2020-01-21', 172672);



INSERT INTO Bargain.Consignment VALUES
    (1, 'Prepayment', 1),
    (2, 'Prepayment', 2),
    (3, 'No_Prepayment', 3),
    (4, 'Prepayment', 4),
    (5, 'No_prepayment', 5);



INSERT INTO Bargain.Broker VALUES 
    (1,	13500, 5),
    (2,	14228, 4),
    (3,	26000, 2),
    (4,	92000, 3),
    (5,	50000, 1);



INSERT INTO Bargain.Manufacturer VALUES
    ('Bruh', 234824),
    ('McDonalds', 567908),
    ('YeahIMN', 156400),
    ('Hypixel', 154535),
    ('WhoTF', 10228);




INSERT INTO Bargain.Bureau VALUES
    ('NibbaTrades', 5),
    ('TPINC', 12),
    ('Iasked', 3),
    ('JojoTrade', 24),
    ('Mojang', 228);



INSERT INTO Bargain.Product VALUES
    (1, '2026-01-01', '2020-02-26', 12432, 'WhoTF', 5, '2020-04-05'),
    (2, '2025-09-30', '2019-09-30', 13224, 'Bruh', 3, '2020-03-30'),
    (3, '2020-03-20', '2019-12-20', 101, 'Hypixel', 1, '2020-03-28'),
    (4, '2022-10-10', '2018-06-12', 2345, 'McDonalds', 4, '2020-05-13'),
    (5, '2024-09-21', '2016-09-21', 8, 'YeahIMN', 4, '2019-12-08');



INSERT INTO Bargain.Buy_contract VALUES
    (1, 4, 1, '2010-09-20', 1487, 13974, 'Prepayment', 1),
    (2, 2, 4, '2019-12-17', 998, 34823, 'No_prepayment', 2),
    (3, 3, 5, '2020-03-22', 1337, 1042, 'No_repayment', 3),
    (4, 1, 3, '2018-07-07', 228, 213456, 'Prepayment', 4), 
    (5, 2, 2, '2017-01-14', 322, 1486832, 'No_prepayment', 5);



INSERT INTO Bargain.Sale_contract VALUES
    (1, 4, 1, '2020-04-20', 100, 9999, 'Prepayment', 1),
    (2, 2, 4, '2020-03-24', 400, 10210, 'Prepayment', 2),
    (3, 3, 5, '2020-03-18', 10, 600, 'Prepayment', 3),
    (4, 1, 3, '2020-02-10', 25000, 348678, 'Prepayment', 4),
    (5, 2, 2, '2020-01-21', 5002, 1004353, 'Prepayment', 5);


INSERT INTO Bargain.Client VALUES
    (1, 'Danich'),
    (2, 'Esno'),
    (3, 'Ilya'),
    (4, 'Igor'),
    (5, 'Flexus');






--
-- СВЯЗИ МЕЖДУ ТАБЛИЦАМИ (PRIMARY KEY & FOREIGN KEY)
--

ALTER TABLE ONLY Bargain.Broker
    ADD CONSTRAINT Broker_pkey PRIMARY KEY (ID_broker);

ALTER TABLE ONLY Bargain.Client
    ADD CONSTRAINT Client_pkey PRIMARY KEY (ID_client);

ALTER TABLE ONLY Bargain.Buy_contract
    ADD CONSTRAINT Buy_contract_pkey PRIMARY KEY (ID_buy_contract);

ALTER TABLE ONLY Bargain.Sale_contract
    ADD CONSTRAINT Sale_contract_pkey PRIMARY KEY (ID_sale_contract);

ALTER TABLE ONLY Bargain.Deal
    ADD CONSTRAINT Deal_pkey PRIMARY KEY (ID_deal);

ALTER TABLE ONLY Bargain.Consignment
    ADD CONSTRAINT Consignment_pkey PRIMARY KEY (ID_Consignment);

ALTER TABLE ONLY Bargain.Manufacturer
    ADD CONSTRAINT Manufacturer_pkey PRIMARY KEY (Manufacturer_name);

ALTER TABLE ONLY Bargain.Bureau
    ADD CONSTRAINT Bureau_pkey PRIMARY KEY (Bureau_name);

ALTER TABLE ONLY Bargain.Product
    ADD CONSTRAINT Product_pkey PRIMARY KEY (ID_product);


ALTER TABLE ONLY Bargain.Deal
    ADD CONSTRAINT FK_ID_broker FOREIGN KEY (FK_ID_broker) REFERENCES Bargain.Broker(ID_broker) ON UPDATE RESTRICT ON DELETE RESTRICT DEFERRABLE INITIALLY DEFERRED;

ALTER TABLE ONLY Bargain.Sale_contract
    ADD CONSTRAINT FK_ID_broker FOREIGN KEY (FK_ID_broker) REFERENCES Bargain.Broker(ID_broker) ON UPDATE RESTRICT ON DELETE RESTRICT DEFERRABLE INITIALLY DEFERRED;

ALTER TABLE ONLY Bargain.Buy_contract
    ADD CONSTRAINT FK_ID_broker FOREIGN KEY (FK_ID_broker) REFERENCES Bargain.Broker(ID_broker) ON UPDATE RESTRICT ON DELETE RESTRICT DEFERRABLE INITIALLY DEFERRED;

ALTER TABLE ONLY Bargain.Sale_contract
    ADD CONSTRAINT FK_ID_client FOREIGN KEY (FK_ID_client) REFERENCES Bargain.Client(ID_client) ON UPDATE RESTRICT ON DELETE RESTRICT DEFERRABLE INITIALLY DEFERRED;

ALTER TABLE ONLY Bargain.Buy_contract
    ADD CONSTRAINT FK_ID_client FOREIGN KEY (FK_ID_client) REFERENCES Bargain.Client(ID_client) ON UPDATE RESTRICT ON DELETE RESTRICT DEFERRABLE INITIALLY DEFERRED;

ALTER TABLE ONLY Bargain.Product
    ADD CONSTRAINT FK_Manufacturer_name FOREIGN KEY (FK_Manufacturer_name) REFERENCES Bargain.Manufacturer(Manufacturer_name) ON UPDATE RESTRICT ON DELETE RESTRICT DEFERRABLE INITIALLY DEFERRED;

ALTER TABLE ONLY Bargain.Deal
    ADD CONSTRAINT FK_ID_Consignment FOREIGN KEY (FK_ID_Consignment) REFERENCES Bargain.Consignment(ID_Consignment) ON UPDATE RESTRICT ON DELETE RESTRICT DEFERRABLE INITIALLY DEFERRED;

ALTER TABLE ONLY Bargain.Consignment
    ADD CONSTRAINT FK_ID_product FOREIGN KEY (FK_ID_product) REFERENCES Bargain.Product(ID_product) ON UPDATE RESTRICT ON DELETE RESTRICT DEFERRABLE INITIALLY DEFERRED;

B