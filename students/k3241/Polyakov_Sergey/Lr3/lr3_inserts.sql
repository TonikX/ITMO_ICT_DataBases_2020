--
-- PostgreSQL database dump
--

-- Dumped from database version 12.2
-- Dumped by pg_dump version 12.2

-- Started on 2020-06-07 18:21:13

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
-- TOC entry 2890 (class 0 OID 16515)
-- Dependencies: 212
-- Data for Name: Аэропорт; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public."Аэропорт" OVERRIDING SYSTEM VALUE VALUES (1, 'Международный аэропорт Хартсфилд-Джексон Атланта', 'США');
INSERT INTO public."Аэропорт" OVERRIDING SYSTEM VALUE VALUES (2, 'Международный аэропорт Пекин Столичный', 'Китай');
INSERT INTO public."Аэропорт" OVERRIDING SYSTEM VALUE VALUES (3, 'Международный аэропорт Дубай', 'ОАЭ');
INSERT INTO public."Аэропорт" OVERRIDING SYSTEM VALUE VALUES (4, 'Лондонский аэропорт Хитроу', 'Великобритания');
INSERT INTO public."Аэропорт" OVERRIDING SYSTEM VALUE VALUES (5, 'Международный аэропорт Токио', 'Япония');


--
-- TOC entry 2888 (class 0 OID 16508)
-- Dependencies: 210
-- Data for Name: Маршрут; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public."Маршрут" OVERRIDING SYSTEM VALUE VALUES (1, 1, 2, 1234);
INSERT INTO public."Маршрут" OVERRIDING SYSTEM VALUE VALUES (2, 2, 3, 2134);
INSERT INTO public."Маршрут" OVERRIDING SYSTEM VALUE VALUES (3, 1, 4, 2542);
INSERT INTO public."Маршрут" OVERRIDING SYSTEM VALUE VALUES (4, 5, 4, 3245);
INSERT INTO public."Маршрут" OVERRIDING SYSTEM VALUE VALUES (5, 3, 5, 6785);


--
-- TOC entry 2885 (class 0 OID 16464)
-- Dependencies: 207
-- Data for Name: Рейс; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public."Рейс" OVERRIDING SYSTEM VALUE VALUES (1, 1, 76, 2, '2012-06-18 10:34:09+04', '2012-06-18 17:34:09+04');
INSERT INTO public."Рейс" OVERRIDING SYSTEM VALUE VALUES (2, 2, 35, 1, '2012-06-26 10:34:09+04', '2012-06-26 15:34:09+04');
INSERT INTO public."Рейс" OVERRIDING SYSTEM VALUE VALUES (3, 3, 67, 4, '2012-06-03 10:34:09+04', '2012-06-03 14:34:09+04');
INSERT INTO public."Рейс" OVERRIDING SYSTEM VALUE VALUES (4, 4, 34, 5, '2012-06-18 22:34:09+04', '2012-06-19 11:34:09+04');
INSERT INTO public."Рейс" OVERRIDING SYSTEM VALUE VALUES (5, 5, 80, 3, '2012-06-10 10:34:09+04', '2012-06-10 19:34:09+04');


--
-- TOC entry 2887 (class 0 OID 16493)
-- Dependencies: 209
-- Data for Name: Посадка; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public."Посадка" OVERRIDING SYSTEM VALUE VALUES (1, 1, 1, '2012-06-18 14:34:09+04', '2012-06-18 14:54:09+04');
INSERT INTO public."Посадка" OVERRIDING SYSTEM VALUE VALUES (2, 2, 3, '2012-06-26 12:34:09+04', '2012-06-26 12:54:09+04');
INSERT INTO public."Посадка" OVERRIDING SYSTEM VALUE VALUES (3, 2, 4, '2012-06-26 13:34:09+04', '2012-06-26 13:54:09+04');
INSERT INTO public."Посадка" OVERRIDING SYSTEM VALUE VALUES (4, 4, 4, '2012-06-19 06:34:09+04', '2012-06-19 06:54:09+04');
INSERT INTO public."Посадка" OVERRIDING SYSTEM VALUE VALUES (5, 5, 5, '2012-06-10 15:34:09+04', '2012-06-10 15:54:09+04');


--
-- TOC entry 2880 (class 0 OID 16394)
-- Dependencies: 202
-- Data for Name: Самолёт; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public."Самолёт" OVERRIDING SYSTEM VALUE VALUES (1, 'Boing 737MAX', 145, 999, 'AEROFLOT');
INSERT INTO public."Самолёт" OVERRIDING SYSTEM VALUE VALUES (2, 'Boing 737MAX', 140, 1000, 'S7 Airlines');
INSERT INTO public."Самолёт" OVERRIDING SYSTEM VALUE VALUES (3, 'Airbus A320neo', 120, 900, 'Победа');
INSERT INTO public."Самолёт" OVERRIDING SYSTEM VALUE VALUES (4, 'Иркут MC-21', 150, 870, 'AEROFLOT');
INSERT INTO public."Самолёт" OVERRIDING SYSTEM VALUE VALUES (5, 'Ту-134', 80, 950, 'Utair');


--
-- TOC entry 2881 (class 0 OID 16421)
-- Dependencies: 203
-- Data for Name: Сотрудник; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public."Сотрудник" OVERRIDING SYSTEM VALUE VALUES (1, 'Иванов Иван Иванович', 35, 'AEROFLOT', 'Капитан', 'Высшее', '11 years 1 mon', '1111 111111');
INSERT INTO public."Сотрудник" OVERRIDING SYSTEM VALUE VALUES (2, 'Иванов Пётр Иванович1', 27, 'AEROFLOT', 'Штурман', 'Высшее', '9 years 2 mons', '1010 101010');
INSERT INTO public."Сотрудник" OVERRIDING SYSTEM VALUE VALUES (3, 'Иванова Анна Ивановна', 25, 'AEROFLOT', 'Стюардесса', 'Высшее', '5 years 1 mon', '2222 222222');
INSERT INTO public."Сотрудник" OVERRIDING SYSTEM VALUE VALUES (4, 'Иванов Олег Иванович', 44, 'AEROFLOT', 'Второй пилот', 'Высшее', '23 years 5 mons', '3333 333333');
INSERT INTO public."Сотрудник" OVERRIDING SYSTEM VALUE VALUES (5, 'Петров Пётр Петрович', 32, 'S7 Airlines', 'Капитан', 'Высшее', '11 years 9 mons', '4444 444444');
INSERT INTO public."Сотрудник" OVERRIDING SYSTEM VALUE VALUES (7, 'Петрова Екатерина Петровна', 21, 'S7 Airlines', 'Стюардесса', 'Среднее общее', '1 year 9 mons', '5555 555555');
INSERT INTO public."Сотрудник" OVERRIDING SYSTEM VALUE VALUES (8, 'Петров Олег Петрович', 53, 'S7 Airlines', 'Второй пилот', 'Высшее', '32 years 3 mons', '6666 666666');
INSERT INTO public."Сотрудник" OVERRIDING SYSTEM VALUE VALUES (9, 'Олегов Олег Олегович', 43, 'Победа', 'Капитан', 'Высшее', '16 years 6 mons', '7777 777777');
INSERT INTO public."Сотрудник" OVERRIDING SYSTEM VALUE VALUES (11, 'Олегов Пётр Олегович', 24, 'Победа', 'Стюард', 'Высшее', '2 years 2 mons', '8888 888888');
INSERT INTO public."Сотрудник" OVERRIDING SYSTEM VALUE VALUES (12, 'Олегов Алексей Олегович', 35, 'Победа', 'Второй пилот', 'Высшее', '8 years 11 mons', '9999 999999');
INSERT INTO public."Сотрудник" OVERRIDING SYSTEM VALUE VALUES (6, 'Петров Иван Петрович', 25, 'S7 Airlines', 'Штурман', 'Высшее', '3 years 8 mons', '1212 121212');
INSERT INTO public."Сотрудник" OVERRIDING SYSTEM VALUE VALUES (10, 'Олегов Иван Олегович', 31, 'Победа', 'Штурман', 'Высшее', '9 years 7 mons', '1313 131313');


--
-- TOC entry 2882 (class 0 OID 16443)
-- Dependencies: 204
-- Data for Name: Экипаж; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public."Экипаж" OVERRIDING SYSTEM VALUE VALUES (1, 1, 1);
INSERT INTO public."Экипаж" OVERRIDING SYSTEM VALUE VALUES (1, 2, 2);
INSERT INTO public."Экипаж" OVERRIDING SYSTEM VALUE VALUES (1, 3, 3);
INSERT INTO public."Экипаж" OVERRIDING SYSTEM VALUE VALUES (1, 4, 4);
INSERT INTO public."Экипаж" OVERRIDING SYSTEM VALUE VALUES (2, 5, 5);
INSERT INTO public."Экипаж" OVERRIDING SYSTEM VALUE VALUES (2, 6, 6);
INSERT INTO public."Экипаж" OVERRIDING SYSTEM VALUE VALUES (2, 7, 7);
INSERT INTO public."Экипаж" OVERRIDING SYSTEM VALUE VALUES (2, 8, 8);
INSERT INTO public."Экипаж" OVERRIDING SYSTEM VALUE VALUES (3, 9, 9);
INSERT INTO public."Экипаж" OVERRIDING SYSTEM VALUE VALUES (3, 10, 10);
INSERT INTO public."Экипаж" OVERRIDING SYSTEM VALUE VALUES (3, 11, 11);
INSERT INTO public."Экипаж" OVERRIDING SYSTEM VALUE VALUES (3, 12, 12);
INSERT INTO public."Экипаж" OVERRIDING SYSTEM VALUE VALUES (4, 1, 13);
INSERT INTO public."Экипаж" OVERRIDING SYSTEM VALUE VALUES (4, 2, 14);
INSERT INTO public."Экипаж" OVERRIDING SYSTEM VALUE VALUES (4, 3, 15);
INSERT INTO public."Экипаж" OVERRIDING SYSTEM VALUE VALUES (4, 4, 16);
INSERT INTO public."Экипаж" OVERRIDING SYSTEM VALUE VALUES (5, 9, 17);
INSERT INTO public."Экипаж" OVERRIDING SYSTEM VALUE VALUES (5, 10, 18);
INSERT INTO public."Экипаж" OVERRIDING SYSTEM VALUE VALUES (5, 11, 19);
INSERT INTO public."Экипаж" OVERRIDING SYSTEM VALUE VALUES (5, 12, 20);


--
-- TOC entry 2899 (class 0 OID 0)
-- Dependencies: 213
-- Name: Аэропорт_ID_airport_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."Аэропорт_ID_airport_seq"', 5, true);


--
-- TOC entry 2900 (class 0 OID 0)
-- Dependencies: 211
-- Name: Маршрут_ID_route_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."Маршрут_ID_route_seq"', 5, true);


--
-- TOC entry 2901 (class 0 OID 0)
-- Dependencies: 214
-- Name: Посадка_ID_landing_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."Посадка_ID_landing_seq"', 5, true);


--
-- TOC entry 2902 (class 0 OID 0)
-- Dependencies: 208
-- Name: Рейс_ID_flight_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."Рейс_ID_flight_seq"', 5, true);


--
-- TOC entry 2903 (class 0 OID 0)
-- Dependencies: 205
-- Name: Самолёт_ID_airplane_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."Самолёт_ID_airplane_seq"', 5, true);


--
-- TOC entry 2904 (class 0 OID 0)
-- Dependencies: 206
-- Name: Сотрудники_ID_worker_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."Сотрудники_ID_worker_seq"', 12, true);


--
-- TOC entry 2905 (class 0 OID 0)
-- Dependencies: 215
-- Name: Экипаж_ID_staff_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."Экипаж_ID_staff_seq"', 20, true);


-- Completed on 2020-06-07 18:21:13

--
-- PostgreSQL database dump complete
--

