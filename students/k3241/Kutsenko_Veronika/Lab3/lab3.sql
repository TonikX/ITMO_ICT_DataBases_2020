  
-- Database: Lych

-- DROP DATABASE "Lych";

CREATE DATABASE "Lych"
    WITH 
    OWNER = postgres
    ENCODING = 'UTF8'
    LC_COLLATE = 'Russian_Russia.1251'
    LC_CTYPE = 'Russian_Russia.1251'
    TABLESPACE = pg_default
    CONNECTION LIMIT = -1;
-- SCHEMA: public

-- DROP SCHEMA public ;

CREATE SCHEMA public
    AUTHORIZATION postgres;

COMMENT ON SCHEMA public
    IS 'standard public schema';

GRANT ALL ON SCHEMA public TO PUBLIC;

GRANT ALL ON SCHEMA public TO postgres;

-- Table: public.Client

-- DROP TABLE public."Client";

CREATE TABLE public."Client"
(
    "Name" text COLLATE pg_catalog."default" NOT NULL,
    email text COLLATE pg_catalog."default",
    phone text COLLATE pg_catalog."default",
    CONSTRAINT "Client_pkey" PRIMARY KEY ("Name")
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public."Client"
    OWNER to postgres;
COMMENT ON TABLE public."Client"
    IS 'Таблица Рекламодатель, содержащая основную информацию о нанимателе.';
    
 -- Table: public.Labor_contract

-- DROP TABLE public."Labor_contract";

CREATE TABLE public."Labor_contract"
(
    "Req_ID" integer NOT NULL,
    "Work_ID" integer NOT NULL,
    "Dates" text COLLATE pg_catalog."default"
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public."Labor_contract"
    OWNER to postgres;
COMMENT ON TABLE public."Labor_contract"
    IS 'Таблица Трудовое соглашение, связывающая рекламодателя с работником агенства.';
    
 -- Table: public.Material

-- DROP TABLE public."Material";

CREATE TABLE public."Material"
(
    "Mat_ID" integer NOT NULL,
    "Serv_ID" integer,
    "Number" text COLLATE pg_catalog."default",
    "Total cost" text COLLATE pg_catalog."default",
    CONSTRAINT "Material_pkey" PRIMARY KEY ("Mat_ID")
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public."Material"
    OWNER to postgres;
COMMENT ON TABLE public."Material"
    IS 'Таблица Материал, связывающая материал из списка с услугой, для которой он необходим.';
    
 -- Table: public.Material_list

-- DROP TABLE public."Material_list";

CREATE TABLE public."Material_list"
(
    "Mat_ID" integer NOT NULL,
    "Naming" text COLLATE pg_catalog."default",
    "Descroption" text COLLATE pg_catalog."default",
    "Cost" text COLLATE pg_catalog."default"
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public."Material_list"
    OWNER to postgres;
COMMENT ON TABLE public."Material_list"
    IS 'Таблица Список материалов, содержащая информацию о материалах.';
    
 -- Table: public.Payment_order

-- DROP TABLE public."Payment_order";

CREATE TABLE public."Payment_order"
(
    "Req_ID" integer NOT NULL,
    "Status" text COLLATE pg_catalog."default" NOT NULL,
    "Date" text COLLATE pg_catalog."default"
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public."Payment_order"
    OWNER to postgres;
COMMENT ON TABLE public."Payment_order"
    IS 'Таблица Платежное поручение, содержая инормацию о статусе оплаты заявки.';
    
 -- Table: public.Price_list

-- DROP TABLE public."Price_list";

CREATE TABLE public."Price_list"
(
    "Serv_ID" integer NOT NULL,
    "Naming" text COLLATE pg_catalog."default",
    "Description" text COLLATE pg_catalog."default",
    "Cost" text COLLATE pg_catalog."default",
    CONSTRAINT "Price_list_pkey" PRIMARY KEY ("Serv_ID")
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public."Price_list"
    OWNER to postgres;
COMMENT ON TABLE public."Price_list"
    IS 'Таблица Прайс лист, содержащая информацию о предоставляемых услугах.';
    
 -- Table: public.Request

-- DROP TABLE public."Request";

CREATE TABLE public."Request"
(
    "Req_ID" integer NOT NULL,
    "Name" text COLLATE pg_catalog."default",
    "Date" text COLLATE pg_catalog."default",
    CONSTRAINT "Request_pkey" PRIMARY KEY ("Req_ID")
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public."Request"
    OWNER to postgres;
COMMENT ON TABLE public."Request"
    IS 'Заявка, которую оставляет рекламодатель.';
    
 -- Table: public.Service

-- DROP TABLE public."Service";

CREATE TABLE public."Service"
(
    "Serv_ID" integer NOT NULL,
    "Req_ID" integer,
    "Total cost" text COLLATE pg_catalog."default",
    CONSTRAINT "Service_pkey" PRIMARY KEY ("Serv_ID")
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public."Service"
    OWNER to postgres;
COMMENT ON TABLE public."Service"
    IS 'Таблица Услуги,  состоящая из перечня услуг для конкретной заявки.';
    
 -- Table: public.Worker

-- DROP TABLE public."Worker";

CREATE TABLE public."Worker"
(
    "Work_ID" integer NOT NULL,
    "FIO" text COLLATE pg_catalog."default",
    "Expirience" text COLLATE pg_catalog."default",
    "Contacts" text COLLATE pg_catalog."default",
    CONSTRAINT "Worker_pkey" PRIMARY KEY ("Work_ID")
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public."Worker"
    OWNER to postgres;
COMMENT ON TABLE public."Worker"
    IS 'Таблица Работник, содержащая информаю о работниках агенства.';
    
    
    
INSERT INTO public."Client"(
	"Name", email, phone)
	VALUES 
    ('Ivanov Ivan', 'ii@mail.ru', '111-111'),
    ('Petrov Petr', 'pp@mail.ru', '222-222'),
    ('Nikitin Nikita', 'nn@mail.ru', '333-333'),
    ('Dmitriev Dmitrii', 'dd@mail.ru', '444-444'),
    ('Egorov Egor', 'ee@mail.ru', '555-555');
    
INSERT INTO public."Labor_contract"(
	"Req_ID", "Work_ID", "Dates")
	VALUES 
    ('1', '1', '10/01-10/02'),
    ('2', '2', '05/02-15/02'),
    ('3', '3', '11/02-19/02'),
    ('4', '4', '01/03-01/05'),
    ('5', '5', '03/03-08/3');
    
INSERT INTO public."Material"(
	"Mat_ID", "Serv_ID", "Number", "Total cost")
	VALUES 
    ('1', '1', '1', '1.000'),
    ('2', '1', '3', '600'),
    ('3', '1', '4', '200'),
    ('4', '2', '5', '1.500'),
    ('5', '2', '1', '700');
    
INSERT INTO public."Material_list"(
	"Mat_ID", "Naming", "Descroption", "Cost")
	VALUES 
    ('1', 'Blue paper', 'Like sky', '1.000'),
    ('2', 'Red paper', 'Like blood', '200'),
    ('3', 'Yellow paper', 'Like sun', '50'),
    ('4', 'Black paper', 'Like night', '300'),
    ('5', 'Green paper', 'Like grass', '700');
    
 
 INSERT INTO public."Payment_order"(
	"Req_ID", "Status", "Date")
	VALUES 
    ('1', 'Y', '12/01'),
    ('2', 'N', '-'),
    ('3', 'N', '-'),
    ('4', 'Y', '02/03'),
    ('5', 'N', '-');
    
INSERT INTO public."Price_list"(
	"Serv_ID", "Naming", "Description", "Cost")
	VALUES 
	('1', 'Beautiful paper', 'Very nice', '10.000'), 
	('2', 'Colorful paper', 'A lot of colors', '12.000'), 
	('3', 'Just paper', 'Nothing extra', '5.000'), 
	('4', 'No paper', 'Nothing', '1.000'), 
	('5', 'Ugly paper', 'Fu', '112.000');
    
INSERT INTO public."Request"(
	"Req_ID", "Name", "Date")
	VALUES
	('1', 'Ivanov Ivan', '09/01'), 
	('2', 'Petrov Petr', '02/02'), 
	('3', 'Nikitin Nikita', '10/02'), 
	('4', 'Dmitriev Dmitrii', '28/02'), 
	('5', 'Egorov Egor', '01/03'); 

INSERT INTO public."Service"(
	"Serv_ID", "Req_ID", "Total cost")
	VALUES 
	('1', '1', '20.000'),
	('2', '2', '10.000'),
	('3', '3', '10.000'),
	('4', '4', '12.000'),
	('5', '5', '24.000');
	
INSERT INTO public."Worker"(
	"Work_ID", "FIO", "Expirience", "Contacts")
	VALUES 
	('1', 'III', '1 year', '123-123'),
	('2', 'ERW', '23 years', 'erw@mail.ru'),
	('3', 'VGF', '2 weeks', '@vgf'),
	('4', 'VKS', '6 days', '231-231'),
	('5', 'AWG', '7 months', 'awg@gmail.com');
