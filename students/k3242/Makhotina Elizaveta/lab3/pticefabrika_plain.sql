--
-- PostgreSQL database dump
--

-- Dumped from database version 12.2
-- Dumped by pg_dump version 12.2

-- Started on 2020-04-21 17:53:55

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
-- TOC entry 204 (class 1259 OID 16697)
-- Name: Порода; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."Порода" (
    "название_породы" text NOT NULL,
    "производительность" integer NOT NULL,
    "средний_вес" integer NOT NULL,
    "содержание_диеты" text NOT NULL
);


ALTER TABLE public."Порода" OWNER TO postgres;

--
-- TOC entry 206 (class 1259 OID 16714)
-- Name: директор; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."директор" (
    "фио_директора" text NOT NULL
);


ALTER TABLE public."директор" OWNER TO postgres;

--
-- TOC entry 208 (class 1259 OID 16722)
-- Name: клетка; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."клетка" (
    "id_клетки" integer NOT NULL,
    "ряд_клетки" integer NOT NULL,
    "номер_клетки" integer NOT NULL,
    "вместительность" integer NOT NULL,
    "номер_цеха_fk" integer NOT NULL
);


ALTER TABLE public."клетка" OWNER TO postgres;

--
-- TOC entry 207 (class 1259 OID 16720)
-- Name: клетка_id_клетки_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public."клетка_id_клетки_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public."клетка_id_клетки_seq" OWNER TO postgres;

--
-- TOC entry 2889 (class 0 OID 0)
-- Dependencies: 207
-- Name: клетка_id_клетки_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public."клетка_id_клетки_seq" OWNED BY public."клетка"."id_клетки";


--
-- TOC entry 203 (class 1259 OID 16688)
-- Name: курица; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."курица" (
    "серийный_номер_курицы" integer NOT NULL,
    "вес" integer NOT NULL,
    "название_породы_fk" text NOT NULL,
    "возраст" integer NOT NULL,
    "кол_во_яиц" integer NOT NULL,
    "id_клетки_fk" integer NOT NULL
);


ALTER TABLE public."курица" OWNER TO postgres;

--
-- TOC entry 213 (class 1259 OID 16756)
-- Name: курица_id_клетки_fk_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public."курица_id_клетки_fk_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public."курица_id_клетки_fk_seq" OWNER TO postgres;

--
-- TOC entry 2890 (class 0 OID 0)
-- Dependencies: 213
-- Name: курица_id_клетки_fk_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public."курица_id_клетки_fk_seq" OWNED BY public."курица"."id_клетки_fk";


--
-- TOC entry 202 (class 1259 OID 16686)
-- Name: курица_серийный_номер_курицы_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public."курица_серийный_номер_курицы_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public."курица_серийный_номер_курицы_seq" OWNER TO postgres;

--
-- TOC entry 2891 (class 0 OID 0)
-- Dependencies: 202
-- Name: курица_серийный_номер_курицы_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public."курица_серийный_номер_курицы_seq" OWNED BY public."курица"."серийный_номер_курицы";


--
-- TOC entry 212 (class 1259 OID 16734)
-- Name: отчет; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."отчет" (
    "id_работника_fk" integer NOT NULL,
    "количество_яиц" integer NOT NULL,
    "количество_кур" integer NOT NULL,
    "с_п_породы" integer NOT NULL,
    "с_п_цеха" integer NOT NULL,
    "производительность_птицефабрики" integer NOT NULL
);


ALTER TABLE public."отчет" OWNER TO postgres;

--
-- TOC entry 211 (class 1259 OID 16732)
-- Name: отчет_id_работника_fk_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public."отчет_id_работника_fk_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public."отчет_id_работника_fk_seq" OWNER TO postgres;

--
-- TOC entry 2892 (class 0 OID 0)
-- Dependencies: 211
-- Name: отчет_id_работника_fk_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public."отчет_id_работника_fk_seq" OWNED BY public."отчет"."id_работника_fk";


--
-- TOC entry 210 (class 1259 OID 16728)
-- Name: работник; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."работник" (
    "id_работника" integer NOT NULL,
    "паспортные_данные" integer NOT NULL,
    "зарплата" integer NOT NULL
);


ALTER TABLE public."работник" OWNER TO postgres;

--
-- TOC entry 209 (class 1259 OID 16726)
-- Name: работник_id_работника_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public."работник_id_работника_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public."работник_id_работника_seq" OWNER TO postgres;

--
-- TOC entry 2893 (class 0 OID 0)
-- Dependencies: 209
-- Name: работник_id_работника_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public."работник_id_работника_seq" OWNED BY public."работник"."id_работника";


--
-- TOC entry 205 (class 1259 OID 16705)
-- Name: цех; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."цех" (
    "номер_цеха" integer NOT NULL
);


ALTER TABLE public."цех" OWNER TO postgres;

--
-- TOC entry 2725 (class 2604 OID 16725)
-- Name: клетка id_клетки; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."клетка" ALTER COLUMN "id_клетки" SET DEFAULT nextval('public."клетка_id_клетки_seq"'::regclass);


--
-- TOC entry 2723 (class 2604 OID 16691)
-- Name: курица серийный_номер_курицы; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."курица" ALTER COLUMN "серийный_номер_курицы" SET DEFAULT nextval('public."курица_серийный_номер_курицы_seq"'::regclass);


--
-- TOC entry 2724 (class 2604 OID 16758)
-- Name: курица id_клетки_fk; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."курица" ALTER COLUMN "id_клетки_fk" SET DEFAULT nextval('public."курица_id_клетки_fk_seq"'::regclass);


--
-- TOC entry 2727 (class 2604 OID 16737)
-- Name: отчет id_работника_fk; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."отчет" ALTER COLUMN "id_работника_fk" SET DEFAULT nextval('public."отчет_id_работника_fk_seq"'::regclass);


--
-- TOC entry 2726 (class 2604 OID 16731)
-- Name: работник id_работника; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."работник" ALTER COLUMN "id_работника" SET DEFAULT nextval('public."работник_id_работника_seq"'::regclass);


--
-- TOC entry 2874 (class 0 OID 16697)
-- Dependencies: 204
-- Data for Name: Порода; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public."Порода" ("название_породы", "производительность", "средний_вес", "содержание_диеты") FROM stdin;
волв	23	12	гртвлы
товл	12	34	марыло
двдл	12	98	йцув
бьтьм	23	76	йцук
мпрт	34	76	ыамс
\.


--
-- TOC entry 2876 (class 0 OID 16714)
-- Dependencies: 206
-- Data for Name: директор; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public."директор" ("фио_директора") FROM stdin;
волв д. т.
товл р. м.
двдл з. г.
бьтьм т. д.
ыдлст д. т.
\.


--
-- TOC entry 2878 (class 0 OID 16722)
-- Dependencies: 208
-- Data for Name: клетка; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public."клетка" ("id_клетки", "ряд_клетки", "номер_клетки", "вместительность", "номер_цеха_fk") FROM stdin;
1	1	12	23	1
2	2	34	65	27
3	6	14	28	3
4	7	187	20	4
5	9	19	25	5
\.


--
-- TOC entry 2873 (class 0 OID 16688)
-- Dependencies: 203
-- Data for Name: курица; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public."курица" ("серийный_номер_курицы", "вес", "название_породы_fk", "возраст", "кол_во_яиц", "id_клетки_fk") FROM stdin;
1	5	волв	1	3	1
2	4	товл	2	3	2
3	3	двдл	3	7	3
4	2	бьтьм	6	5	4
5	1	мпрт	6	3	5
\.


--
-- TOC entry 2882 (class 0 OID 16734)
-- Dependencies: 212
-- Data for Name: отчет; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public."отчет" ("id_работника_fk", "количество_яиц", "количество_кур", "с_п_породы", "с_п_цеха", "производительность_птицефабрики") FROM stdin;
1	4	5	3	3	4
2	3	3	5	4	4
3	5	6	4	3	7
4	3	5	7	3	4
5	4	5	5	4	4
\.


--
-- TOC entry 2880 (class 0 OID 16728)
-- Dependencies: 210
-- Data for Name: работник; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public."работник" ("id_работника", "паспортные_данные", "зарплата") FROM stdin;
1	85464	87654
2	8233	2345
3	8546	87654
4	8233	2345
5	8718	76543
\.


--
-- TOC entry 2875 (class 0 OID 16705)
-- Dependencies: 205
-- Data for Name: цех; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public."цех" ("номер_цеха") FROM stdin;
1
27
3
4
5
\.


--
-- TOC entry 2894 (class 0 OID 0)
-- Dependencies: 207
-- Name: клетка_id_клетки_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."клетка_id_клетки_seq"', 1, false);


--
-- TOC entry 2895 (class 0 OID 0)
-- Dependencies: 213
-- Name: курица_id_клетки_fk_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."курица_id_клетки_fk_seq"', 1, false);


--
-- TOC entry 2896 (class 0 OID 0)
-- Dependencies: 202
-- Name: курица_серийный_номер_курицы_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."курица_серийный_номер_курицы_seq"', 1, false);


--
-- TOC entry 2897 (class 0 OID 0)
-- Dependencies: 211
-- Name: отчет_id_работника_fk_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."отчет_id_работника_fk_seq"', 1, false);


--
-- TOC entry 2898 (class 0 OID 0)
-- Dependencies: 209
-- Name: работник_id_работника_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."работник_id_работника_seq"', 1, false);


--
-- TOC entry 2739 (class 2606 OID 16768)
-- Name: клетка id_клетки; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."клетка"
    ADD CONSTRAINT "id_клетки" PRIMARY KEY ("id_клетки");


--
-- TOC entry 2741 (class 2606 OID 16744)
-- Name: работник id_работник; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."работник"
    ADD CONSTRAINT "id_работник" PRIMARY KEY ("id_работника");


--
-- TOC entry 2732 (class 2606 OID 16704)
-- Name: Порода название_породы; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Порода"
    ADD CONSTRAINT "название_породы" PRIMARY KEY ("название_породы");


--
-- TOC entry 2734 (class 2606 OID 16742)
-- Name: цех номер_цеха; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."цех"
    ADD CONSTRAINT "номер_цеха" PRIMARY KEY ("номер_цеха");


--
-- TOC entry 2730 (class 2606 OID 16696)
-- Name: курица серийный_номер_курицы; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."курица"
    ADD CONSTRAINT "серийный_номер_курицы" PRIMARY KEY ("серийный_номер_курицы");


--
-- TOC entry 2736 (class 2606 OID 16776)
-- Name: директор фио_директора; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."директор"
    ADD CONSTRAINT "фио_директора" PRIMARY KEY ("фио_директора");


--
-- TOC entry 2728 (class 1259 OID 16713)
-- Name: fki_название_породы_fk; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fki_название_породы_fk" ON public."курица" USING btree ("название_породы_fk");


--
-- TOC entry 2737 (class 1259 OID 16774)
-- Name: fki_номер_цеха_fk; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fki_номер_цеха_fk" ON public."клетка" USING btree ("номер_цеха_fk");


--
-- TOC entry 2742 (class 1259 OID 16750)
-- Name: fki_фио_работника_fk; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fki_фио_работника_fk" ON public."отчет" USING btree ("id_работника_fk");


--
-- TOC entry 2745 (class 2606 OID 16751)
-- Name: отчет id_работника_fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."отчет"
    ADD CONSTRAINT "id_работника_fk" FOREIGN KEY ("id_работника_fk") REFERENCES public."работник"("id_работника") NOT VALID;


--
-- TOC entry 2743 (class 2606 OID 16708)
-- Name: курица название_породы_fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."курица"
    ADD CONSTRAINT "название_породы_fk" FOREIGN KEY ("название_породы_fk") REFERENCES public."Порода"("название_породы") NOT VALID;


--
-- TOC entry 2744 (class 2606 OID 16769)
-- Name: клетка номер_цеха_fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."клетка"
    ADD CONSTRAINT "номер_цеха_fk" FOREIGN KEY ("номер_цеха_fk") REFERENCES public."цех"("номер_цеха") NOT VALID;


-- Completed on 2020-04-21 17:53:55

--
-- PostgreSQL database dump complete
--

