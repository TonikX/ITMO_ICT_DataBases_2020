-- Database: advertising_agency

-- DROP DATABASE advertising_agency;

CREATE DATABASE advertising_agency
    WITH
    OWNER = postgres
    ENCODING = 'UTF8'
    LC_COLLATE = 'C'
    LC_CTYPE = 'C'
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


-- Table: public.advertising_agency

-- DROP TABLE public.advertising_agency;
-- Таблица Рекламное агенство. Содержит информацию о рекламном агенстве

CREATE TABLE public.advertising_agency
(
    id integer NOT NULL,
    name text COLLATE pg_catalog."default" NOT NULL,
    address text COLLATE pg_catalog."default" NOT NULL,
    CONSTRAINT "advertising_agency_pkey" PRIMARY KEY (id)
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public.advertising_agency
    OWNER to postgres;
COMMENT ON TABLE public.advertising_agency
    IS 'Содержит информацию о рекламном агенстве';


-- Table: public.advertiser
-- Таблица Рекламодатели. Содержит информацию о реламодателях

-- DROP TABLE public.advertiser;

CREATE TABLE public.advertiser
(
    id integer NOT NULL,
    contact_person text COLLATE pg_catalog."default" NOT NULL,
    email text COLLATE pg_catalog."default" NOT NULL,
    number text COLLATE pg_catalog."default" NOT NULL,
    CONSTRAINT "advertiser_pkey" PRIMARY KEY (id)
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public.advertiser
    OWNER to postgres;
COMMENT ON TABLE public.advertiser
    IS 'Содержит информацию о рекламодателях';


-- Table: public.request
-- Таблица Заявка. Содержит информацию о заявках

-- DROP TABLE public.request;

CREATE TABLE public.request
(
    id integer NOT NULL,
    id_advertising_agency integer NOT NULL,
    id_advertiser integer NOT NULL,
    state text COLLATE pg_catalog."default" NOT NULL,
    CONSTRAINT request_pkey PRIMARY KEY (id),
    CONSTRAINT id_advertising_agency FOREIGN KEY (id_advertising_agency)
        REFERENCES public.advertising_agency (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE CASCADE,
    CONSTRAINT id_advertiser FOREIGN KEY (id_advertiser)
        REFERENCES public.advertiser (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE CASCADE

)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public.request
    OWNER to postgres;
COMMENT ON TABLE public.request
    IS 'Содержит информацию о заявках';


-- Table: public.payment_order
-- Таблица Платежное поручение. Содержит информацию о платежных поручениях

-- DROP TABLE public.payment_order;

CREATE TABLE public.payment_order
(
    id integer NOT NULL,
    id_request integer NOT NULL,
    data_order data NOT NULL,
    state text COLLATE pg_catalog."default" NOT NULL,
    CONSTRAINT payment_order_pkey PRIMARY KEY (id),
    CONSTRAINT id_request FOREIGN KEY (id_request)
        REFERENCES public.request (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE CASCADE
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public.payment_order
    OWNER to postgres;
COMMENT ON TABLE public.payment_order
    IS 'Содержит информацию о платежных поручениях';


-- Table: public.work
-- Таблица Работ. Содержит информацию о работах

-- DROP TABLE public.work;

CREATE TABLE public.work
(
    id integer NOT NULL,
    data_of_creation data NOT NULL,
    data_of_completion data,   
    cost integer NOT NULL,
    volume text COLLATE pg_catalog."default" NOT NULL,
    materials text COLLATE pg_catalog."default" NOT NULL,
    CONSTRAINT work_pkey PRIMARY KEY (id)
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public.work
    OWNER to postgres;
COMMENT ON TABLE public.work
    IS 'Содержит информацию о работах';


-- Table: public.work_list
-- Таблица Список работ. Содержит информацию о списах работ

-- DROP TABLE public.work_list;

CREATE TABLE public.work_list
(
    id integer NOT NULL,
    id_work integer NOT NULL,
    id_request integer NOT NULL,
    CONSTRAINT id_work FOREIGN KEY (id_work)
        REFERENCES public.work (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE CASCADE,
    CONSTRAINT id_request FOREIGN KEY (id_request)
        REFERENCES public.request (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE CASCADE,
    CONSTRAINT work_list_pkey PRIMARY KEY (id)

)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public.work_list
    OWNER to postgres;
COMMENT ON TABLE public.work_list
    IS 'Содержит информацию о списках работ';


-- Table: public.worker
-- Таблица Сотрудник агенства. Содержит информацию о сотрудниках

-- DROP TABLE public.worker;

CREATE TABLE public.worker
(
    id integer NOT NULL,
    full_name text COLLATE pg_catalog."default" NOT NULL,
    specialty text COLLATE pg_catalog."default" NOT NULL,
    CONSTRAINT worker_pkey PRIMARY KEY (id)
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public.worker
    OWNER to postgres;
COMMENT ON TABLE public.worker
    IS 'Содержит информацию о сотрудниках';


-- Table: public.worker_list
-- Таблица Список сотрудников. Содержит информацию о списах сотрудников

-- DROP TABLE public.worker_list;

CREATE TABLE public.worker_list
(
    id integer NOT NULL,
    id_work integer NOT NULL,
    id_worker integer NOT NULL,
    CONSTRAINT id_work FOREIGN KEY (id_work)
        REFERENCES public.work (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE CASCADE,
    CONSTRAINT id_worker FOREIGN KEY (id_worker)
        REFERENCES public.worker (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE CASCADE,
    CONSTRAINT worker_list_pkey PRIMARY KEY (id)
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public.worker_list
    OWNER to postgres;
COMMENT ON TABLE public.worker_list
    IS 'Содержит информацию о списках сотрудников';


-- Table: public.service
-- Таблица Рекламная услуга. Содержит информацию о рекламной услуге

-- DROP TABLE public.service;

CREATE TABLE public.service
(
    id integer NOT NULL,
    name text COLLATE pg_catalog."default" NOT NULL,
    cost integer NOT NULL,
    CONSTRAINT service_pkey PRIMARY KEY (id)
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public.service
    OWNER to postgres;
COMMENT ON TABLE public.service
    IS 'Содержит информацию о рекламной услуге';


-- Table: public.price_list
-- Таблица Прайс-лист. Содержит информацию о прайс листе

-- DROP TABLE public.price_list;

CREATE TABLE public.price_list
(
    id integer NOT NULL,
    id_service integer NOT NULL,
    id_advertising_agency integer NOT NULL,
    CONSTRAINT id_service FOREIGN KEY (id_service)
        REFERENCES public.service (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE CASCADE,
    CONSTRAINT id_advertising_agency FOREIGN KEY (id_advertising_agency)
        REFERENCES public.advertising_agency (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE CASCADE,
    CONSTRAINT price_list_pkey PRIMARY KEY (id)

)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public.price_list
    OWNER to postgres;
COMMENT ON TABLE public.price_list
    IS 'Содержит информацию о прайс листе';




-- Заполнение данными
-- Таблица рекламное агенство
INSERT INTO public.advertising_agency(
	id, name, address)
	VALUES 
	(0, 'Фиалка', 'улица Борова 7');

-- Таблица рекламодатель
INSERT INTO public.advertiser (
	id, contact_person, email, number) 
	VALUES
	(0, 'Ivanov', 'ivanov@mail.com', 89115534211),
	(1, 'Petrov', 'petrov@mail.com', 89115534456),
	(2, 'Sidorov', 'sidorov@mail.com', 89117894211),
	(3, 'Hmelnov', 'hmelnov@mail.com', 89115512311),
	(4, 'Stopov', 'stopov@mail.com', 89115533451);

-- Таблица платежное поручение
INSERT INTO public.payment_order (
	id, id_request, data_order, state) 
	VALUES
	(0, 1, '2020-04-11', 'оплачено'),
	(1, 2, '2020-03-07', 'не оплачено'),
	(2, 3, '2020-01-12', 'оплачено'),
	(3, 4, '2020-03-17', 'оплачено'),
	(4, 0, '2019-12-19', 'оплачено');

-- Таблица заявка
INSERT INTO public.request (
	id, id_advertising_agency, id_advertiser, state) 
	VALUES
	(0, 0, 2, 'оформлена'),
	(1, 0, 3, 'в ожидании'),
	(2, 0, 4, 'отменена'),
	(3, 0, 0, 'в ожидании'),
	(4, 0, 1, 'оформлена');

-- Таблица работ
INSERT INTO public.work (
	id, data_of_creation, data_of_completion, cost, volume, materials) 
	VALUES
	(0, '2020-01-11', '2020-02-10', 20000, 'месяц', 'студия, машина, 30 человек'),
	(1, '2020-02-17', '2020-02-21', 47000, '4 дня', 'трактор, 11 человек'),
	(2, '2020-04-23', '2020-05-01', 25000, '2 недели', 'букет роз, семейная пара'),
	(3, '2020-01-29', '2020-02-11', 21000, '2 недели', '33 долматинца, бумажные полотенца'),
	(4, '2019-12-11', '2019-12-20', 50000,'9 дней', 'список анекдотов, чувство юмора, 1 комик');

-- Таблица список работ
INSERT INTO public.work_list (
	id, id_work, id_request) 
	VALUES
	(0, 0, 1),
	(1, 1, 2),
	(2, 2, 3),
	(3, 3, 4),
	(4, 4, 0);

-- Таблица сотрудник агенства
INSERT INTO public.worker (
	id, full_name, specialty) 
	VALUES
	(0, 'Petrenko Ivan Bedko', 'монтажер'),
	(1, 'Sidrenko Petr Vanko', 'каскадер'),
	(2, 'Landav Muk Nevada', 'программист'),
	(3, 'Pomogi Te Poshalusta', 'администратор'),
	(4, 'Spasi Iso Hrani', 'секретарь');

-- Таблица список сотрудников
INSERT INTO public.worker_list (
	id, id_work, id_worker) 
	VALUES
	(0, 0, 1),
	(1, 1, 2),
	(2, 2, 3),
	(3, 3, 4),
	(4, 4, 0);

-- Таблица рекламная услуга
INSERT INTO public.service (
	id, name, cost) 
	VALUES
	(0, 'монтаж', 7000),
	(1, 'съемка', 20000),
	(2, 'дополнительная подсъемка', 13000),
	(3, 'написание сценария', 17000),
	(4, 'дополнительные спецэфферты', 30000);

-- Таблица прайс лист
INSERT INTO public.price_list (
	id, id_service, id_advertising_agency) 
	VALUES
	(0, 0, 0),
	(1, 1, 0),
	(2, 2, 0),
	(3, 3, 0),
	(4, 4, 0);

