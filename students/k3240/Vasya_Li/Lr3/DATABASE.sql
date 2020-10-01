--
-- PostgreSQL database dump
--

-- Dumped from database version 11.7
-- Dumped by pg_dump version 11.7

-- Started on 2020-04-28 23:22:58

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

SET default_with_oids = false;

--
-- TOC entry 204 (class 1259 OID 33071)
-- Name: advertisingservice; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.advertisingservice (
    id integer NOT NULL,
    name character varying(50),
    price double precision NOT NULL
);


ALTER TABLE public.advertisingservice OWNER TO postgres;

--
-- TOC entry 202 (class 1259 OID 33060)
-- Name: contract; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.contract (
    "№_contract" integer NOT NULL,
    "№_order" integer NOT NULL,
    phonecustomer character varying(12) NOT NULL,
    "№_request" integer NOT NULL
);


ALTER TABLE public.contract OWNER TO postgres;

--
-- TOC entry 205 (class 1259 OID 33078)
-- Name: customer; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.customer (
    phone character varying(12) NOT NULL,
    name character varying(50) NOT NULL,
    mail character varying(60) NOT NULL
);


ALTER TABLE public.customer OWNER TO postgres;

--
-- TOC entry 203 (class 1259 OID 33068)
-- Name: employees; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.employees (
    "№_employees" integer NOT NULL,
    name character varying(50) NOT NULL
);


ALTER TABLE public.employees OWNER TO postgres;

--
-- TOC entry 200 (class 1259 OID 33052)
-- Name: executor; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.executor (
    id integer NOT NULL,
    name_executor character varying(30) NOT NULL,
    phone character varying(12) NOT NULL,
    mail character varying(50) NOT NULL
);


ALTER TABLE public.executor OWNER TO postgres;

--
-- TOC entry 198 (class 1259 OID 33017)
-- Name: materials; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.materials (
    "№_material" integer NOT NULL,
    price double precision NOT NULL,
    namematerial character varying(50) NOT NULL
);


ALTER TABLE public.materials OWNER TO postgres;

--
-- TOC entry 197 (class 1259 OID 33007)
-- Name: orderlist; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.orderlist (
    "№_order" integer NOT NULL,
    "№_work" integer NOT NULL
);


ALTER TABLE public.orderlist OWNER TO postgres;

--
-- TOC entry 208 (class 1259 OID 33197)
-- Name: paymentorder; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.paymentorder (
    phonecustomer character varying(12) NOT NULL,
    "№_score" integer NOT NULL,
    "№_employee" integer NOT NULL,
    "№_payment" integer NOT NULL,
    datecreate date DEFAULT CURRENT_TIMESTAMP,
    state boolean NOT NULL
);


ALTER TABLE public.paymentorder OWNER TO postgres;

--
-- TOC entry 206 (class 1259 OID 33098)
-- Name: request; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.request (
    phone character varying(12) NOT NULL,
    "№_request" integer NOT NULL,
    id_advertising integer NOT NULL,
    id_employee integer NOT NULL,
    price double precision NOT NULL
);


ALTER TABLE public.request OWNER TO postgres;

--
-- TOC entry 207 (class 1259 OID 33182)
-- Name: score; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.score (
    "№_score" integer NOT NULL,
    "№_request" integer NOT NULL,
    "№_contract" integer NOT NULL,
    amountofmoney double precision NOT NULL
);


ALTER TABLE public.score OWNER TO postgres;

--
-- TOC entry 199 (class 1259 OID 33037)
-- Name: set; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.set (
    "№_materials" integer NOT NULL,
    "№_set" integer NOT NULL,
    "№_order" integer NOT NULL,
    count integer NOT NULL,
    price double precision NOT NULL
);


ALTER TABLE public.set OWNER TO postgres;

--
-- TOC entry 201 (class 1259 OID 33057)
-- Name: teamexecutor; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.teamexecutor (
    id integer NOT NULL,
    "№_contract" integer NOT NULL
);


ALTER TABLE public.teamexecutor OWNER TO postgres;

--
-- TOC entry 196 (class 1259 OID 32999)
-- Name: work; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.work (
    "№_work" integer NOT NULL,
    sell double precision
);


ALTER TABLE public.work OWNER TO postgres;

--
-- TOC entry 2899 (class 0 OID 33071)
-- Dependencies: 204
-- Data for Name: advertisingservice; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.advertisingservice (id, name, price) FROM stdin;
1	реклама номер 1	23478
2	реклама номер 2	23234
3	реклама номер 3	43468
4	реклама номер 4	65797
5	реклама номер 5	65334
\.


--
-- TOC entry 2897 (class 0 OID 33060)
-- Dependencies: 202
-- Data for Name: contract; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.contract ("№_contract", "№_order", phonecustomer, "№_request") FROM stdin;
1	1	+72342889374	1
2	2	+72342889324	2
3	3	+72342889394	3
4	4	+72312884374	4
5	5	+72342389374	5
\.


--
-- TOC entry 2900 (class 0 OID 33078)
-- Dependencies: 205
-- Data for Name: customer; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.customer (phone, name, mail) FROM stdin;
+72342889374	Дмитрий Ульянов Игоревич	Dima@mail.com
+72342889324	Василий Ульянов Игоревич	Some@mail.com
+72342889394	Гриша Ульянов Игоревич	hz@mail.com
+72312884374	Денис Петров Игоревич	MA@mail.com
+72342389374	Инорь Кокорин Игоревич	BIBA@mail.com
\.


--
-- TOC entry 2898 (class 0 OID 33068)
-- Dependencies: 203
-- Data for Name: employees; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.employees ("№_employees", name) FROM stdin;
1	Маня
2	Гоша
3	Леша
4	Игнат
5	Дмитрий
\.


--
-- TOC entry 2895 (class 0 OID 33052)
-- Dependencies: 200
-- Data for Name: executor; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.executor (id, name_executor, phone, mail) FROM stdin;
1	Вова	+78347387293	vova@mail.ru
2	Рома	+78347387293	Roma@mail.ru
3	Данил	+78347237293	Danka@mail.ru
4	Андрей	+78390387293	Andr@mail.ru
5	Аганес	+78312387293	Agan@mail.ru
\.


--
-- TOC entry 2893 (class 0 OID 33017)
-- Dependencies: 198
-- Data for Name: materials; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.materials ("№_material", price, namematerial) FROM stdin;
1	40	Дерево
2	30	Ткань
3	100	Метал
4	20	Бумага
5	80	Кожа
\.


--
-- TOC entry 2892 (class 0 OID 33007)
-- Dependencies: 197
-- Data for Name: orderlist; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.orderlist ("№_order", "№_work") FROM stdin;
1	2
2	3
3	4
4	5
5	1
\.


--
-- TOC entry 2903 (class 0 OID 33197)
-- Dependencies: 208
-- Data for Name: paymentorder; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.paymentorder (phonecustomer, "№_score", "№_employee", "№_payment", datecreate, state) FROM stdin;
+72342889374	1	1	1	2020-04-28	f
+72342889324	2	2	2	2020-04-28	f
+72342889394	3	3	3	2020-04-28	f
+72312884374	4	4	4	2020-04-28	f
+72342389374	5	5	5	2020-04-28	f
\.


--
-- TOC entry 2901 (class 0 OID 33098)
-- Dependencies: 206
-- Data for Name: request; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.request (phone, "№_request", id_advertising, id_employee, price) FROM stdin;
+72342889374	1	1	1	123433
+72342889324	2	2	2	23432
+72342889394	3	3	3	2343
+72312884374	4	4	4	54332
+72342389374	5	5	5	54532
\.


--
-- TOC entry 2902 (class 0 OID 33182)
-- Dependencies: 207
-- Data for Name: score; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.score ("№_score", "№_request", "№_contract", amountofmoney) FROM stdin;
1	1	1	234432
2	2	2	23245
3	3	3	23232
4	4	4	23543
5	5	5	23343
\.


--
-- TOC entry 2894 (class 0 OID 33037)
-- Dependencies: 199
-- Data for Name: set; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.set ("№_materials", "№_set", "№_order", count, price) FROM stdin;
1	1	1	10	10
3	2	2	5	10
4	3	4	2	8
5	4	3	30	90
2	5	5	23	115
\.


--
-- TOC entry 2896 (class 0 OID 33057)
-- Dependencies: 201
-- Data for Name: teamexecutor; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.teamexecutor (id, "№_contract") FROM stdin;
1	1
2	2
3	3
4	4
5	5
\.


--
-- TOC entry 2891 (class 0 OID 32999)
-- Dependencies: 196
-- Data for Name: work; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.work ("№_work", sell) FROM stdin;
1	231244
2	233304
3	230344
4	696244
5	261924
\.


--
-- TOC entry 2748 (class 2606 OID 33075)
-- Name: advertisingservice advertisingservice_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.advertisingservice
    ADD CONSTRAINT advertisingservice_pkey PRIMARY KEY (id);


--
-- TOC entry 2744 (class 2606 OID 33181)
-- Name: contract contract_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.contract
    ADD CONSTRAINT contract_pkey PRIMARY KEY ("№_contract");


--
-- TOC entry 2750 (class 2606 OID 33082)
-- Name: customer customer_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.customer
    ADD CONSTRAINT customer_pkey PRIMARY KEY (phone);


--
-- TOC entry 2746 (class 2606 OID 33077)
-- Name: employees employees_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.employees
    ADD CONSTRAINT employees_pkey PRIMARY KEY ("№_employees");


--
-- TOC entry 2742 (class 2606 OID 33056)
-- Name: executor executor_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.executor
    ADD CONSTRAINT executor_pkey PRIMARY KEY (id);


--
-- TOC entry 2738 (class 2606 OID 33021)
-- Name: materials materials_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.materials
    ADD CONSTRAINT materials_pkey PRIMARY KEY ("№_material");


--
-- TOC entry 2736 (class 2606 OID 33011)
-- Name: orderlist orderlist_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.orderlist
    ADD CONSTRAINT orderlist_pkey PRIMARY KEY ("№_order");


--
-- TOC entry 2752 (class 2606 OID 33102)
-- Name: request request_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.request
    ADD CONSTRAINT request_pkey PRIMARY KEY ("№_request");


--
-- TOC entry 2754 (class 2606 OID 33186)
-- Name: score score_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.score
    ADD CONSTRAINT score_pkey PRIMARY KEY ("№_score");


--
-- TOC entry 2740 (class 2606 OID 33041)
-- Name: set set_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.set
    ADD CONSTRAINT set_pkey PRIMARY KEY ("№_set");


--
-- TOC entry 2734 (class 2606 OID 33006)
-- Name: work work_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.work
    ADD CONSTRAINT work_pkey PRIMARY KEY ("№_work");


--
-- TOC entry 2760 (class 2606 OID 33286)
-- Name: contract contract_phonecustomer_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.contract
    ADD CONSTRAINT contract_phonecustomer_fkey FOREIGN KEY (phonecustomer) REFERENCES public.customer(phone);


--
-- TOC entry 2759 (class 2606 OID 33063)
-- Name: contract contract_№_order_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.contract
    ADD CONSTRAINT "contract_№_order_fkey" FOREIGN KEY ("№_order") REFERENCES public.orderlist("№_order");


--
-- TOC entry 2761 (class 2606 OID 33291)
-- Name: contract contract_№_request_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.contract
    ADD CONSTRAINT "contract_№_request_fkey" FOREIGN KEY ("№_request") REFERENCES public.request("№_request");


--
-- TOC entry 2755 (class 2606 OID 33012)
-- Name: orderlist orderlist_№_work_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.orderlist
    ADD CONSTRAINT "orderlist_№_work_fkey" FOREIGN KEY ("№_work") REFERENCES public.work("№_work");


--
-- TOC entry 2767 (class 2606 OID 33201)
-- Name: paymentorder paymentorder_phonecustomer_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.paymentorder
    ADD CONSTRAINT paymentorder_phonecustomer_fkey FOREIGN KEY (phonecustomer) REFERENCES public.customer(phone);


--
-- TOC entry 2769 (class 2606 OID 33211)
-- Name: paymentorder paymentorder_№_employee_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.paymentorder
    ADD CONSTRAINT "paymentorder_№_employee_fkey" FOREIGN KEY ("№_employee") REFERENCES public.employees("№_employees");


--
-- TOC entry 2768 (class 2606 OID 33206)
-- Name: paymentorder paymentorder_№_score_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.paymentorder
    ADD CONSTRAINT "paymentorder_№_score_fkey" FOREIGN KEY ("№_score") REFERENCES public.score("№_score");


--
-- TOC entry 2763 (class 2606 OID 33108)
-- Name: request request_id_advertising_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.request
    ADD CONSTRAINT request_id_advertising_fkey FOREIGN KEY (id_advertising) REFERENCES public.advertisingservice(id);


--
-- TOC entry 2764 (class 2606 OID 33113)
-- Name: request request_id_employee_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.request
    ADD CONSTRAINT request_id_employee_fkey FOREIGN KEY (id_employee) REFERENCES public.employees("№_employees");


--
-- TOC entry 2762 (class 2606 OID 33103)
-- Name: request request_phone_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.request
    ADD CONSTRAINT request_phone_fkey FOREIGN KEY (phone) REFERENCES public.customer(phone);


--
-- TOC entry 2766 (class 2606 OID 33192)
-- Name: score score_№_contract_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.score
    ADD CONSTRAINT "score_№_contract_fkey" FOREIGN KEY ("№_contract") REFERENCES public.contract("№_contract");


--
-- TOC entry 2765 (class 2606 OID 33187)
-- Name: score score_№_request_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.score
    ADD CONSTRAINT "score_№_request_fkey" FOREIGN KEY ("№_request") REFERENCES public.request("№_request");


--
-- TOC entry 2756 (class 2606 OID 33042)
-- Name: set set_№_materials_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.set
    ADD CONSTRAINT "set_№_materials_fkey" FOREIGN KEY ("№_materials") REFERENCES public.materials("№_material");


--
-- TOC entry 2757 (class 2606 OID 33047)
-- Name: set set_№_order_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.set
    ADD CONSTRAINT "set_№_order_fkey" FOREIGN KEY ("№_order") REFERENCES public.orderlist("№_order");


--
-- TOC entry 2758 (class 2606 OID 33301)
-- Name: teamexecutor teamexecutor_№_contract_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.teamexecutor
    ADD CONSTRAINT "teamexecutor_№_contract_fkey" FOREIGN KEY ("№_contract") REFERENCES public.contract("№_contract");


-- Completed on 2020-04-28 23:22:58

--
-- PostgreSQL database dump complete
--

