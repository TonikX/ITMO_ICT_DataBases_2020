--
-- PostgreSQL database dump
--

-- Dumped from database version 12.2
-- Dumped by pg_dump version 12.2

-- Started on 2020-05-31 16:55:26

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

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 203 (class 1259 OID 16399)
-- Name: breed; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.breed (
    id_breed integer NOT NULL,
    performance integer NOT NULL,
    breed_title character varying(100)
);


ALTER TABLE public.breed OWNER TO postgres;

--
-- TOC entry 2906 (class 0 OID 0)
-- Dependencies: 203
-- Name: TABLE breed; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE public.breed IS 'Хранит информацию о породе курицы';


--
-- TOC entry 208 (class 1259 OID 16447)
-- Name: breed_diet; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.breed_diet (
    id_breed integer,
    id_diet integer,
    id integer NOT NULL
);


ALTER TABLE public.breed_diet OWNER TO postgres;

--
-- TOC entry 2907 (class 0 OID 0)
-- Dependencies: 208
-- Name: TABLE breed_diet; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE public.breed_diet IS 'Таблица связи пород и диет';


--
-- TOC entry 215 (class 1259 OID 16506)
-- Name: breed_diet_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public.breed_diet ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.breed_diet_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- TOC entry 205 (class 1259 OID 16419)
-- Name: breed_id_breed_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public.breed ALTER COLUMN id_breed ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.breed_id_breed_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- TOC entry 209 (class 1259 OID 16460)
-- Name: cell; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.cell (
    id_cell integer NOT NULL,
    row_number integer,
    number_in_row integer,
    shop integer
);


ALTER TABLE public.cell OWNER TO postgres;

--
-- TOC entry 2908 (class 0 OID 0)
-- Dependencies: 209
-- Name: TABLE cell; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE public.cell IS 'Содержит информацию о клетке';


--
-- TOC entry 210 (class 1259 OID 16470)
-- Name: cell_id_cell_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public.cell ALTER COLUMN id_cell ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.cell_id_cell_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- TOC entry 202 (class 1259 OID 16394)
-- Name: chicken; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.chicken (
    id_chicken integer NOT NULL,
    chicken_weight integer,
    number_of_eggs integer,
    breed integer DEFAULT 3,
    cell integer DEFAULT 3
);


ALTER TABLE public.chicken OWNER TO postgres;

--
-- TOC entry 2909 (class 0 OID 0)
-- Dependencies: 202
-- Name: TABLE chicken; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE public.chicken IS 'Хранит информацию о курице';


--
-- TOC entry 204 (class 1259 OID 16412)
-- Name: chicken_id_chiken_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public.chicken ALTER COLUMN id_chicken ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.chicken_id_chiken_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- TOC entry 213 (class 1259 OID 16487)
-- Name: worker_cell; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.worker_cell (
    id_cell integer,
    id_worker integer,
    id integer NOT NULL
);


ALTER TABLE public.worker_cell OWNER TO postgres;

--
-- TOC entry 2910 (class 0 OID 0)
-- Dependencies: 213
-- Name: TABLE worker_cell; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE public.worker_cell IS 'Таблица, связывающая куриц и работников';


--
-- TOC entry 217 (class 1259 OID 24578)
-- Name: chicken_worker_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public.worker_cell ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.chicken_worker_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- TOC entry 207 (class 1259 OID 16439)
-- Name: diet; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.diet (
    id_diet integer NOT NULL,
    diet_number integer NOT NULL,
    diet_content character varying(500) NOT NULL
);


ALTER TABLE public.diet OWNER TO postgres;

--
-- TOC entry 2911 (class 0 OID 0)
-- Dependencies: 207
-- Name: TABLE diet; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE public.diet IS 'Содержит информацию о диете';


--
-- TOC entry 2912 (class 0 OID 0)
-- Dependencies: 207
-- Name: COLUMN diet.diet_number; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.diet.diet_number IS 'Номер диеты';


--
-- TOC entry 206 (class 1259 OID 16435)
-- Name: diet_id_diet_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public.diet ALTER COLUMN id_diet ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.diet_id_diet_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- TOC entry 211 (class 1259 OID 16472)
-- Name: shop; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.shop (
    id_shop integer NOT NULL,
    number_of_shop integer
);


ALTER TABLE public.shop OWNER TO postgres;

--
-- TOC entry 2913 (class 0 OID 0)
-- Dependencies: 211
-- Name: TABLE shop; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE public.shop IS 'Хранит информацию о цехе';


--
-- TOC entry 214 (class 1259 OID 16502)
-- Name: shop_id_shop_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public.shop ALTER COLUMN id_shop ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.shop_id_shop_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- TOC entry 212 (class 1259 OID 16482)
-- Name: worker; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.worker (
    id_worker integer NOT NULL,
    fio character varying(100),
    passport character varying(100) NOT NULL,
    salary integer,
    birth_date date
);


ALTER TABLE public.worker OWNER TO postgres;

--
-- TOC entry 2914 (class 0 OID 0)
-- Dependencies: 212
-- Name: TABLE worker; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE public.worker IS 'Содержит информацию о работнике птицефабрики';


--
-- TOC entry 216 (class 1259 OID 16508)
-- Name: worker_id_worker_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public.worker ALTER COLUMN id_worker ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.worker_id_worker_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- TOC entry 2886 (class 0 OID 16399)
-- Dependencies: 203
-- Data for Name: breed; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.breed (id_breed, performance, breed_title) FROM stdin;
3	3	Первая порода
4	27	Вторая порода
5	20	Третья порода
6	15	Четвертая порода
7	23	Пятая порода
10	3	Шестая порода
12	3	3
\.


--
-- TOC entry 2891 (class 0 OID 16447)
-- Dependencies: 208
-- Data for Name: breed_diet; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.breed_diet (id_breed, id_diet, id) FROM stdin;
4	5	2
5	3	3
6	3	4
7	3	5
7	1	1
5	4	6
\.


--
-- TOC entry 2892 (class 0 OID 16460)
-- Dependencies: 209
-- Data for Name: cell; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.cell (id_cell, row_number, number_in_row, shop) FROM stdin;
2	1	1	1
3	1	2	1
4	2	1	3
5	3	3	5
\.


--
-- TOC entry 2885 (class 0 OID 16394)
-- Dependencies: 202
-- Data for Name: chicken; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.chicken (id_chicken, chicken_weight, number_of_eggs, breed, cell) FROM stdin;
3	4	25	6	3
4	6	28	7	3
1	5	34	3	2
2	5	38	5	2
58	7	28	3	4
59	7	28	3	4
\.


--
-- TOC entry 2890 (class 0 OID 16439)
-- Dependencies: 207
-- Data for Name: diet; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.diet (id_diet, diet_number, diet_content) FROM stdin;
2	2	Вторая диета
3	3	Третья диета
4	4	Четвертая диета
5	5	Пятая диета
1	1	Первая диета 1
6	6	Пятая диета 2
8	6	Пятая диета 2
9	6	Пятая диета 3
10	6	Пятая диета 3
11	6	Пятая диета 4
12	6	Пятая диета 4
13	6	Пятая диета 4
14	6	Пятая диета 4
15	6	Пятая диета 4
16	6	Пятая диета 4
576	6	Пятая диета 4
\.


--
-- TOC entry 2894 (class 0 OID 16472)
-- Dependencies: 211
-- Data for Name: shop; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.shop (id_shop, number_of_shop) FROM stdin;
1	1
2	2
4	4
5	5
3	3
\.


--
-- TOC entry 2895 (class 0 OID 16482)
-- Dependencies: 212
-- Data for Name: worker; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.worker (id_worker, fio, passport, salary, birth_date) FROM stdin;
1	Иванов Иван Иванович	1234 567890	12000	2000-01-01
2	Иванов Петр Иванович	1234 567891	15000	2000-01-02
3	Петров Дмитрий Иванович	1234 567892	16000	2000-02-01
4	Петров Александр Юрьевич	1234 567893	30000	2000-02-02
5	Петров Павел Геннадьевич	1234 567894	25700	2001-03-01
6	Клишин Никита Дмитриевич	1234 343554	170000	2000-06-14
\.


--
-- TOC entry 2896 (class 0 OID 16487)
-- Dependencies: 213
-- Data for Name: worker_cell; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.worker_cell (id_cell, id_worker, id) FROM stdin;
1	1	1
2	2	2
3	2	3
4	5	4
3	4	5
\.


--
-- TOC entry 2915 (class 0 OID 0)
-- Dependencies: 215
-- Name: breed_diet_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.breed_diet_id_seq', 10, true);


--
-- TOC entry 2916 (class 0 OID 0)
-- Dependencies: 205
-- Name: breed_id_breed_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.breed_id_breed_seq', 12, true);


--
-- TOC entry 2917 (class 0 OID 0)
-- Dependencies: 210
-- Name: cell_id_cell_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.cell_id_cell_seq', 11, true);


--
-- TOC entry 2918 (class 0 OID 0)
-- Dependencies: 204
-- Name: chicken_id_chiken_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.chicken_id_chiken_seq', 59, true);


--
-- TOC entry 2919 (class 0 OID 0)
-- Dependencies: 217
-- Name: chicken_worker_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.chicken_worker_id_seq', 7, true);


--
-- TOC entry 2920 (class 0 OID 0)
-- Dependencies: 206
-- Name: diet_id_diet_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.diet_id_diet_seq', 576, true);


--
-- TOC entry 2921 (class 0 OID 0)
-- Dependencies: 214
-- Name: shop_id_shop_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.shop_id_shop_seq', 7, true);


--
-- TOC entry 2922 (class 0 OID 0)
-- Dependencies: 216
-- Name: worker_id_worker_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.worker_id_worker_seq', 7, true);


--
-- TOC entry 2741 (class 2606 OID 16505)
-- Name: breed_diet breed_diet_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.breed_diet
    ADD CONSTRAINT breed_diet_pkey PRIMARY KEY (id);


--
-- TOC entry 2737 (class 2606 OID 16406)
-- Name: breed breed_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.breed
    ADD CONSTRAINT breed_pkey PRIMARY KEY (id_breed);


--
-- TOC entry 2743 (class 2606 OID 16464)
-- Name: cell cell_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cell
    ADD CONSTRAINT cell_pkey PRIMARY KEY (id_cell);


--
-- TOC entry 2735 (class 2606 OID 16398)
-- Name: chicken chicken_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.chicken
    ADD CONSTRAINT chicken_pkey PRIMARY KEY (id_chicken);


--
-- TOC entry 2749 (class 2606 OID 24577)
-- Name: worker_cell chicken_worker_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.worker_cell
    ADD CONSTRAINT chicken_worker_pkey PRIMARY KEY (id);


--
-- TOC entry 2739 (class 2606 OID 16446)
-- Name: diet diet_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.diet
    ADD CONSTRAINT diet_pkey PRIMARY KEY (id_diet);


--
-- TOC entry 2745 (class 2606 OID 16476)
-- Name: shop shop_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.shop
    ADD CONSTRAINT shop_pkey PRIMARY KEY (id_shop);


--
-- TOC entry 2747 (class 2606 OID 16486)
-- Name: worker worker_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.worker
    ADD CONSTRAINT worker_pkey PRIMARY KEY (id_worker);


--
-- TOC entry 2750 (class 1259 OID 16495)
-- Name: fki_chiken; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX fki_chiken ON public.worker_cell USING btree (id_cell);


--
-- TOC entry 2751 (class 1259 OID 16501)
-- Name: fki_worker; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX fki_worker ON public.worker_cell USING btree (id_worker);


--
-- TOC entry 2754 (class 2606 OID 16450)
-- Name: breed_diet breed; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.breed_diet
    ADD CONSTRAINT breed FOREIGN KEY (id_breed) REFERENCES public.breed(id_breed);


--
-- TOC entry 2923 (class 0 OID 0)
-- Dependencies: 2754
-- Name: CONSTRAINT breed ON breed_diet; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON CONSTRAINT breed ON public.breed_diet IS 'Внешний ключ к таблице breed';


--
-- TOC entry 2752 (class 2606 OID 32770)
-- Name: chicken chicken___breed; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.chicken
    ADD CONSTRAINT chicken___breed FOREIGN KEY (breed) REFERENCES public.breed(id_breed) ON DELETE CASCADE;


--
-- TOC entry 2753 (class 2606 OID 32813)
-- Name: chicken chicken___cell; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.chicken
    ADD CONSTRAINT chicken___cell FOREIGN KEY (cell) REFERENCES public.cell(id_cell) ON DELETE CASCADE;


--
-- TOC entry 2757 (class 2606 OID 16490)
-- Name: worker_cell chiken; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.worker_cell
    ADD CONSTRAINT chiken FOREIGN KEY (id_cell) REFERENCES public.chicken(id_chicken);


--
-- TOC entry 2924 (class 0 OID 0)
-- Dependencies: 2757
-- Name: CONSTRAINT chiken ON worker_cell; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON CONSTRAINT chiken ON public.worker_cell IS 'Внешний ключ к таблице chicken';


--
-- TOC entry 2755 (class 2606 OID 16455)
-- Name: breed_diet diet; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.breed_diet
    ADD CONSTRAINT diet FOREIGN KEY (id_diet) REFERENCES public.diet(id_diet);


--
-- TOC entry 2925 (class 0 OID 0)
-- Dependencies: 2755
-- Name: CONSTRAINT diet ON breed_diet; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON CONSTRAINT diet ON public.breed_diet IS 'Внешний ключ к таблице diet';


--
-- TOC entry 2756 (class 2606 OID 16477)
-- Name: cell shop; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cell
    ADD CONSTRAINT shop FOREIGN KEY (shop) REFERENCES public.shop(id_shop) ON DELETE CASCADE;


--
-- TOC entry 2758 (class 2606 OID 16496)
-- Name: worker_cell worker; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.worker_cell
    ADD CONSTRAINT worker FOREIGN KEY (id_worker) REFERENCES public.worker(id_worker);


--
-- TOC entry 2926 (class 0 OID 0)
-- Dependencies: 2758
-- Name: CONSTRAINT worker ON worker_cell; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON CONSTRAINT worker ON public.worker_cell IS 'Внешний ключ к таблице worker';


-- Completed on 2020-05-31 16:55:30

--
-- PostgreSQL database dump complete
--

