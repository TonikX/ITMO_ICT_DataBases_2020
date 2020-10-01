--
-- PostgreSQL database dump
--

-- Dumped from database version 12.2
-- Dumped by pg_dump version 12.2

-- Started on 2020-05-26 00:10:16

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
-- TOC entry 205 (class 1259 OID 16418)
-- Name: Breed; Type: TABLE; Schema: public; Owner: postgres
-- таблица для хранения пород собак

CREATE TABLE public."Breed" (
    id_breed integer NOT NULL,
    name_breed text NOT NULL
);


ALTER TABLE public."Breed" OWNER TO postgres;




--
-- TOC entry 213 (class 1259 OID 16522)
-- Name: Breed_ring; Type: TABLE; Schema: public; Owner: postgres
-- таблица для хранения пород, выступающих на ринге

CREATE TABLE public."Breed_ring" (
    id_breed integer NOT NULL,
    id_ring integer NOT NULL
);


ALTER TABLE public."Breed_ring" OWNER TO postgres;

--
-- TOC entry 204 (class 1259 OID 16410)
-- Name: Club; Type: TABLE; Schema: public; Owner: postgres
-- таблица для хранения собачьих клубов

CREATE TABLE public."Club" (
    id_club integer NOT NULL,
    name_club text NOT NULL
);


ALTER TABLE public."Club" OWNER TO postgres;



--
-- TOC entry 202 (class 1259 OID 16394)
-- Name: Document; Type: TABLE; Schema: public; Owner: postgres
-- таблица для хранения информации о родословных

CREATE TABLE public."Document" (
    id_document integer NOT NULL,
    name_parent1 text NOT NULL,
    name_parent2 text NOT NULL
);


ALTER TABLE public."Document" OWNER TO postgres;




--
-- TOC entry 210 (class 1259 OID 16476)
-- Name: Dog; Type: TABLE; Schema: public; Owner: postgres
-- таблица для хранения о собаках

CREATE TABLE public."Dog" (
    id_dog integer NOT NULL,
    name_dog text NOT NULL,
    age_dog integer NOT NULL,
    class_dog text NOT NULL,
    breed_dog integer NOT NULL,
    club_dog integer NOT NULL,
    document_dog integer NOT NULL,
    owner_dog integer NOT NULL,
    last_vac_date date NOT NULL
);


ALTER TABLE public."Dog" OWNER TO postgres;

--
-- TOC entry 211 (class 1259 OID 16504)
-- Name: Dog_reg; Type: TABLE; Schema: public; Owner: postgres
-- таблица для хранения информации о собаках-участницах выставок

CREATE TABLE public."Dog_reg" (
    id_dog_reg integer NOT NULL,
    exhibition_dog_reg integer NOT NULL,
    dog_dog_reg integer NOT NULL,
    med_status boolean NOT NULL
);


ALTER TABLE public."Dog_reg" OWNER TO postgres;



--
-- TOC entry 215 (class 1259 OID 16528)
-- Name: Evaluation; Type: TABLE; Schema: public; Owner: postgres
-- таблица для хранения оценок за упражнения

CREATE TABLE public."Evaluation" (
    judge_evaluation integer,
    dog_reg_evaluation integer,
    number_evaluation integer,
    points integer
);


ALTER TABLE public."Evaluation" OWNER TO postgres;

--
-- TOC entry 208 (class 1259 OID 16455)
-- Name: Exhibition; Type: TABLE; Schema: public; Owner: postgres
-- таблица для хранения выставок

CREATE TABLE public."Exhibition" (
    id_exhibition integer NOT NULL,
    name_exhibition text NOT NULL,
    date_exhibition date NOT NULL,
    info_exhibition text
);


ALTER TABLE public."Exhibition" OWNER TO postgres;


--
-- TOC entry 209 (class 1259 OID 16463)
-- Name: Exhibition_sponsor; Type: TABLE; Schema: public; Owner: postgres
-- таблица для хранения связей спонсоров и выставок

CREATE TABLE public."Exhibition_sponsor" (
    id_exhibition integer NOT NULL,
    id_sponsor integer NOT NULL
);


ALTER TABLE public."Exhibition_sponsor" OWNER TO postgres;

--
-- TOC entry 207 (class 1259 OID 16442)
-- Name: Judge; Type: TABLE; Schema: public; Owner: postgres
-- таблица для хранения судей

CREATE TABLE public."Judge" (
    id_judge integer NOT NULL,
    name_judge text NOT NULL,
    id_club integer
);


ALTER TABLE public."Judge" OWNER TO postgres;

--
-- TOC entry 203 (class 1259 OID 16402)
-- Name: Owner; Type: TABLE; Schema: public; Owner: postgres
-- таблица для хранения влядельцев собак

CREATE TABLE public."Owner" (
    id_owner integer NOT NULL,
    name_owner text NOT NULL
);


ALTER TABLE public."Owner" OWNER TO postgres;



--
-- TOC entry 212 (class 1259 OID 16519)
-- Name: Ring; Type: TABLE; Schema: public; Owner: postgres
-- таблица для хранения рингов

CREATE TABLE public."Ring" (
    id_ring integer NOT NULL,
    number_ring integer NOT NULL,
    exhibition_ring integer NOT NULL
);


ALTER TABLE public."Ring" OWNER TO postgres;

--
-- TOC entry 214 (class 1259 OID 16525)
-- Name: Ring_judge; Type: TABLE; Schema: public; Owner: postgres
-- таблица для хранения судей, работающих на ринге

CREATE TABLE public."Ring_judge" (
    id_ring integer,
    id_judge integer
);


ALTER TABLE public."Ring_judge" OWNER TO postgres;

--
-- TOC entry 206 (class 1259 OID 16426)
-- Name: Sponsor; Type: TABLE; Schema: public; Owner: postgres
-- таблица для хранения спонсоров

CREATE TABLE public."Sponsor" (
    id_sponsor integer NOT NULL,
    name_sponsor text NOT NULL,
    description_sponsor text
);


ALTER TABLE public."Sponsor" OWNER TO postgres;



--
-- TOC entry 2910 (class 0 OID 16418)
-- Dependencies: 205
-- Data for Name: Breed; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public."Breed" (id_breed, name_breed) FROM stdin;
1	Овчарка
2	Мопс
3	Пудель
4	Маленький пушистый шар
5	Кот
\.


--
-- TOC entry 2918 (class 0 OID 16522)
-- Dependencies: 213
-- Data for Name: Breed_ring; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public."Breed_ring" (id_breed, id_ring) FROM stdin;
1	1
2	1
3	2
4	5
1	6
2	7
3	3
4	4
1	2
2	4
3	6
\.


--
-- TOC entry 2909 (class 0 OID 16410)
-- Dependencies: 204
-- Data for Name: Club; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public."Club" (id_club, name_club) FROM stdin;
1	Победа
2	CLUB RICH
3	Face to face
4	DAED
5	МАМА спаси
\.


--
-- TOC entry 2907 (class 0 OID 16394)
-- Dependencies: 202
-- Data for Name: Document; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public."Document" (id_document, name_parent1, name_parent2) FROM stdin;
101010	Мама1	Рекс
202010	Мама2	Рекс
300000	Мама3	Рекс
412122	Мама4	Рекс
566666	Фикс	Флекс
\.


--
-- TOC entry 2915 (class 0 OID 16476)
-- Dependencies: 210
-- Data for Name: Dog; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public."Dog" (id_dog, name_dog, age_dog, class_dog, breed_dog, club_dog, document_dog, owner_dog, last_vac_date) FROM stdin;
1	Жучка	2	intermediate	1	1	101010	40401222	2010-10-10
2	Штучка	2	intermediate	2	2	202010	40401223	2010-09-10
3	Очпочмак	3	intermediate	3	3	300000	40401113	2010-11-10
4	Имя	3	intermediate	4	4	412122	40445632	2010-10-11
5	Собачье имя	3	intermediate	5	4	566666	40122322	2011-10-10
\.


--
-- TOC entry 2916 (class 0 OID 16504)
-- Dependencies: 211
-- Data for Name: Dog_reg; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public."Dog_reg" (id_dog_reg, exhibition_dog_reg, dog_dog_reg, med_status) FROM stdin;
1	1	1	t
2	1	2	t
3	2	1	t
4	3	3	t
5	4	4	t
6	5	5	t
\.


--
-- TOC entry 2920 (class 0 OID 16528)
-- Dependencies: 215
-- Data for Name: Evaluation; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public."Evaluation" (judge_evaluation, dog_reg_evaluation, number_evaluation, points) FROM stdin;
1	1	3	10
2	2	2	8
3	3	3	5
4	4	1	10
5	5	3	9
\.


--
-- TOC entry 2913 (class 0 OID 16455)
-- Dependencies: 208
-- Data for Name: Exhibition; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public."Exhibition" (id_exhibition, name_exhibition, date_exhibition, info_exhibition) FROM stdin;
1	sobbbaki 2020	2020-01-20	Зачем? никто не знает
2	sobbbaki 2019	2019-01-19	Зачем? никто не знает
3	best dog	2010-10-10	Зачем? Затем.
4	Лучшая кошка	2006-06-06	кошки лучше.
5	Последняя выставка	1019-12-31	\N
\.


--
-- TOC entry 2914 (class 0 OID 16463)
-- Dependencies: 209
-- Data for Name: Exhibition_sponsor; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public."Exhibition_sponsor" (id_exhibition, id_sponsor) FROM stdin;
1	1
2	1
3	2
4	3
4	4
5	5
\.


--
-- TOC entry 2912 (class 0 OID 16442)
-- Dependencies: 207
-- Data for Name: Judge; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public."Judge" (id_judge, name_judge, id_club) FROM stdin;
1	Володя	2
2	Инга	3
3	Ольга	4
4	Анна	5
5	Мария	2
\.


--
-- TOC entry 2908 (class 0 OID 16402)
-- Dependencies: 203
-- Data for Name: Owner; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public."Owner" (id_owner, name_owner) FROM stdin;
40401222	Ванесс Ванессов
40401223	Антон Говорухин
40401113	Kostya Моряк
40445632	Random Man
40122322	Иван Иванов
\.


--
-- TOC entry 2917 (class 0 OID 16519)
-- Dependencies: 212
-- Data for Name: Ring; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public."Ring" (id_ring, number_ring, exhibition_ring) FROM stdin;
1	1	1
2	1	2
3	2	2
4	1	3
5	1	4
6	2	5
7	1	5
\.


--
-- TOC entry 2919 (class 0 OID 16525)
-- Dependencies: 214
-- Data for Name: Ring_judge; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public."Ring_judge" (id_ring, id_judge) FROM stdin;
1	1
2	3
3	2
4	4
5	5
\.


--
-- TOC entry 2911 (class 0 OID 16426)
-- Dependencies: 206
-- Data for Name: Sponsor; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public."Sponsor" (id_sponsor, name_sponsor, description_sponsor) FROM stdin;
1	РосАтом	атомный флот, онли на ядерном топливе
2	Мясокомбинат	\N
3	Pedegreeee	\N
4	EEEEEEEEe corp.	EEEEEEEEEEEEEEEEEEEEEEEeeeeeeeeeeeEEEEEEEEEEEeeeeeeeeeeE
5	End of the day club	I mean evening
\.


--
-- TOC entry 2752 (class 2606 OID 16425)
-- Name: Breed Breed_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Breed"
    ADD CONSTRAINT "Breed_pkey" PRIMARY KEY (id_breed);


--
-- TOC entry 2750 (class 2606 OID 16417)
-- Name: Club Club_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Club"
    ADD CONSTRAINT "Club_pkey" PRIMARY KEY (id_club);


--
-- TOC entry 2760 (class 2606 OID 16483)
-- Name: Dog Dog_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Dog"
    ADD CONSTRAINT "Dog_pkey" PRIMARY KEY (id_dog);


--
-- TOC entry 2762 (class 2606 OID 16508)
-- Name: Dog_reg Dog_reg_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Dog_reg"
    ADD CONSTRAINT "Dog_reg_pkey" PRIMARY KEY (id_dog_reg);


--
-- TOC entry 2758 (class 2606 OID 16462)
-- Name: Exhibition Exhibition_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Exhibition"
    ADD CONSTRAINT "Exhibition_pkey" PRIMARY KEY (id_exhibition);


--
-- TOC entry 2756 (class 2606 OID 16449)
-- Name: Judge Judge_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Judge"
    ADD CONSTRAINT "Judge_pkey" PRIMARY KEY (id_judge);


--
-- TOC entry 2748 (class 2606 OID 16409)
-- Name: Owner Owner_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Owner"
    ADD CONSTRAINT "Owner_pkey" PRIMARY KEY (id_owner);


--
-- TOC entry 2764 (class 2606 OID 16532)
-- Name: Ring Ring_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Ring"
    ADD CONSTRAINT "Ring_pkey" PRIMARY KEY (id_ring);


--
-- TOC entry 2754 (class 2606 OID 16433)
-- Name: Sponsor Sponsor_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Sponsor"
    ADD CONSTRAINT "Sponsor_pkey" PRIMARY KEY (id_sponsor);


--
-- TOC entry 2746 (class 2606 OID 16401)
-- Name: Document document_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Document"
    ADD CONSTRAINT document_pkey PRIMARY KEY (id_document);


--
-- TOC entry 2775 (class 2606 OID 16548)
-- Name: Breed_ring Breed_ring_id_breed_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Breed_ring"
    ADD CONSTRAINT "Breed_ring_id_breed_fkey" FOREIGN KEY (id_breed) REFERENCES public."Breed"(id_breed) NOT VALID;


--
-- TOC entry 2776 (class 2606 OID 16553)
-- Name: Breed_ring Breed_ring_id_ring_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Breed_ring"
    ADD CONSTRAINT "Breed_ring_id_ring_fkey" FOREIGN KEY (id_ring) REFERENCES public."Ring"(id_ring) NOT VALID;


--
-- TOC entry 2765 (class 2606 OID 16450)
-- Name: Judge Club_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Judge"
    ADD CONSTRAINT "Club_fkey" FOREIGN KEY (id_club) REFERENCES public."Club"(id_club) NOT VALID;


--
-- TOC entry 2768 (class 2606 OID 16484)
-- Name: Dog Dog_breed_dog_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Dog"
    ADD CONSTRAINT "Dog_breed_dog_fkey" FOREIGN KEY (breed_dog) REFERENCES public."Breed"(id_breed);


--
-- TOC entry 2769 (class 2606 OID 16489)
-- Name: Dog Dog_club_dog_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Dog"
    ADD CONSTRAINT "Dog_club_dog_fkey" FOREIGN KEY (club_dog) REFERENCES public."Club"(id_club);


--
-- TOC entry 2770 (class 2606 OID 16494)
-- Name: Dog Dog_document_dog_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Dog"
    ADD CONSTRAINT "Dog_document_dog_fkey" FOREIGN KEY (document_dog) REFERENCES public."Document"(id_document);


--
-- TOC entry 2771 (class 2606 OID 16499)
-- Name: Dog Dog_owner_dog_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Dog"
    ADD CONSTRAINT "Dog_owner_dog_fkey" FOREIGN KEY (owner_dog) REFERENCES public."Owner"(id_owner);


--
-- TOC entry 2772 (class 2606 OID 16509)
-- Name: Dog_reg Dog_reg_dog_dog_reg_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Dog_reg"
    ADD CONSTRAINT "Dog_reg_dog_dog_reg_fkey" FOREIGN KEY (dog_dog_reg) REFERENCES public."Dog"(id_dog);


--
-- TOC entry 2773 (class 2606 OID 16514)
-- Name: Dog_reg Dog_reg_exhibition_dog_reg_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Dog_reg"
    ADD CONSTRAINT "Dog_reg_exhibition_dog_reg_fkey" FOREIGN KEY (exhibition_dog_reg) REFERENCES public."Exhibition"(id_exhibition);


--
-- TOC entry 2780 (class 2606 OID 16563)
-- Name: Evaluation Evaluation_dog_reg_evaluation_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Evaluation"
    ADD CONSTRAINT "Evaluation_dog_reg_evaluation_fkey" FOREIGN KEY (dog_reg_evaluation) REFERENCES public."Dog_reg"(id_dog_reg) NOT VALID;


--
-- TOC entry 2779 (class 2606 OID 16558)
-- Name: Evaluation Evaluation_judge_evaluation_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Evaluation"
    ADD CONSTRAINT "Evaluation_judge_evaluation_fkey" FOREIGN KEY (judge_evaluation) REFERENCES public."Judge"(id_judge) NOT VALID;


--
-- TOC entry 2766 (class 2606 OID 16466)
-- Name: Exhibition_sponsor Exhibition_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Exhibition_sponsor"
    ADD CONSTRAINT "Exhibition_fkey" FOREIGN KEY (id_exhibition) REFERENCES public."Exhibition"(id_exhibition);


--
-- TOC entry 2774 (class 2606 OID 16533)
-- Name: Ring Ring_exhibition_ring_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Ring"
    ADD CONSTRAINT "Ring_exhibition_ring_fkey" FOREIGN KEY (exhibition_ring) REFERENCES public."Exhibition"(id_exhibition) NOT VALID;


--
-- TOC entry 2778 (class 2606 OID 16543)
-- Name: Ring_judge Ring_judge_id_judge_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Ring_judge"
    ADD CONSTRAINT "Ring_judge_id_judge_fkey" FOREIGN KEY (id_judge) REFERENCES public."Judge"(id_judge) NOT VALID;


--
-- TOC entry 2777 (class 2606 OID 16538)
-- Name: Ring_judge Ring_judge_id_ring_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Ring_judge"
    ADD CONSTRAINT "Ring_judge_id_ring_fkey" FOREIGN KEY (id_ring) REFERENCES public."Ring"(id_ring) NOT VALID;


--
-- TOC entry 2767 (class 2606 OID 16471)
-- Name: Exhibition_sponsor Sponsor_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Exhibition_sponsor"
    ADD CONSTRAINT "Sponsor_fkey" FOREIGN KEY (id_sponsor) REFERENCES public."Sponsor"(id_sponsor);


-- Completed on 2020-05-26 00:10:17

--
-- PostgreSQL database dump complete
--

