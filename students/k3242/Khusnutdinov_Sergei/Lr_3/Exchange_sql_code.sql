--
-- PostgreSQL database dump
-- Нужно создать базу данных для биржи
-- Выолнил студент K3242 Khusnutdinov Sergei
--

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

CREATE SCHEMA "Exchange";

ALTER SCHEMA "Exchange" OWNER TO postgres;

COMMENT ON SCHEMA "Exchange" IS 'Lab_Work_3';

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Создание таблиц в схеме
--

CREATE TABLE "Exchange"."Broker" (
    "ID_broker" integer NOT NULL,
    "Sales_price" money NOT NULL,
    "Sales_count" integer NOT NULL,
    "FK_ID_office" integer NOT NULL
);

ALTER TABLE "Exchange"."Broker" OWNER TO postgres;


CREATE TABLE "Exchange"."Client" (
    "ID_client" integer NOT NULL,
    "Client_name" text NOT NULL,
    "Account" money NOT NULL
);

ALTER TABLE "Exchange"."Client" OWNER TO postgres;


CREATE TABLE "Exchange"."Contract_to_buy" (
    "ID_contract_to_purchase" integer NOT NULL,
    "FK_ID_broker" integer NOT NULL,
    "FK_ID_client" integer NOT NULL,
    "Buy_date" date NOT NULL,
    "Amount_of_bought_product" integer NOT NULL,
    "Buying_price" money NOT NULL,
    "Terms_of_purchase" text NOT NULL
);

ALTER TABLE "Exchange"."Contract_to_buy" OWNER TO postgres;


CREATE TABLE "Exchange"."Contract_to_sell" (
    "ID_contract_to_sale" integer NOT NULL,
    "FK_ID_broker" integer NOT NULL,
    "FK_ID_client" integer NOT NULL,
    "Sale_date" date NOT NULL,
    "Amount_of_sold_product" integer NOT NULL,
    "Selling_price" money NOT NULL,
    "Terms_of_sale" text NOT NULL
);

ALTER TABLE "Exchange"."Contract_to_sell" OWNER TO postgres;


CREATE TABLE "Exchange"."Deal" (
    "ID_deal" integer NOT NULL,
    "FK_ID_broker" integer NOT NULL,
    "FK_ID_lot" integer NOT NULL,
    "Deal_date" date NOT NULL
);

ALTER TABLE "Exchange"."Deal" OWNER TO postgres;


CREATE TABLE "Exchange"."Lot" (
    "ID_lot" integer NOT NULL,
    "Lot_price" money NOT NULL,
    "Lot_delivery_conditions" text NOT NULL,
    "FK_ID_product" integer NOT NULL
);

ALTER TABLE "Exchange"."Lot" OWNER TO postgres;


CREATE TABLE "Exchange"."Manufacturing_firm" (
    "ID_firm" integer NOT NULL,
    "Firm_name" text NOT NULL
);

ALTER TABLE "Exchange"."Manufacturing_firm" OWNER TO postgres;


CREATE TABLE "Exchange"."Office" (
    "ID_office" integer NOT NULL,
    "Office_name" text NOT NULL
);

ALTER TABLE "Exchange"."Office" OWNER TO postgres;


CREATE TABLE "Exchange"."Product" (
    "ID_product" integer NOT NULL,
    "Expiration_date" date NOT NULL,
    "Date_of_manufacture" date NOT NULL,
    "Amount" integer NOT NULL,
    "FK_ID_firm" integer NOT NULL
);

ALTER TABLE "Exchange"."Product" OWNER TO postgres;

--
-- Заполнение таблиц данными было выполнено через "insert into 'Названиесхемы'.'Названиетаблицы' values"
--

COPY "Exchange"."Broker" ("ID_broker", "Sales_price", "Sales_count", "FK_ID_office") FROM stdin;
1	$237,423,425.00	532	5
2	$11,299,328.00	110	4
3	$1,042.00	5	2
4	$92,394,181,643.00	132156	3
5	$0.00	0	1
\.


COPY "Exchange"."Client" ("ID_client", "Client_name", "Account") FROM stdin;
1	Sergei	$1,000,000.00
2	Dante	$440,000.00
3	Medlen	$560,000.00
4	Lampach	$10,500.00
5	SuperKotee	$7,823,419.00
\.


COPY "Exchange"."Contract_to_buy" ("ID_contract_to_purchase", "FK_ID_broker", "FK_ID_client", "Buy_date", "Amount_of_bought_product", "Buying_price", "Terms_of_purchase") FROM stdin;
1	4	1	2010-09-20	115	$10,000.00	Prepayment
2	2	4	2019-12-17	998	$30,023.00	No_prepayment
3	3	5	2020-03-22	10	$1,042.00	Prepayment
4	1	3	2018-07-07	150000	$20,000,000.00	No_prepayment
5	2	2	2017-01-14	5002	$1,004,352.00	No_prepayment
\.


COPY "Exchange"."Contract_to_sell" ("ID_contract_to_sale", "FK_ID_broker", "FK_ID_client", "Sale_date", "Amount_of_sold_product", "Selling_price", "Terms_of_sale") FROM stdin;
1	4	1	2020-04-20	100	$9,999.00	No_prepayment
2	2	4	2020-04-17	400	$10,210.00	Prepayment
3	3	5	2020-04-12	10	$600.00	Prepayment
4	1	3	2020-04-07	25000	$10,000,000.00	No_prepayment
5	2	2	2020-04-14	5002	$1,004,353.00	No_prepayment
\.


COPY "Exchange"."Deal" ("ID_deal", "FK_ID_broker", "FK_ID_lot", "Deal_date") FROM stdin;
1	4	1	2020-04-20
2	2	2	2020-04-17
3	3	3	2020-04-12
4	1	4	2020-04-07
5	2	5	2020-04-14
\.


COPY "Exchange"."Lot" ("ID_lot", "Lot_price", "Lot_delivery_conditions", "FK_ID_product") FROM stdin;
1	$9,999.00	No_prepayment	1
2	$10,210.00	Prepayment	2
3	$600.00	Prepayment	3
4	$10,000,000.00	No_prepayment	4
5	$1,004,353.00	No_prepayment	5
\.


COPY "Exchange"."Manufacturing_firm" ("ID_firm", "Firm_name") FROM stdin;
1	BuildSupplies
2	ManyThings
3	IKEA
4	Lenta
5	Goods
\.


COPY "Exchange"."Office" ("ID_office", "Office_name") FROM stdin;
1	Rokstar
2	AlphaTrade
3	MegaBank
4	TradeHistory
5	Hesoyam
\.


COPY "Exchange"."Product" ("ID_product", "Expiration_date", "Date_of_manufacture", "Amount", "FK_ID_firm") FROM stdin;
1	2021-01-01	2020-01-01	12200	5
2	2019-12-31	2019-12-01	10100	1
3	2020-03-20	2019-12-20	10	4
4	2022-10-10	2018-06-12	230000	2
5	2030-01-01	2020-01-01	10000000	3
\.

--
-- Создание связей между таблицами при помощи PrimaryKey и ForeignKey
--

ALTER TABLE ONLY "Exchange"."Broker"
    ADD CONSTRAINT "Broker_pkey" PRIMARY KEY ("ID_broker");

ALTER TABLE ONLY "Exchange"."Client"
    ADD CONSTRAINT "Client_pkey" PRIMARY KEY ("ID_client");

ALTER TABLE ONLY "Exchange"."Contract_to_buy"
    ADD CONSTRAINT "Contract_to_buy_pkey" PRIMARY KEY ("ID_contract_to_purchase");

ALTER TABLE ONLY "Exchange"."Contract_to_sell"
    ADD CONSTRAINT "Contract_to_sale_pkey" PRIMARY KEY ("ID_contract_to_sale");

ALTER TABLE ONLY "Exchange"."Deal"
    ADD CONSTRAINT "Deal_pkey" PRIMARY KEY ("ID_deal");

ALTER TABLE ONLY "Exchange"."Lot"
    ADD CONSTRAINT "Lot_pkey" PRIMARY KEY ("ID_lot");

ALTER TABLE ONLY "Exchange"."Manufacturing_firm"
    ADD CONSTRAINT "Manufacturing_firm_pkey" PRIMARY KEY ("ID_firm");

ALTER TABLE ONLY "Exchange"."Office"
    ADD CONSTRAINT "Office_pkey" PRIMARY KEY ("ID_office");

ALTER TABLE ONLY "Exchange"."Product"
    ADD CONSTRAINT "Product_pkey" PRIMARY KEY ("ID_product");


ALTER TABLE ONLY "Exchange"."Deal"
    ADD CONSTRAINT "FK_ID_broker" FOREIGN KEY ("FK_ID_broker") REFERENCES "Exchange"."Broker"("ID_broker") ON UPDATE RESTRICT ON DELETE RESTRICT DEFERRABLE INITIALLY DEFERRED;

ALTER TABLE ONLY "Exchange"."Contract_to_sell"
    ADD CONSTRAINT "FK_ID_broker" FOREIGN KEY ("FK_ID_broker") REFERENCES "Exchange"."Broker"("ID_broker") ON UPDATE RESTRICT ON DELETE RESTRICT DEFERRABLE INITIALLY DEFERRED;

ALTER TABLE ONLY "Exchange"."Contract_to_buy"
    ADD CONSTRAINT "FK_ID_broker" FOREIGN KEY ("FK_ID_broker") REFERENCES "Exchange"."Broker"("ID_broker") ON UPDATE RESTRICT ON DELETE RESTRICT DEFERRABLE INITIALLY DEFERRED;

ALTER TABLE ONLY "Exchange"."Contract_to_sell"
    ADD CONSTRAINT "FK_ID_client" FOREIGN KEY ("FK_ID_client") REFERENCES "Exchange"."Client"("ID_client") ON UPDATE RESTRICT ON DELETE RESTRICT DEFERRABLE INITIALLY DEFERRED;

ALTER TABLE ONLY "Exchange"."Contract_to_buy"
    ADD CONSTRAINT "FK_ID_client" FOREIGN KEY ("FK_ID_client") REFERENCES "Exchange"."Client"("ID_client") ON UPDATE RESTRICT ON DELETE RESTRICT DEFERRABLE INITIALLY DEFERRED;

ALTER TABLE ONLY "Exchange"."Product"
    ADD CONSTRAINT "FK_ID_firm" FOREIGN KEY ("FK_ID_firm") REFERENCES "Exchange"."Manufacturing_firm"("ID_firm") ON UPDATE RESTRICT ON DELETE RESTRICT DEFERRABLE INITIALLY DEFERRED;

ALTER TABLE ONLY "Exchange"."Deal"
    ADD CONSTRAINT "FK_ID_lot" FOREIGN KEY ("FK_ID_lot") REFERENCES "Exchange"."Lot"("ID_lot") ON UPDATE RESTRICT ON DELETE RESTRICT DEFERRABLE INITIALLY DEFERRED;

ALTER TABLE ONLY "Exchange"."Broker"
    ADD CONSTRAINT "FK_ID_office" FOREIGN KEY ("FK_ID_office") REFERENCES "Exchange"."Office"("ID_office") ON UPDATE RESTRICT ON DELETE RESTRICT DEFERRABLE INITIALLY DEFERRED;

ALTER TABLE ONLY "Exchange"."Lot"
    ADD CONSTRAINT "FK_ID_product" FOREIGN KEY ("FK_ID_product") REFERENCES "Exchange"."Product"("ID_product") ON UPDATE RESTRICT ON DELETE RESTRICT DEFERRABLE INITIALLY DEFERRED;


--
-- PostgreSQL database dump complete
-- В результате, были получены навыки создания настоящей базы данных с последующей записью данных в нее.
--