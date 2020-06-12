--
-- PostgreSQL database dump
--

-- Dumped from database version 12.2
-- Dumped by pg_dump version 12.2

-- Started on 2020-06-12 04:15:06

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'WIN1251';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 2877 (class 1262 OID 124517)
-- Name: bus_park; Type: DATABASE; Schema: -; Owner: postgres
--

CREATE DATABASE bus_park WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'Russian_Russia.1251' LC_CTYPE = 'Russian_Russia.1251';


ALTER DATABASE bus_park OWNER TO postgres;

\connect bus_park

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'WIN1251';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 2878 (class 0 OID 0)
-- Dependencies: 2877
-- Name: DATABASE bus_park; Type: COMMENT; Schema: -; Owner: postgres
--

COMMENT ON DATABASE bus_park IS 'База данных диспетчера автобусного парка';


SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 207 (class 1259 OID 124602)
-- Name: bus; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.bus (
    gos_nomer character varying(16) NOT NULL,
    model_name character varying(16) NOT NULL,
    fuel_type character varying(16) NOT NULL,
    color character varying(16) NOT NULL,
    status character varying(16) NOT NULL
);


ALTER TABLE public.bus OWNER TO postgres;

--
-- TOC entry 2879 (class 0 OID 0)
-- Dependencies: 207
-- Name: TABLE bus; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE public.bus IS 'Таблица описывает автобусы в собственности автопарка

gos_nomer - государственный номер автобуса
model_name - название модели автобуса
fuel_type - тип топлива (бензин, дизель, электричество)
color - цвет автобуса
status - статус автобуса (в эксплуатации, в ремонте)';


--
-- TOC entry 206 (class 1259 OID 124597)
-- Name: bus_model; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.bus_model (
    model_name character varying(16) NOT NULL,
    capacity integer NOT NULL
);


ALTER TABLE public.bus_model OWNER TO postgres;

--
-- TOC entry 2880 (class 0 OID 0)
-- Dependencies: 206
-- Name: TABLE bus_model; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE public.bus_model IS 'Таблица описывает модели автобусов

model_name - название модели
capacity - вместимость';


--
-- TOC entry 208 (class 1259 OID 124632)
-- Name: departure; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.departure (
    departure_num integer NOT NULL,
    serial_num character varying(10),
    route_num integer,
    gos_nomer character varying(16),
    departure_date date,
    status character varying(32),
    tariff integer
);


ALTER TABLE public.departure OWNER TO postgres;

--
-- TOC entry 2881 (class 0 OID 0)
-- Dependencies: 208
-- Name: TABLE departure; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE public.departure IS 'Таблица описывает выезды водителей на автобусах по маршрутам

departure_num - идентификатор выезда
serial_num - серия и номер паспорта водителя
route_num - номер маршрута
gos_nomer - госудаственный номер автобуса
departure_date - дата выезда
status - статус выезда (совершается, завершен)
tariff - стоимость проезда в рублях';


--
-- TOC entry 204 (class 1259 OID 124572)
-- Name: driver; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.driver (
    serial_num character varying(16) NOT NULL,
    schedule_num integer,
    experience integer,
    category character varying(16),
    salary integer
);


ALTER TABLE public.driver OWNER TO postgres;

--
-- TOC entry 2882 (class 0 OID 0)
-- Dependencies: 204
-- Name: TABLE driver; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE public.driver IS 'Таблица описывает водителей автобусного парка

serial_num - серия и номер паспорта водителя слитно
schedule_num - график по которому работает водитель
experience - стаж работы водителя в месяцах
category - категория водителя (1 сорт - профессионал, 2 сорт - начинающий)
salary - зарплата водителя в рублях
';


--
-- TOC entry 209 (class 1259 OID 124652)
-- Name: incident; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.incident (
    incident_num integer NOT NULL,
    departure_num integer,
    description text
);


ALTER TABLE public.incident OWNER TO postgres;

--
-- TOC entry 2883 (class 0 OID 0)
-- Dependencies: 209
-- Name: TABLE incident; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE public.incident IS 'Таблица описывает проишествия, случившиеся во время выезда

incident_num - идентификатор проишествия
departure_num - номер выезда
description - описание проишествия';


--
-- TOC entry 202 (class 1259 OID 124526)
-- Name: passport; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.passport (
    serial_num character varying(10) NOT NULL,
    first_name character varying(32) NOT NULL,
    last_name character varying(32) NOT NULL,
    birthday date NOT NULL,
    date_issued date NOT NULL,
    issued_by text NOT NULL,
    registration text NOT NULL
);


ALTER TABLE public.passport OWNER TO postgres;

--
-- TOC entry 2884 (class 0 OID 0)
-- Dependencies: 202
-- Name: TABLE passport; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE public.passport IS 'Таблица описывает паспортные данные сотрудников (водителей) автобусного парка.

first_name - имя сотрудника
last_name - фамилия сотрудника
birthday - дата рождения сотрудника
date_issued - дата выдачи паспорта
issued_by - орган, выдавший паспорт';


--
-- TOC entry 205 (class 1259 OID 124587)
-- Name: route; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.route (
    route_num integer NOT NULL,
    start_point character varying(64) NOT NULL,
    end_point character varying(64) NOT NULL,
    start_time time without time zone,
    end_time time without time zone,
    time_between integer,
    route_length integer
);


ALTER TABLE public.route OWNER TO postgres;

--
-- TOC entry 2885 (class 0 OID 0)
-- Dependencies: 205
-- Name: TABLE route; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE public.route IS 'Таблица описывает маршруты, обслуживаемые автобусным парком

route_num - идентификатор маршрута
start_point - начальный пункт
end_point - конечный пункт
start_time - время начала движения автобусов
end_time - время окончания движения автобусов
time_between - предположительный интервал движения
route_length - длина маршрута в минутах';


--
-- TOC entry 203 (class 1259 OID 124539)
-- Name: schedule; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.schedule (
    schedule_num integer NOT NULL,
    smena_start time without time zone,
    smena_end time without time zone
);


ALTER TABLE public.schedule OWNER TO postgres;

--
-- TOC entry 2886 (class 0 OID 0)
-- Dependencies: 203
-- Name: TABLE schedule; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE public.schedule IS 'Таблица описывает графики работы водителей.

schedule_num - идентификатор графика
smena_start - время начала смены
smena_end - время окончания смены';


--
-- TOC entry 2869 (class 0 OID 124602)
-- Dependencies: 207
-- Data for Name: bus; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.bus VALUES ('А777АА78', 'НефАЗ-5299', 'бензин', 'белый', 'в эксплуатации');
INSERT INTO public.bus VALUES ('А228УЕ78', 'ПАЗ-3204', 'дизель', 'белый', 'в ремонте');
INSERT INTO public.bus VALUES ('А329ВТ78', 'ПАЗ-3204', 'бензин', 'белый', 'в эксплуатации');
INSERT INTO public.bus VALUES ('М482НВ78', 'ПАЗ-3205', 'дизель', 'белый', 'в эксплуатации');
INSERT INTO public.bus VALUES ('А983УВ78', 'ПАЗ-3205', 'дизель', 'белый', 'в ремонте');


--
-- TOC entry 2868 (class 0 OID 124597)
-- Dependencies: 206
-- Data for Name: bus_model; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.bus_model VALUES ('ПАЗ-3205', 23);
INSERT INTO public.bus_model VALUES ('ПАЗ-3204', 23);
INSERT INTO public.bus_model VALUES ('НефАЗ-5299', 25);
INSERT INTO public.bus_model VALUES ('МАЗ-203', 28);
INSERT INTO public.bus_model VALUES ('Ikarus 280', 100);


--
-- TOC entry 2870 (class 0 OID 124632)
-- Dependencies: 208
-- Data for Name: departure; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.departure VALUES (1, '0901482765', 101, 'А329ВТ78', '2020-02-12', 'завершен', 50);
INSERT INTO public.departure VALUES (2, '0703564365', 101, 'М482НВ78', '2020-03-22', 'завершен', 50);
INSERT INTO public.departure VALUES (3, '0505865371', 176, 'А228УЕ78', '2020-05-07', 'завершен', 50);
INSERT INTO public.departure VALUES (4, '0209756142', 39, 'А777АА78', '2020-06-11', 'совершается', 50);
INSERT INTO public.departure VALUES (5, '0901482765', 101, 'А329ВТ78', '2020-06-11', 'совершается', 50);


--
-- TOC entry 2866 (class 0 OID 124572)
-- Dependencies: 204
-- Data for Name: driver; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.driver VALUES ('0901482765', 2, 11, '1 сорт', 100000);
INSERT INTO public.driver VALUES ('0505865371', 3, 2, '2 сорт', 10000);
INSERT INTO public.driver VALUES ('0209756142', 3, 3, '2 сорт', 10000);
INSERT INTO public.driver VALUES ('0503875463', 2, 6, '2 сорт', 10000);
INSERT INTO public.driver VALUES ('0703564365', 7, 20, '1 сорт', 100000);


--
-- TOC entry 2871 (class 0 OID 124652)
-- Dependencies: 209
-- Data for Name: incident; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.incident VALUES (1, 3, 'ДТП на проспекте Мечникова');


--
-- TOC entry 2864 (class 0 OID 124526)
-- Dependencies: 202
-- Data for Name: passport; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.passport VALUES ('0901482765', 'Василий', 'Пупкин', '1978-01-22', '2007-02-08', 'ТП №1 ОТДЕЛА УФМС РОССИИ ПО САНКТ-ПЕТЕРБУРГУ И ЛЕНИНГРАДСКОЙ ОБЛ. В АДМИРАЛТЕЙСКОМ Р-НЕ Г. САНКТ-ПЕТЕРБУРГА', 'Ростов-на-Дону');
INSERT INTO public.passport VALUES ('0505865371', 'Анатолий', 'Старых', '1985-05-15', '2008-06-21', 'ТП №69 ОТДЕЛА УФМС РОССИИ ПО САНКТ-ПЕТЕРБУРГУ И ЛЕНИНГРАДСКОЙ ОБЛ. В ПРИМОРСКОМ Р-НЕ Г. САНКТ-ПЕТЕРБУРГА', 'Тюмень');
INSERT INTO public.passport VALUES ('0209756142', 'Владимир', 'Новых', '1982-03-10', '2005-04-04', 'ОТДЕЛ УФМС РОССИИ ПО САНКТ-ПЕТЕРБУРГУ И ЛЕНИНГРАДСКОЙ ОБЛАСТИ В ПЕТРОГРАДСКОМ РАЙОНЕ Г. САНКТ-ПЕТЕРБУРГА', 'Тюмень');
INSERT INTO public.passport VALUES ('0503875463', 'Дмитрий', 'Пучков', '1965-06-02', '2012-07-14', 'ОТДЕЛ УФМС РОССИИ ПО САНКТ-ПЕТЕРБУРГУ И ЛЕНИНГРАДСКОЙ ОБЛАСТИ В НЕВСКОМ РАЙОНЕ Г. САНКТ-ПЕТЕРБУРГА', 'Санкт-Петербург');
INSERT INTO public.passport VALUES ('0703564365', 'Ашот', 'Арутюнян', '1975-08-11', '2015-08-25', 'ОТДЕЛ УФМС РОССИИ ПО САНКТ-ПЕТЕРБУРГУ И ЛЕНИНГРАДСКОЙ ОБЛАСТИ В ПЕТРОГРАДСКОМ РАЙОНЕ Г. САНКТ-ПЕТЕРБУРГА', 'Грозный');


--
-- TOC entry 2867 (class 0 OID 124587)
-- Dependencies: 205
-- Data for Name: route; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.route VALUES (18, 'ул. Стойкости', 'ул. Корабельная', '06:00:00', '22:00:00', 17, 55);
INSERT INTO public.route VALUES (176, 'Светлановский', 'ст. Ручьи', '05:50:00', '23:00:00', 14, 50);
INSERT INTO public.route VALUES (476, 'м. Ломоносовская', 'пос. имени Свердлова', '08:00:00', '20:00:00', 17, 80);
INSERT INTO public.route VALUES (101, 'м. Старая Деревня', 'Кронштадт', '08:00:00', '20:00:00', 20, 70);
INSERT INTO public.route VALUES (39, 'ул. Костюшко', 'Аэропорт Пулково', '06:00:00', '23:00:00', 10, 80);


--
-- TOC entry 2865 (class 0 OID 124539)
-- Dependencies: 203
-- Data for Name: schedule; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.schedule VALUES (1, '04:00:00', '12:00:00');
INSERT INTO public.schedule VALUES (2, '08:00:00', '16:00:00');
INSERT INTO public.schedule VALUES (3, '10:00:00', '18:00:00');
INSERT INTO public.schedule VALUES (4, '12:00:00', '20:00:00');
INSERT INTO public.schedule VALUES (5, '14:00:00', '22:00:00');
INSERT INTO public.schedule VALUES (6, '16:00:00', '00:00:00');
INSERT INTO public.schedule VALUES (7, '18:00:00', '02:00:00');


--
-- TOC entry 2728 (class 2606 OID 124636)
-- Name: departure departure_num_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.departure
    ADD CONSTRAINT departure_num_pkey PRIMARY KEY (departure_num);


--
-- TOC entry 2720 (class 2606 OID 124576)
-- Name: driver driver_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.driver
    ADD CONSTRAINT driver_pkey PRIMARY KEY (serial_num);


--
-- TOC entry 2726 (class 2606 OID 124606)
-- Name: bus gos_numer_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.bus
    ADD CONSTRAINT gos_numer_pkey PRIMARY KEY (gos_nomer);


--
-- TOC entry 2730 (class 2606 OID 124659)
-- Name: incident incident_num_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.incident
    ADD CONSTRAINT incident_num_pkey PRIMARY KEY (incident_num);


--
-- TOC entry 2724 (class 2606 OID 124601)
-- Name: bus_model model_name_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.bus_model
    ADD CONSTRAINT model_name_pkey PRIMARY KEY (model_name);


--
-- TOC entry 2722 (class 2606 OID 124591)
-- Name: route route_num_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.route
    ADD CONSTRAINT route_num_pkey PRIMARY KEY (route_num);


--
-- TOC entry 2718 (class 2606 OID 124543)
-- Name: schedule schedule_num_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.schedule
    ADD CONSTRAINT schedule_num_pkey PRIMARY KEY (schedule_num);


--
-- TOC entry 2716 (class 2606 OID 124533)
-- Name: passport serial_num_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.passport
    ADD CONSTRAINT serial_num_pkey PRIMARY KEY (serial_num);


--
-- TOC entry 2733 (class 2606 OID 124607)
-- Name: bus bus_model_name_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.bus
    ADD CONSTRAINT bus_model_name_fkey FOREIGN KEY (model_name) REFERENCES public.bus_model(model_name);


--
-- TOC entry 2736 (class 2606 OID 124647)
-- Name: departure departure_gos_nomer_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.departure
    ADD CONSTRAINT departure_gos_nomer_fkey FOREIGN KEY (gos_nomer) REFERENCES public.bus(gos_nomer);


--
-- TOC entry 2735 (class 2606 OID 124642)
-- Name: departure departure_route_num_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.departure
    ADD CONSTRAINT departure_route_num_fkey FOREIGN KEY (route_num) REFERENCES public.route(route_num);


--
-- TOC entry 2734 (class 2606 OID 124637)
-- Name: departure departure_serial_num_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.departure
    ADD CONSTRAINT departure_serial_num_fkey FOREIGN KEY (serial_num) REFERENCES public.passport(serial_num);


--
-- TOC entry 2732 (class 2606 OID 124582)
-- Name: driver driver_schedule_num_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.driver
    ADD CONSTRAINT driver_schedule_num_fkey FOREIGN KEY (schedule_num) REFERENCES public.schedule(schedule_num);


--
-- TOC entry 2731 (class 2606 OID 124577)
-- Name: driver driver_serial_num_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.driver
    ADD CONSTRAINT driver_serial_num_fkey FOREIGN KEY (serial_num) REFERENCES public.passport(serial_num);


--
-- TOC entry 2737 (class 2606 OID 124660)
-- Name: incident incident_departure_num_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.incident
    ADD CONSTRAINT incident_departure_num_fkey FOREIGN KEY (departure_num) REFERENCES public.departure(departure_num);


-- Completed on 2020-06-12 04:15:07

--
-- PostgreSQL database dump complete
--

