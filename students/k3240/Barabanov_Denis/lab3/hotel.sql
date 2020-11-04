--
-- PostgreSQL database dump
--

-- Dumped from database version 11.9
-- Dumped by pg_dump version 11.9

-- Started on 2020-10-29 21:51:17

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
-- TOC entry 1 (class 3079 OID 16384)
-- Name: adminpack; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS adminpack WITH SCHEMA pg_catalog;


--
-- TOC entry 2885 (class 0 OID 0)
-- Dependencies: 1
-- Name: EXTENSION adminpack; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION adminpack IS 'administrative functions for PostgreSQL';


SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 203 (class 1259 OID 16607)
-- Name: administrator; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.administrator (
    admin_id integer NOT NULL,
    surname text,
    firstname text
);


ALTER TABLE public.administrator OWNER TO postgres;

--
-- TOC entry 202 (class 1259 OID 16605)
-- Name: administrator_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.administrator_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.administrator_id_seq OWNER TO postgres;

--
-- TOC entry 2886 (class 0 OID 0)
-- Dependencies: 202
-- Name: administrator_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.administrator_id_seq OWNED BY public.administrator.admin_id;


--
-- TOC entry 208 (class 1259 OID 16766)
-- Name: contract; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.contract (
    contract integer NOT NULL,
    room integer,
    passport integer,
    admin_id integer
);


ALTER TABLE public.contract OWNER TO postgres;

--
-- TOC entry 207 (class 1259 OID 16764)
-- Name: contract_contract_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.contract_contract_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.contract_contract_seq OWNER TO postgres;

--
-- TOC entry 2887 (class 0 OID 0)
-- Dependencies: 207
-- Name: contract_contract_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.contract_contract_seq OWNED BY public.contract.contract;


--
-- TOC entry 206 (class 1259 OID 16637)
-- Name: customer; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.customer (
    passport integer NOT NULL,
    name character varying(30),
    surname character varying(30),
    city text,
    arrival daterange
);


ALTER TABLE public.customer OWNER TO postgres;

--
-- TOC entry 199 (class 1259 OID 16576)
-- Name: room; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.room (
    room integer NOT NULL,
    phone character varying(12),
    floor integer,
    roomtype integer
);


ALTER TABLE public.room OWNER TO postgres;

--
-- TOC entry 198 (class 1259 OID 16566)
-- Name: roomtype; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.roomtype (
    id integer NOT NULL,
    price integer,
    copacity text
);


ALTER TABLE public.roomtype OWNER TO postgres;

--
-- TOC entry 197 (class 1259 OID 16564)
-- Name: roomtype_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.roomtype_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.roomtype_id_seq OWNER TO postgres;

--
-- TOC entry 2888 (class 0 OID 0)
-- Dependencies: 197
-- Name: roomtype_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.roomtype_id_seq OWNED BY public.roomtype.id;


--
-- TOC entry 205 (class 1259 OID 16618)
-- Name: timetable; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.timetable (
    id integer NOT NULL,
    day text,
    worker integer,
    floor integer
);


ALTER TABLE public.timetable OWNER TO postgres;

--
-- TOC entry 204 (class 1259 OID 16616)
-- Name: timetable_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.timetable_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.timetable_id_seq OWNER TO postgres;

--
-- TOC entry 2889 (class 0 OID 0)
-- Dependencies: 204
-- Name: timetable_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.timetable_id_seq OWNED BY public.timetable.id;


--
-- TOC entry 201 (class 1259 OID 16596)
-- Name: workers; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.workers (
    id integer NOT NULL,
    surname text,
    firstname text
);


ALTER TABLE public.workers OWNER TO postgres;

--
-- TOC entry 200 (class 1259 OID 16594)
-- Name: workers_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.workers_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.workers_id_seq OWNER TO postgres;

--
-- TOC entry 2890 (class 0 OID 0)
-- Dependencies: 200
-- Name: workers_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.workers_id_seq OWNED BY public.workers.id;


--
-- TOC entry 2725 (class 2604 OID 16610)
-- Name: administrator admin_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.administrator ALTER COLUMN admin_id SET DEFAULT nextval('public.administrator_id_seq'::regclass);


--
-- TOC entry 2727 (class 2604 OID 16769)
-- Name: contract contract; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.contract ALTER COLUMN contract SET DEFAULT nextval('public.contract_contract_seq'::regclass);


--
-- TOC entry 2723 (class 2604 OID 16569)
-- Name: roomtype id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.roomtype ALTER COLUMN id SET DEFAULT nextval('public.roomtype_id_seq'::regclass);


--
-- TOC entry 2726 (class 2604 OID 16621)
-- Name: timetable id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.timetable ALTER COLUMN id SET DEFAULT nextval('public.timetable_id_seq'::regclass);


--
-- TOC entry 2724 (class 2604 OID 16599)
-- Name: workers id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.workers ALTER COLUMN id SET DEFAULT nextval('public.workers_id_seq'::regclass);


--
-- TOC entry 2874 (class 0 OID 16607)
-- Dependencies: 203
-- Data for Name: administrator; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.administrator (admin_id, surname, firstname) FROM stdin;
1	Кругликов	Чингиз
2	Иканов	Эрнест
3	Зёмин	Овидий
\.


--
-- TOC entry 2879 (class 0 OID 16766)
-- Dependencies: 208
-- Data for Name: contract; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.contract (contract, room, passport, admin_id) FROM stdin;
1	123	123321412	1
2	222	535737537	1
3	322	543357573	2
4	101	546544454	2
5	102	156465654	3
6	333	753734523	3
7	235	934352344	3
\.


--
-- TOC entry 2877 (class 0 OID 16637)
-- Dependencies: 206
-- Data for Name: customer; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.customer (passport, name, surname, city, arrival) FROM stdin;
123321412	Баранов	Натан	Spb	[2020-11-12,2020-11-13)
546544454	Молчанов 	Ильяс	Spb	[2020-08-09,2020-09-09)
156465654	Тихомиров  	Серафим	Spb	[2020-09-10,2020-10-22)
753734523	Хромов   	Амадеус	Moscow	[2020-07-22,2020-08-17)
934352344	Богатырёв   	Максимилиан	Vladivostok	[2020-10-31,2020-11-14)
535737537	Новокшонов 	Лаврентий	Moscow	[2020-10-16,2020-10-22)
543357573	Филимонов 	Марк	Kaluga	[2020-08-09,2020-09-09)
\.


--
-- TOC entry 2870 (class 0 OID 16576)
-- Dependencies: 199
-- Data for Name: room; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.room (room, phone, floor, roomtype) FROM stdin;
123	+79112281488	1	1
222	+71234567899	2	2
322	+73214567899	3	3
101	+79119409919	1	2
102	+79115123961	1	3
212	+79111883815	2	1
225	+79110060787	2	3
235	+79116625788	2	2
333	+79110511871	3	1
335	+79113120012	3	3
336	+79111918788	3	2
\.


--
-- TOC entry 2869 (class 0 OID 16566)
-- Dependencies: 198
-- Data for Name: roomtype; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.roomtype (id, price, copacity) FROM stdin;
1	2000	одноместная
2	4000	двуместная
3	6000	трехместная
\.


--
-- TOC entry 2876 (class 0 OID 16618)
-- Dependencies: 205
-- Data for Name: timetable; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.timetable (id, day, worker, floor) FROM stdin;
1	понедельник	1	1
2	понедельник	2	2
3	понедельник	3	3
4	четверг	3	1
5	четверг	2	1
6	четверг	1	1
7	вторник	3	2
8	вторник	4	3
9	среда	5	1
10	пятница	6	2
11	суббота	7	3
\.


--
-- TOC entry 2872 (class 0 OID 16596)
-- Dependencies: 201
-- Data for Name: workers; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.workers (id, surname, firstname) FROM stdin;
1	пупкин	вася
2	иванов	ваня
3	федоров	федор
4	Грибов 	Тимофей
5	Есипов  	Ленар
6	Элефтеров  	Карен
7	Лачинов  	Станислав
\.


--
-- TOC entry 2891 (class 0 OID 0)
-- Dependencies: 202
-- Name: administrator_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.administrator_id_seq', 3, true);


--
-- TOC entry 2892 (class 0 OID 0)
-- Dependencies: 207
-- Name: contract_contract_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.contract_contract_seq', 7, true);


--
-- TOC entry 2893 (class 0 OID 0)
-- Dependencies: 197
-- Name: roomtype_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.roomtype_id_seq', 3, true);


--
-- TOC entry 2894 (class 0 OID 0)
-- Dependencies: 204
-- Name: timetable_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.timetable_id_seq', 11, true);


--
-- TOC entry 2895 (class 0 OID 0)
-- Dependencies: 200
-- Name: workers_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.workers_id_seq', 7, true);


--
-- TOC entry 2735 (class 2606 OID 16615)
-- Name: administrator administrator_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.administrator
    ADD CONSTRAINT administrator_pkey PRIMARY KEY (admin_id);


--
-- TOC entry 2741 (class 2606 OID 16771)
-- Name: contract contract_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.contract
    ADD CONSTRAINT contract_pkey PRIMARY KEY (contract);


--
-- TOC entry 2739 (class 2606 OID 16644)
-- Name: customer customer_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.customer
    ADD CONSTRAINT customer_pkey PRIMARY KEY (passport);


--
-- TOC entry 2731 (class 2606 OID 16580)
-- Name: room room_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.room
    ADD CONSTRAINT room_pkey PRIMARY KEY (room);


--
-- TOC entry 2729 (class 2606 OID 16574)
-- Name: roomtype roomtype_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.roomtype
    ADD CONSTRAINT roomtype_pkey PRIMARY KEY (id);


--
-- TOC entry 2737 (class 2606 OID 16626)
-- Name: timetable timetable_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.timetable
    ADD CONSTRAINT timetable_pkey PRIMARY KEY (id);


--
-- TOC entry 2733 (class 2606 OID 16604)
-- Name: workers workers_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.workers
    ADD CONSTRAINT workers_pkey PRIMARY KEY (id);


--
-- TOC entry 2746 (class 2606 OID 16782)
-- Name: contract contract_admin_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.contract
    ADD CONSTRAINT contract_admin_id_fkey FOREIGN KEY (admin_id) REFERENCES public.administrator(admin_id);


--
-- TOC entry 2745 (class 2606 OID 16777)
-- Name: contract contract_passport_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.contract
    ADD CONSTRAINT contract_passport_fkey FOREIGN KEY (passport) REFERENCES public.customer(passport);


--
-- TOC entry 2744 (class 2606 OID 16772)
-- Name: contract contract_room_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.contract
    ADD CONSTRAINT contract_room_fkey FOREIGN KEY (room) REFERENCES public.room(room);


--
-- TOC entry 2742 (class 2606 OID 16581)
-- Name: room room_roomtype_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.room
    ADD CONSTRAINT room_roomtype_fkey FOREIGN KEY (roomtype) REFERENCES public.roomtype(id);


--
-- TOC entry 2743 (class 2606 OID 16632)
-- Name: timetable timetable_worker_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.timetable
    ADD CONSTRAINT timetable_worker_fkey FOREIGN KEY (worker) REFERENCES public.workers(id);


-- Completed on 2020-10-29 21:51:17

--
-- PostgreSQL database dump complete
--

