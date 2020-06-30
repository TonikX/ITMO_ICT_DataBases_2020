--
-- PostgreSQL database dump
--

-- Dumped from database version 10.13
-- Dumped by pg_dump version 10.13

-- Started on 2020-06-22 15:56:35

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
-- TOC entry 1 (class 3079 OID 12924)
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- TOC entry 2828 (class 0 OID 0)
-- Dependencies: 1
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 196 (class 1259 OID 24589)
-- Name: Dostavka; Type: TABLE; Schema: public; Owner: postgres
--

--Таблица содержит информацию о доставке газет
--
--Столбцы:
--	ID почтового отеделния
--	ID доставки
--	ID издания
--	Название газеты
--	Количество экземпляров


CREATE TABLE public."Dostavka" (
    pochtovoe_otdelenie_id integer NOT NULL,
    dostavka_id integer NOT NULL,
    tirazh_id integer NOT NULL,
    gazeta_title text NOT NULL,
    amount integer NOT NULL
);


ALTER TABLE public."Dostavka" OWNER TO postgres;

--
-- TOC entry 2829 (class 0 OID 0)
-- Dependencies: 196
-- Name: TABLE "Dostavka"; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE public."Dostavka" IS 'Таблица содержит информацию о доставке газет
';


--
-- TOC entry 198 (class 1259 OID 24601)
-- Name: Gazeta; Type: TABLE; Schema: public; Owner: postgres
--

--Таблица содержит информацию о газете
--
--Столбцы:
--	Название газеты
--	Имя редактора
--	Фамилия редактора
--	Отчество редактора


CREATE TABLE public."Gazeta" (
    gazeta_title text NOT NULL,
    "Imya_redactora" text NOT NULL,
    "Familia_redactora" text NOT NULL,
    "Otchestvo_redactera" text,
    index integer NOT NULL
);


ALTER TABLE public."Gazeta" OWNER TO postgres;

--
-- TOC entry 2830 (class 0 OID 0)
-- Dependencies: 198
-- Name: TABLE "Gazeta"; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE public."Gazeta" IS 'Таблица содержит информацию о газете';


--
-- TOC entry 199 (class 1259 OID 24607)
-- Name: Pochtovoe_Otdelenie; Type: TABLE; Schema: public; Owner: postgres
--


--Таблица содержит информацию о почтовом отделении
--
--Столбцы:
--	ID почтового отеделния
--	Адрес

CREATE TABLE public."Pochtovoe_Otdelenie" (
    pochtovoe_otdelenie_id integer NOT NULL,
    adress text NOT NULL
);


ALTER TABLE public."Pochtovoe_Otdelenie" OWNER TO postgres;

--
-- TOC entry 2831 (class 0 OID 0)
-- Dependencies: 199
-- Name: TABLE "Pochtovoe_Otdelenie"; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE public."Pochtovoe_Otdelenie" IS 'Таблица содержит информацию о почтовом отделении';


--
-- TOC entry 200 (class 1259 OID 24613)
-- Name: Tipografia; Type: TABLE; Schema: public; Owner: postgres
--

--Таблица содержит информацию о типографии
--
--Столбцы:
--	Название типографии
--	Адрес типографии

CREATE TABLE public."Tipografia" (
    tipografia_title text NOT NULL,
    adress text NOT NULL
);


ALTER TABLE public."Tipografia" OWNER TO postgres;

--
-- TOC entry 2832 (class 0 OID 0)
-- Dependencies: 200
-- Name: TABLE "Tipografia"; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE public."Tipografia" IS 'Таблица содержит информацию о типографии';


--
-- TOC entry 197 (class 1259 OID 24595)
-- Name: Tirazh; Type: TABLE; Schema: public; Owner: postgres
--

--Таблица содержит информацию о конкретном тираже той или иной газеты
--
--Столбцы:
--	ID тиража
--	Название газеты
--	Стоимость газеты в тираже
--	Количество газет

CREATE TABLE public."Tirazh" (
    tirazh_id integer NOT NULL,
    gazeta_title text NOT NULL,
    stoimost money NOT NULL,
    amount integer NOT NULL
);


ALTER TABLE public."Tirazh" OWNER TO postgres;

--
-- TOC entry 2833 (class 0 OID 0)
-- Dependencies: 197
-- Name: TABLE "Tirazh"; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE public."Tirazh" IS 'Таблица содержит информацию о конкретном тираже той или иной газеты';


--
-- TOC entry 201 (class 1259 OID 24619)
-- Name: Zakaz_pechati; Type: TABLE; Schema: public; Owner: postgres
--

--Таблица содержит информацию о заказе печати
--
--Столбцы:
--	ID заказа
--	ID тиража
--	Название типографии
--	Название газеты
--	Количество экземпляров


CREATE TABLE public."Zakaz_pechati" (
    zakaz_id integer NOT NULL,
    tirazh_id integer NOT NULL,
    tipografia_title text NOT NULL,
    gazeta_title text NOT NULL,
    amount integer NOT NULL
);


ALTER TABLE public."Zakaz_pechati" OWNER TO postgres;

--
-- TOC entry 2834 (class 0 OID 0)
-- Dependencies: 201
-- Name: TABLE "Zakaz_pechati"; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE public."Zakaz_pechati" IS 'Таблица содержит информацию о заказе печати';


--
-- TOC entry 2815 (class 0 OID 24589)
-- Dependencies: 196
-- Data for Name: Dostavka; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.Dostavka (pochtovoe_otdelenie_id, dostavka_id, tirazh_id, gazeta_title, amount) VALUES (52, 313, 147, 'Название 1', 2569);
INSERT INTO public.Dostavka (pochtovoe_otdelenie_id, dostavka_id, tirazh_id, gazeta_title, amount) VALUES (9811, 3039, 971, 'Название 2', 7291);
INSERT INTO public.Dostavka (pochtovoe_otdelenie_id, dostavka_id, tirazh_id, gazeta_title, amount) VALUES (1556, 8375, 398, 'Название 3', 3697);
INSERT INTO public.Dostavka (pochtovoe_otdelenie_id, dostavka_id, tirazh_id, gazeta_title, amount) VALUES (3316, 4728, 4220, 'Название 4', 7284);
INSERT INTO public.Dostavka (pochtovoe_otdelenie_id, dostavka_id, tirazh_id, gazeta_title, amount) VALUES (6748, 3022, 1269, 'Название 5', 707);

--
-- TOC entry 2859 (class 0 OID 16615)
-- Dependencies: 207
-- Data for Name: Tirazh; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.Tirazh (tirazh_id, gazeta_title, stoimost, amount) VALUES (1, 'Название 1', '111', 100);
INSERT INTO public.Tirazh (tirazh_id, gazeta_title, stoimost, amount) VALUES (2, 'Название 2', '222', 100);
INSERT INTO public.Tirazh (tirazh_id, gazeta_title, stoimost, amount) VALUES (3, 'Название 3', '333', 100);
INSERT INTO public.Tirazh (tirazh_id, gazeta_title, stoimost, amount) VALUES (4, 'Название 4', '444', 100);
INSERT INTO public.Tirazh (tirazh_id, gazeta_title, stoimost, amount) VALUES (5, 'Название 5', '555', 100);

--
-- TOC entry 2854 (class 0 OID 16394)
-- Dependencies: 202
-- Data for Name: Gazeta; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.Gazeta(gazeta_title, Imya_redactora, Familia_redactora, Otchestvo_redactera, index) VALUES ('Название 1', 'Имя1', 'Фамилия1', 'Отчество1', 1);
INSERT INTO public.Gazeta(gazeta_title, Imya_redactora, Familia_redactora, Otchestvo_redactera, index) VALUES ('Название 2', 'Имя2', 'Фамилия2', 'Отчество2', 2);
INSERT INTO public.Gazeta(gazeta_title, Imya_redactora, Familia_redactora, Otchestvo_redactera, index) VALUES ('Название 3', 'Имя3', 'Фамилия3', 'Отчество3', 3);
INSERT INTO public.Gazeta(gazeta_title, Imya_redactora, Familia_redactora, Otchestvo_redactera, index) VALUES ('Название 4', 'Имя4', 'Фамилия4', 'Отчество4', 4);
INSERT INTO public.Gazeta(gazeta_title, Imya_redactora, Familia_redactora, Otchestvo_redactera, index) VALUES ('Название 5', 'Имя5', 'Фамилия5', 'Отчество5', 5);


--
-- TOC entry 2855 (class 0 OID 16423)
-- Dependencies: 203
-- Data for Name: Pochtovoe_Otdelenie; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.Pochtovoe_Otdelenie (pochtovoe_otdelenie_id, adress) VALUES (1, 'Адрес1');
INSERT INTO public.Pochtovoe_Otdelenie (pochtovoe_otdelenie_id, adress) VALUES (2, 'Адрес2');
INSERT INTO public.Pochtovoe_Otdelenie (pochtovoe_otdelenie_id, adress) VALUES (3, 'Адрес3');
INSERT INTO public.Pochtovoe_Otdelenie (pochtovoe_otdelenie_id, adress) VALUES (4, 'Адрес4');
INSERT INTO public.Pochtovoe_Otdelenie (pochtovoe_otdelenie_id, adress) VALUES (5, 'Адрес5');


--
-- TOC entry 2857 (class 0 OID 16539)
-- Dependencies: 205
-- Data for Name: Tipografia; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.Tipografia  (tipografia_title, adress) VALUES ('Типография 1', 'Адрес1');
INSERT INTO public.Tipografia  (tipografia_title, adress) VALUES ('Типография 2', 'Адрес2');
INSERT INTO public.Tipografia  (tipografia_title, adress) VALUES ('Типография 3', 'Адрес3');
INSERT INTO public.Tipografia  (tipografia_title, adress) VALUES ('Типография 4', 'Адрес4');
INSERT INTO public.Tipografia  (tipografia_title, adress) VALUES ('Типография 5', 'Адрес5');


--
-- TOC entry 2858 (class 0 OID 16583)
-- Dependencies: 206
-- Data for Name: Zakaz_pechati; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.Zakaz_pechati (zakaz_id, tirazh_id, tipografia_title, gazeta_title, amount) VALUES (1, 1, 'Типография 1', 'Название 1', 100);
INSERT INTO public.Zakaz_pechati (zakaz_id, tirazh_id, tipografia_title, gazeta_title, amount) VALUES (2, 2, 'Типография 2', 'Название 2', 100);
INSERT INTO public.Zakaz_pechati (zakaz_id, tirazh_id, tipografia_title, gazeta_title, amount) VALUES (3, 3, 'Типография 3', 'Название 3', 100);
INSERT INTO public.Zakaz_pechati (zakaz_id, tirazh_id, tipografia_title, gazeta_title, amount) VALUES (4, 4, 'Типография 4', 'Название 4', 100);
INSERT INTO public.Zakaz_pechati (zakaz_id, tirazh_id, tipografia_title, gazeta_title, amount) VALUES (5, 5, 'Типография 5', 'Название 5', 100);


--
-- TOC entry 2816 (class 2606 OID 16523)
-- Name: Dostavka Dostavka_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.Dostavka
    ADD CONSTRAINT Dostavka_pkey PRIMARY KEY (Dostavka_number);


--
-- TOC entry 2822 (class 2606 OID 16622)
-- Name: Tirazh Tirazh_pk; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.Tirazh
    ADD CONSTRAINT Tirazh_pk PRIMARY KEY (tirazh_id, gazeta_title);


--
-- TOC entry 2812 (class 2606 OID 16417)
-- Name: Gazeta gazeta_title; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.Gazeta
    ADD CONSTRAINT gazeta_title PRIMARY KEY (gazeta_title);


--
-- TOC entry 2814 (class 2606 OID 16430)
-- Name: Pochtovoe_Otdelenie pochtovoe_otdelenie_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.Pochtovoe_Otdelenie
    ADD CONSTRAINT pochtovoe_otdelenie_id PRIMARY KEY (pochtovoe_otdelenie_id);


--
-- TOC entry 2818 (class 2606 OID 16546)
-- Name: Tipografia  tipografia_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.Tipografia
    ADD CONSTRAINT tipografia_pkey PRIMARY KEY (tipografia_title);


--
-- TOC entry 2820 (class 2606 OID 16590)
-- Name: Zakaz_pechati Zakaz_pechati_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.Zakaz_pechati
    ADD CONSTRAINT Zakaz_pechati_pkey PRIMARY KEY (zakaz_id);


--
-- TOC entry 2823 (class 2606 OID 16628)
-- Name: Dostavka Dostavka_pk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.Dostavka
    ADD CONSTRAINT Dostavka_pk FOREIGN KEY (gazeta_title, tirazh_id) REFERENCES public.Tirazh(gazeta_title, tirazh_id) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 2828 (class 2606 OID 16623)
-- Name: Tirazh Tirazh_fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.Tirazh
    ADD CONSTRAINT Tirazh_fk FOREIGN KEY (gazeta_title) REFERENCES public.Gazeta(gazeta_title) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 2826 (class 2606 OID 16638)
-- Name: Zakaz_pechati Tirazh_fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.Zakaz_pechati
    ADD CONSTRAINT Tirazh_fk FOREIGN KEY (tirazh_id, gazeta_title) REFERENCES public.Tirazh(tirazh_id, gazeta_title) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 2824 (class 2606 OID 16643)
-- Name: Dostavka Pochtovoe_Otdelenie_name_fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.Dostavka
    ADD CONSTRAINT Pochtovoe_Otdelenie_name_fk FOREIGN KEY (pochtovoe_otdelenie_id) REFERENCES public.Pochtovoe_Otdelenie(pochtovoe_otdelenie_id) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 2825 (class 2606 OID 16633)
-- Name: Zakaz_pechati tipografia_title_fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.Zakaz_pechati
    ADD CONSTRAINT tipografia_title_fk FOREIGN KEY (tipografia_title) REFERENCES public.Tipografia(tipografia_title) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE;




--
-- PostgreSQL database dump complete
--

