--
-- PostgreSQL database dump
--

-- Dumped from database version 12.2
-- Dumped by pg_dump version 12.2

-- Started on 2020-04-25 18:23:31

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
-- TOC entry 2865 (class 1262 OID 16393)
-- Name: Newspaper; Type: DATABASE; Schema: -; Owner: postgres
--

CREATE DATABASE "Newspaper" WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'Russian_Russia.1251' LC_CTYPE = 'Russian_Russia.1251';


ALTER DATABASE "Newspaper" OWNER TO postgres;

\connect "Newspaper"

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
-- TOC entry 2866 (class 0 OID 0)
-- Dependencies: 2865
-- Name: DATABASE "Newspaper"; Type: COMMENT; Schema: -; Owner: postgres
--

COMMENT ON DATABASE "Newspaper" IS 'Database for 3rd DB lab';


SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 204 (class 1259 OID 16516)
-- Name: delivery; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.delivery (
    post_office_number integer NOT NULL,
    delivery_number integer NOT NULL,
    edition_number integer NOT NULL,
    newspaper_name text NOT NULL,
    amount integer NOT NULL
);


ALTER TABLE public.delivery OWNER TO postgres;

--
-- TOC entry 2867 (class 0 OID 0)
-- Dependencies: 204
-- Name: TABLE delivery; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE public.delivery IS 'Таблица описывает доставку газет к почтовым офисам';


--
-- TOC entry 207 (class 1259 OID 16615)
-- Name: edition; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.edition (
    edition_number integer NOT NULL,
    newspaper_name text NOT NULL,
    cost money NOT NULL,
    amount integer NOT NULL
);


ALTER TABLE public.edition OWNER TO postgres;

--
-- TOC entry 2868 (class 0 OID 0)
-- Dependencies: 207
-- Name: TABLE edition; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE public.edition IS 'Таблица описывает выпуск какой-либо газеты';


--
-- TOC entry 202 (class 1259 OID 16394)
-- Name: newspaper; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.newspaper (
    newspaper_name text NOT NULL,
    editor_name text NOT NULL,
    editor_surname text NOT NULL,
    editor_patronymic text,
    index integer NOT NULL
);


ALTER TABLE public.newspaper OWNER TO postgres;

--
-- TOC entry 2869 (class 0 OID 0)
-- Dependencies: 202
-- Name: TABLE newspaper; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE public.newspaper IS 'Таблица описывает газету';


--
-- TOC entry 203 (class 1259 OID 16423)
-- Name: post_office; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.post_office (
    post_office_number integer NOT NULL,
    adres text NOT NULL
);


ALTER TABLE public.post_office OWNER TO postgres;

--
-- TOC entry 2870 (class 0 OID 0)
-- Dependencies: 203
-- Name: TABLE post_office; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE public.post_office IS 'Таблица описывает почтовое отделение';


--
-- TOC entry 205 (class 1259 OID 16539)
-- Name: printing_office; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.printing_office (
    printing_office_name text NOT NULL,
    adres text NOT NULL
);


ALTER TABLE public.printing_office OWNER TO postgres;

--
-- TOC entry 2871 (class 0 OID 0)
-- Dependencies: 205
-- Name: TABLE printing_office; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE public.printing_office IS 'Таблица описывает типографию';


--
-- TOC entry 206 (class 1259 OID 16583)
-- Name: printing_order; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.printing_order (
    order_number integer NOT NULL,
    edition_number integer NOT NULL,
    printing_office_name text NOT NULL,
    newspaper_name text NOT NULL,
    amount integer NOT NULL
);


ALTER TABLE public.printing_order OWNER TO postgres;

--
-- TOC entry 2872 (class 0 OID 0)
-- Dependencies: 206
-- Name: TABLE printing_order; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE public.printing_order IS 'Таблица описывает заказ на печать выпуска газеты в типографии';


--
-- TOC entry 2856 (class 0 OID 16516)
-- Dependencies: 204
-- Data for Name: delivery; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.delivery (post_office_number, delivery_number, edition_number, newspaper_name, amount) VALUES (196241, 13214, 2, 'Газета 1', 44321);
INSERT INTO public.delivery (post_office_number, delivery_number, edition_number, newspaper_name, amount) VALUES (196228, 41321, 2, 'Газета 1', 135123);
INSERT INTO public.delivery (post_office_number, delivery_number, edition_number, newspaper_name, amount) VALUES (196228, 97453, 1, 'Газета 4', 734534);
INSERT INTO public.delivery (post_office_number, delivery_number, edition_number, newspaper_name, amount) VALUES (19624022, 122112, 1, 'Газета 1', 123123);
INSERT INTO public.delivery (post_office_number, delivery_number, edition_number, newspaper_name, amount) VALUES (19624022, 41221, 1, 'Газета 3', 141412);


--
-- TOC entry 2859 (class 0 OID 16615)
-- Dependencies: 207
-- Data for Name: edition; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.edition (edition_number, newspaper_name, cost, amount) VALUES (1, 'Газета 1', '2 200,00 ?', 212);
INSERT INTO public.edition (edition_number, newspaper_name, cost, amount) VALUES (2, 'Газета 1', '1 231,00 ?', 142112);
INSERT INTO public.edition (edition_number, newspaper_name, cost, amount) VALUES (1, 'Газета 2', '134 123,00 ?', 132123);
INSERT INTO public.edition (edition_number, newspaper_name, cost, amount) VALUES (1, 'Газета 3', '141 231,00 ?', 213123);
INSERT INTO public.edition (edition_number, newspaper_name, cost, amount) VALUES (1, 'Газета 4', '213 123,00 ?', 321321);


--
-- TOC entry 2854 (class 0 OID 16394)
-- Dependencies: 202
-- Data for Name: newspaper; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.newspaper (newspaper_name, editor_name, editor_surname, editor_patronymic, index) VALUES ('Газета 1', 'Александр', 'Пушкин', 'Сергеевич', 1);
INSERT INTO public.newspaper (newspaper_name, editor_name, editor_surname, editor_patronymic, index) VALUES ('Газета 2', 'Антон', 'Чехов', 'Павлович', 2);
INSERT INTO public.newspaper (newspaper_name, editor_name, editor_surname, editor_patronymic, index) VALUES ('Газета 3', 'Владимир', 'Маяковский', 'Владимирович', 3);
INSERT INTO public.newspaper (newspaper_name, editor_name, editor_surname, editor_patronymic, index) VALUES ('Газета 4', 'Михаил', 'Лермонтов', 'Юрьевич', 4);
INSERT INTO public.newspaper (newspaper_name, editor_name, editor_surname, editor_patronymic, index) VALUES ('Газета 5', 'Лев', 'Толстой', 'Николаевич', 5);


--
-- TOC entry 2855 (class 0 OID 16423)
-- Dependencies: 203
-- Data for Name: post_office; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.post_office (post_office_number, adres) VALUES (196241, 'Дом пушкина 2');
INSERT INTO public.post_office (post_office_number, adres) VALUES (196242, 'Дом пушкина 3');
INSERT INTO public.post_office (post_office_number, adres) VALUES (196243, 'Дом пушкина 4');
INSERT INTO public.post_office (post_office_number, adres) VALUES (196228, 'Дом пушкина 31');
INSERT INTO public.post_office (post_office_number, adres) VALUES (19624022, 'Дом пушкина 1');


--
-- TOC entry 2857 (class 0 OID 16539)
-- Dependencies: 205
-- Data for Name: printing_office; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.printing_office (printing_office_name, adres) VALUES ('Типография 1', '5-й предпортовый УЕЗД');
INSERT INTO public.printing_office (printing_office_name, adres) VALUES ('Типография 2', '6-й Предпортовый УЕЗД');
INSERT INTO public.printing_office (printing_office_name, adres) VALUES ('Типография 3', '7-й предпортовый Уезд');
INSERT INTO public.printing_office (printing_office_name, adres) VALUES ('Типография 4', '8-й Предпортовый Уезд');
INSERT INTO public.printing_office (printing_office_name, adres) VALUES ('Типография 5', '9-й Предпортовый уезд');


--
-- TOC entry 2858 (class 0 OID 16583)
-- Dependencies: 206
-- Data for Name: printing_order; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.printing_order (order_number, edition_number, printing_office_name, newspaper_name, amount) VALUES (1, 1, 'Типография 1', 'Газета 1', 12312);
INSERT INTO public.printing_order (order_number, edition_number, printing_office_name, newspaper_name, amount) VALUES (2, 2, 'Типография 2', 'Газета 1', 13121);
INSERT INTO public.printing_order (order_number, edition_number, printing_office_name, newspaper_name, amount) VALUES (3, 1, 'Типография 3', 'Газета 2', 31312);
INSERT INTO public.printing_order (order_number, edition_number, printing_office_name, newspaper_name, amount) VALUES (4, 1, 'Типография 4', 'Газета 3', 65132);
INSERT INTO public.printing_order (order_number, edition_number, printing_office_name, newspaper_name, amount) VALUES (5, 1, 'Типография 2', 'Газета 4', 432121);


--
-- TOC entry 2716 (class 2606 OID 16523)
-- Name: delivery delivery_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.delivery
    ADD CONSTRAINT delivery_pkey PRIMARY KEY (delivery_number);


--
-- TOC entry 2722 (class 2606 OID 16622)
-- Name: edition edition_pk; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.edition
    ADD CONSTRAINT edition_pk PRIMARY KEY (edition_number, newspaper_name);


--
-- TOC entry 2712 (class 2606 OID 16417)
-- Name: newspaper newspaper_name; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.newspaper
    ADD CONSTRAINT newspaper_name PRIMARY KEY (newspaper_name);


--
-- TOC entry 2714 (class 2606 OID 16430)
-- Name: post_office post_office_number; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.post_office
    ADD CONSTRAINT post_office_number PRIMARY KEY (post_office_number);


--
-- TOC entry 2718 (class 2606 OID 16546)
-- Name: printing_office printing_office_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.printing_office
    ADD CONSTRAINT printing_office_pkey PRIMARY KEY (printing_office_name);


--
-- TOC entry 2720 (class 2606 OID 16590)
-- Name: printing_order printing_order_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.printing_order
    ADD CONSTRAINT printing_order_pkey PRIMARY KEY (order_number);


--
-- TOC entry 2723 (class 2606 OID 16628)
-- Name: delivery delivery_pk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.delivery
    ADD CONSTRAINT delivery_pk FOREIGN KEY (newspaper_name, edition_number) REFERENCES public.edition(newspaper_name, edition_number) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 2727 (class 2606 OID 16623)
-- Name: edition edition_fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.edition
    ADD CONSTRAINT edition_fk FOREIGN KEY (newspaper_name) REFERENCES public.newspaper(newspaper_name) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 2726 (class 2606 OID 16638)
-- Name: printing_order edition_fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.printing_order
    ADD CONSTRAINT edition_fk FOREIGN KEY (edition_number, newspaper_name) REFERENCES public.edition(edition_number, newspaper_name) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 2724 (class 2606 OID 16643)
-- Name: delivery post_office_name_fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.delivery
    ADD CONSTRAINT post_office_name_fk FOREIGN KEY (post_office_number) REFERENCES public.post_office(post_office_number) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 2725 (class 2606 OID 16633)
-- Name: printing_order printing_office_name_fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.printing_order
    ADD CONSTRAINT printing_office_name_fk FOREIGN KEY (printing_office_name) REFERENCES public.printing_office(printing_office_name) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE;


-- Completed on 2020-04-25 18:23:31

--
-- PostgreSQL database dump complete
--

