--
-- PostgreSQL database dump
--

-- Dumped from database version 12.2
-- Dumped by pg_dump version 12.2

-- Started on 2020-04-20 22:31:30

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'SQL_ASCII';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 206 (class 1259 OID 16678)
-- Name: Distribution; Type: TABLE; Schema: public; Owner: postgres
--
--'Таблица распределения хранит в себе соответствующего ID_Тиража, ID_Почты и количество газет, которое отправлено в то или иное отделение'
-- 
CREATE TABLE public."Distribution" (
    "ID_Distribution" integer NOT NULL,
    "ID_Post" integer,
    "ID_Edition" integer,
    "Full_quantity_newspaper" integer
);


ALTER TABLE public."Distribution" OWNER TO postgres;

--
-- TOC entry 2886 (class 0 OID 0)
-- Dependencies: 206
-- Name: TABLE "Distribution"; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE public."Distribution" IS 'Таблица распределения хранит в себе соответствующего ID_Тиража, ID_Почты и количество газет, которое отправлено в то или иное отделение';


--
-- TOC entry 213 (class 1259 OID 16753)
-- Name: Distribution_ID_Distribution_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public."Distribution" ALTER COLUMN "ID_Distribution" ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public."Distribution_ID_Distribution_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 23345546
    CACHE 1
);


--
-- TOC entry 204 (class 1259 OID 16634)
-- Name: Edition; Type: TABLE; Schema: public; Owner: postgres
--
--Таблица хранения Тиража газеты, хранит ID_Газеты, Номер издания, Необходимое количество на печать, и цену за единичный экземпляр'
--
CREATE TABLE public."Edition" (
    "ID_Edition" integer NOT NULL,
    "ID_Newspaper" integer NOT NULL,
    "Publication_number" integer,
    "Newspaper_amount" integer,
    "Price" text
);


ALTER TABLE public."Edition" OWNER TO postgres;

--
-- TOC entry 2887 (class 0 OID 0)
-- Dependencies: 204
-- Name: TABLE "Edition"; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE public."Edition" IS 'Таблица хранения Тиража газеты, хранит ID_Газеты, Номер издания, Необходимое количество на печать, и цену за единичный экземпляр';


--
-- TOC entry 209 (class 1259 OID 16744)
-- Name: Edition_ID_Edition_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public."Edition" ALTER COLUMN "ID_Edition" ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public."Edition_ID_Edition_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 23335456
    CACHE 1
);


--
-- TOC entry 202 (class 1259 OID 16604)
-- Name: Newspaper; Type: TABLE; Schema: public; Owner: postgres
--
--'Таблица газет, где хранится Имя, Индекс внутри почтовой системы и Имя главреда'
--
CREATE TABLE public."Newspaper" (
    "ID_Newspaper" integer NOT NULL,
    "Naming" text,
    "Index" text,
    "Reductor" text
);


ALTER TABLE public."Newspaper" OWNER TO postgres;

--
-- TOC entry 2888 (class 0 OID 0)
-- Dependencies: 202
-- Name: TABLE "Newspaper"; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE public."Newspaper" IS 'Таблица газет, где хранится Имя, Индекс внутри почтовой системы и Имя главреда';


--
-- TOC entry 208 (class 1259 OID 16742)
-- Name: Newspaper_ID_Newspaper_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public."Newspaper" ALTER COLUMN "ID_Newspaper" ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public."Newspaper_ID_Newspaper_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 232445226
    CACHE 1
);


--
-- TOC entry 207 (class 1259 OID 16727)
-- Name: Postoffice; Type: TABLE; Schema: public; Owner: postgres
--
--'Таблица почтовых отделений, хранящая в себе номер отделения и адрес отделения'
--
CREATE TABLE public."Postoffice" (
    "ID_Post" integer NOT NULL,
    "Branch_number" integer,
    "Post_adress" text
);


ALTER TABLE public."Postoffice" OWNER TO postgres;

--
-- TOC entry 2889 (class 0 OID 0)
-- Dependencies: 207
-- Name: TABLE "Postoffice"; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE public."Postoffice" IS 'Таблица почтовых отделений, хранящая в себе номер отделения и адрес отделения';


--
-- TOC entry 212 (class 1259 OID 16751)
-- Name: Postoffice_ID_Post_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public."Postoffice" ALTER COLUMN "ID_Post" ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public."Postoffice_ID_Post_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 2442255
    CACHE 1
);


--
-- TOC entry 205 (class 1259 OID 16673)
-- Name: Print; Type: TABLE; Schema: public; Owner: postgres
--
--'Таблица хранения Печати, хранит ID_Тиража, Напечатанное количество в той или иной типографии и ID_Типографии'
--
CREATE TABLE public."Print" (
    "ID_Print" integer NOT NULL,
    "ID_Edition" integer,
    "ID_Tipography" integer,
    "Printed_quantity" integer
);


ALTER TABLE public."Print" OWNER TO postgres;

--
-- TOC entry 2890 (class 0 OID 0)
-- Dependencies: 205
-- Name: TABLE "Print"; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE public."Print" IS 'Таблица хранения Печати, хранит ID_Тиража, Напечатанное количество в той или иной типографии и ID_Типографии';


--
-- TOC entry 211 (class 1259 OID 16749)
-- Name: Print_ID_Print_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public."Print" ALTER COLUMN "ID_Print" ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public."Print_ID_Print_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 23345336
    CACHE 1
);


--
-- TOC entry 203 (class 1259 OID 16614)
-- Name: Tipography; Type: TABLE; Schema: public; Owner: postgres
--
--'Таблица хранения данных о Типографиях, её Имя и Адрес типографии'
--
CREATE TABLE public."Tipography" (
    "ID_Tipography" integer NOT NULL,
    "Tipography_name" text,
    "Tipography_adress" text
);


ALTER TABLE public."Tipography" OWNER TO postgres;

--
-- TOC entry 2891 (class 0 OID 0)
-- Dependencies: 203
-- Name: TABLE "Tipography"; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE public."Tipography" IS 'Таблица хранения данных о Типографиях, её Имя и Адрес типографии';


--
-- TOC entry 210 (class 1259 OID 16746)
-- Name: Tipography_ID_Tipography_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public."Tipography" ALTER COLUMN "ID_Tipography" ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public."Tipography_ID_Tipography_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 23435353
    CACHE 1
);


--
-- TOC entry 2873 (class 0 OID 16678)
-- Dependencies: 206
-- Data for Name: Distribution; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public."Distribution" ("ID_Distribution", "ID_Post", "ID_Edition", "Full_quantity_newspaper") FROM stdin;
1	1	1	40
2	2	2	30
3	3	3	25
\.


--
-- TOC entry 2871 (class 0 OID 16634)
-- Dependencies: 204
-- Data for Name: Edition; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public."Edition" ("ID_Edition", "ID_Newspaper", "Publication_number", "Newspaper_amount", "Price") FROM stdin;
1	1	2	40	75р.
2	2	7	30	50р.
3	3	9	25	65р.
\.


--
-- TOC entry 2869 (class 0 OID 16604)
-- Dependencies: 202
-- Data for Name: Newspaper; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public."Newspaper" ("ID_Newspaper", "Naming", "Index", "Reductor") FROM stdin;
1	Аргументы и Факты	Э32545	Сергей Васильков
2	Мир Сказок	Э25678	Никита Михалков
3	Спас	Э77784	Виктор Маленьков
\.


--
-- TOC entry 2874 (class 0 OID 16727)
-- Dependencies: 207
-- Data for Name: Postoffice; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public."Postoffice" ("ID_Post", "Branch_number", "Post_adress") FROM stdin;
1	1	ул. Энгельса, д.17
2	7	пр-т Калинина, д.34
3	17	ул.Жукова, д.22
\.


--
-- TOC entry 2872 (class 0 OID 16673)
-- Dependencies: 205
-- Data for Name: Print; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public."Print" ("ID_Print", "ID_Edition", "ID_Tipography", "Printed_quantity") FROM stdin;
1	1	2	30
2	1	1	10
3	2	3	30
4	3	1	25
\.


--
-- TOC entry 2870 (class 0 OID 16614)
-- Dependencies: 203
-- Data for Name: Tipography; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public."Tipography" ("ID_Tipography", "Tipography_name", "Tipography_adress") FROM stdin;
1	ООО Циферблат	ул.Ленина, д. 26
2	ООО Моя Оборона	ул.Летняя, д. 73/110
3	ООО Ленинпринт	ул.Троцкого, д. 23
\.


--
-- TOC entry 2892 (class 0 OID 0)
-- Dependencies: 213
-- Name: Distribution_ID_Distribution_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."Distribution_ID_Distribution_seq"', 3, true);


--
-- TOC entry 2893 (class 0 OID 0)
-- Dependencies: 209
-- Name: Edition_ID_Edition_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."Edition_ID_Edition_seq"', 3, true);


--
-- TOC entry 2894 (class 0 OID 0)
-- Dependencies: 208
-- Name: Newspaper_ID_Newspaper_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."Newspaper_ID_Newspaper_seq"', 6, true);


--
-- TOC entry 2895 (class 0 OID 0)
-- Dependencies: 212
-- Name: Postoffice_ID_Post_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."Postoffice_ID_Post_seq"', 3, true);


--
-- TOC entry 2896 (class 0 OID 0)
-- Dependencies: 211
-- Name: Print_ID_Print_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."Print_ID_Print_seq"', 4, true);


--
-- TOC entry 2897 (class 0 OID 0)
-- Dependencies: 210
-- Name: Tipography_ID_Tipography_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."Tipography_ID_Tipography_seq"', 3, true);


--
-- TOC entry 2733 (class 2606 OID 16682)
-- Name: Distribution Distribution_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Distribution"
    ADD CONSTRAINT "Distribution_pkey" PRIMARY KEY ("ID_Distribution");


--
-- TOC entry 2726 (class 2606 OID 16638)
-- Name: Edition Edition_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Edition"
    ADD CONSTRAINT "Edition_pkey" PRIMARY KEY ("ID_Edition");


--
-- TOC entry 2722 (class 2606 OID 16611)
-- Name: Newspaper Newspaper_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Newspaper"
    ADD CONSTRAINT "Newspaper_pkey" PRIMARY KEY ("ID_Newspaper");


--
-- TOC entry 2737 (class 2606 OID 16734)
-- Name: Postoffice Postoffice_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Postoffice"
    ADD CONSTRAINT "Postoffice_pkey" PRIMARY KEY ("ID_Post");


--
-- TOC entry 2729 (class 2606 OID 16677)
-- Name: Print Print_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Print"
    ADD CONSTRAINT "Print_pkey" PRIMARY KEY ("ID_Print");


--
-- TOC entry 2724 (class 2606 OID 16621)
-- Name: Tipography Tipography_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Tipography"
    ADD CONSTRAINT "Tipography_pkey" PRIMARY KEY ("ID_Tipography");


--
-- TOC entry 2730 (class 1259 OID 16688)
-- Name: fki_ID_Edition; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fki_ID_Edition" ON public."Print" USING btree ("ID_Edition");


--
-- TOC entry 2734 (class 1259 OID 16711)
-- Name: fki_ID_Edition_D; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fki_ID_Edition_D" ON public."Distribution" USING btree ("ID_Edition");


--
-- TOC entry 2727 (class 1259 OID 16646)
-- Name: fki_ID_Newspaper; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fki_ID_Newspaper" ON public."Edition" USING btree ("ID_Newspaper");


--
-- TOC entry 2735 (class 1259 OID 16700)
-- Name: fki_ID_Post; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fki_ID_Post" ON public."Distribution" USING btree ("ID_Post");


--
-- TOC entry 2731 (class 1259 OID 16694)
-- Name: fki_ID_Tipography; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fki_ID_Tipography" ON public."Print" USING btree ("ID_Tipography");


--
-- TOC entry 2739 (class 2606 OID 16683)
-- Name: Print ID_Edition; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Print"
    ADD CONSTRAINT "ID_Edition" FOREIGN KEY ("ID_Edition") REFERENCES public."Edition"("ID_Edition") NOT VALID;


--
-- TOC entry 2741 (class 2606 OID 16701)
-- Name: Distribution ID_Edition; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Distribution"
    ADD CONSTRAINT "ID_Edition" FOREIGN KEY ("ID_Edition") REFERENCES public."Edition"("ID_Edition") NOT VALID;


--
-- TOC entry 2738 (class 2606 OID 16641)
-- Name: Edition ID_Newspaper; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Edition"
    ADD CONSTRAINT "ID_Newspaper" FOREIGN KEY ("ID_Newspaper") REFERENCES public."Newspaper"("ID_Newspaper") NOT VALID;


--
-- TOC entry 2742 (class 2606 OID 16735)
-- Name: Distribution ID_Post; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Distribution"
    ADD CONSTRAINT "ID_Post" FOREIGN KEY ("ID_Post") REFERENCES public."Postoffice"("ID_Post") NOT VALID;


--
-- TOC entry 2740 (class 2606 OID 16689)
-- Name: Print ID_Tipography; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Print"
    ADD CONSTRAINT "ID_Tipography" FOREIGN KEY ("ID_Tipography") REFERENCES public."Tipography"("ID_Tipography") NOT VALID;


--Заполнение таблицы Newspaper(газета)
INSERT INTO public."Newspaper"("ID_Newspaper", "Naming", "Index", "Reductor")VALUES (Default, 'Аргументы и Факты', 'Э32545', 'Сергей Васильков');
INSERT INTO public."Newspaper"("ID_Newspaper", "Naming", "Index", "Reductor")VALUES (Default, 'Мир Сказок', 'Э25678', 'Никита Михалков');
INSERT INTO public."Newspaper"("ID_Newspaper", "Naming", "Index", "Reductor")VALUES (Default, 'Спас', 'Э77784', 'Виктор Маленьков');


--Заполнение таблицы Edition(тираж)
INSERT INTO public."Edition"("ID_Edition", "ID_Newspaper", "Publication_number", "Newspaper_amount", "Price")VALUES (DEFAULT, 1, 2, 40, '75р.');
INSERT INTO public."Edition"("ID_Edition", "ID_Newspaper", "Publication_number", "Newspaper_amount", "Price")VALUES (DEFAULT, 2, 7, 30, '50р.');
INSERT INTO public."Edition"("ID_Edition", "ID_Newspaper", "Publication_number", "Newspaper_amount", "Price")VALUES (DEFAULT, 3, 9, 25, '65р.');


--Заполнение таблицы Tipography(типография)
INSERT INTO public."Tipography"("ID_Tipography", "Tipography_name", "Tipography_adress")VALUES (DEFAULT, 'ООО Циферблат', 'ул.Ленина, д. 26');
INSERT INTO public."Tipography"("ID_Tipography", "Tipography_name", "Tipography_adress")VALUES (DEFAULT, 'ООО Моя Оборона', 'ул.Летняя, д. 73/110');
INSERT INTO public."Tipography"("ID_Tipography", "Tipography_name", "Tipography_adress")VALUES (DEFAULT, 'ООО Ленинпринт', 'ул.Троцкого, д. 23');


--Заполнение таблицы Print(Печать)
INSERT INTO public."Print"("ID_Print", "ID_Edition", "ID_Tipography", "Printed_quantity")VALUES (DEFAULT, 1, 2, 30);
INSERT INTO public."Print"("ID_Print", "ID_Edition", "ID_Tipography", "Printed_quantity")VALUES (DEFAULT, 1, 1, 10);
INSERT INTO public."Print"("ID_Print", "ID_Edition", "ID_Tipography", "Printed_quantity")VALUES (DEFAULT, 2, 3, 30);
INSERT INTO public."Print"("ID_Print", "ID_Edition", "ID_Tipography", "Printed_quantity")VALUES (DEFAULT, 3, 1, 25);


--Заполнение таблицы Postoffice(Почта)
INSERT INTO public."Postoffice"("ID_Post", "Branch_number", "Post_adress")VALUES (DEFAULT, 1, 'ул. Энгельса, д.17');
INSERT INTO public."Postoffice"("ID_Post", "Branch_number", "Post_adress")VALUES (DEFAULT, 7, 'пр-т Калинина, д.34');
INSERT INTO public."Postoffice"("ID_Post", "Branch_number", "Post_adress")VALUES (DEFAULT, 17, 'ул.Жукова, д.22');

--Заполнение таблицы Distribution(Распределение)
INSERT INTO public."Distribution"("ID_Distribution", "ID_Post", "ID_Edition", "Full_quantity_newspaper")VALUES (DEFAULT, 1, 1, 40);
INSERT INTO public."Distribution"("ID_Distribution", "ID_Post", "ID_Edition", "Full_quantity_newspaper")VALUES (DEFAULT, 2, 2, 30);
INSERT INTO public."Distribution"("ID_Distribution", "ID_Post", "ID_Edition", "Full_quantity_newspaper")VALUES (DEFAULT, 3, 3, 25);


-- Completed on 2020-04-20 22:31:30

--
-- PostgreSQL database dump complete
--

