--
-- PostgreSQL database dump
--

-- Dumped from database version 11.9
-- Dumped by pg_dump version 11.9

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
-- Name: Школа; Type: SCHEMA; Schema: -; Owner: postgres
--

CREATE SCHEMA "Школа";


ALTER SCHEMA "Школа" OWNER TO postgres;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: Время; Type: TABLE; Schema: Школа; Owner: postgres
--

CREATE TABLE "Школа"."Время" (
    id smallint NOT NULL,
    "День_недели" character(2) NOT NULL,
    "Номер_урока" smallint NOT NULL
);


ALTER TABLE "Школа"."Время" OWNER TO postgres;

--
-- Name: TABLE "Время"; Type: COMMENT; Schema: Школа; Owner: postgres
--

COMMENT ON TABLE "Школа"."Время" IS 'Содержит время в формате День_недели + Номер_урока';


--
-- Name: Кабинет; Type: TABLE; Schema: Школа; Owner: postgres
--

CREATE TABLE "Школа"."Кабинет" (
    "Номер" smallint NOT NULL,
    "Профильный" boolean NOT NULL
);


ALTER TABLE "Школа"."Кабинет" OWNER TO postgres;

--
-- Name: TABLE "Кабинет"; Type: COMMENT; Schema: Школа; Owner: postgres
--

COMMENT ON TABLE "Школа"."Кабинет" IS 'Содержит номер кабинета и то, является ли он профильным';


--
-- Name: Класс; Type: TABLE; Schema: Школа; Owner: postgres
--

CREATE TABLE "Школа"."Класс" (
    "Код" character varying(10) NOT NULL,
    "Классный_руководитель" smallint NOT NULL
);


ALTER TABLE "Школа"."Класс" OWNER TO postgres;

--
-- Name: TABLE "Класс"; Type: COMMENT; Schema: Школа; Owner: postgres
--

COMMENT ON TABLE "Школа"."Класс" IS 'Содержит код класса и информацию о классном руководителе';


--
-- Name: Оценка; Type: TABLE; Schema: Школа; Owner: postgres
--

CREATE TABLE "Школа"."Оценка" (
    "Ученик" smallint NOT NULL,
    "Предмет" character varying NOT NULL,
    "Оценка" smallint NOT NULL
);


ALTER TABLE "Школа"."Оценка" OWNER TO postgres;

--
-- Name: TABLE "Оценка"; Type: COMMENT; Schema: Школа; Owner: postgres
--

COMMENT ON TABLE "Школа"."Оценка" IS 'Содержит оценку для пары значений ученик-предмет';


--
-- Name: Предмет; Type: TABLE; Schema: Школа; Owner: postgres
--

CREATE TABLE "Школа"."Предмет" (
    "Наименование" character varying NOT NULL
);


ALTER TABLE "Школа"."Предмет" OWNER TO postgres;

--
-- Name: TABLE "Предмет"; Type: COMMENT; Schema: Школа; Owner: postgres
--

COMMENT ON TABLE "Школа"."Предмет" IS 'Содержит наименование предмета';


--
-- Name: Расписание; Type: TABLE; Schema: Школа; Owner: postgres
--

CREATE TABLE "Школа"."Расписание" (
    "Класс" character varying(10) NOT NULL,
    "Учитель" smallint NOT NULL,
    "Предмет" character varying NOT NULL,
    "Кабинет" smallint NOT NULL,
    "Время" smallint NOT NULL
);


ALTER TABLE "Школа"."Расписание" OWNER TO postgres;

--
-- Name: TABLE "Расписание"; Type: COMMENT; Schema: Школа; Owner: postgres
--

COMMENT ON TABLE "Школа"."Расписание" IS 'Содержит информацию об уроке: в какое время, в каком кабинете, какой учитель, какому классу, что преподаёт';


--
-- Name: Ученик; Type: TABLE; Schema: Школа; Owner: postgres
--

CREATE TABLE "Школа"."Ученик" (
    id smallint NOT NULL,
    "ФИО" character varying NOT NULL,
    "Пол" character(3) NOT NULL,
    "Класс" character varying(10) NOT NULL
);


ALTER TABLE "Школа"."Ученик" OWNER TO postgres;

--
-- Name: TABLE "Ученик"; Type: COMMENT; Schema: Школа; Owner: postgres
--

COMMENT ON TABLE "Школа"."Ученик" IS 'Содержит ФИО и пол ученика, а также в каком классе он числится';


--
-- Name: Учитель; Type: TABLE; Schema: Школа; Owner: postgres
--

CREATE TABLE "Школа"."Учитель" (
    id smallint NOT NULL,
    "ФИО" character varying NOT NULL,
    "Кабинет" smallint
);


ALTER TABLE "Школа"."Учитель" OWNER TO postgres;

--
-- Name: TABLE "Учитель"; Type: COMMENT; Schema: Школа; Owner: postgres
--

COMMENT ON TABLE "Школа"."Учитель" IS 'Содержит ФИО учителя и номер закреплённого за ним кабинета, если таковой имеется';


--
-- Data for Name: Время; Type: TABLE DATA; Schema: Школа; Owner: postgres
--

COPY "Школа"."Время" (id, "День_недели", "Номер_урока") FROM stdin;
1	Пн	1
2	Пн	2
3	Пн	3
4	Пн	4
5	Пн	5
\.


--
-- Data for Name: Кабинет; Type: TABLE DATA; Schema: Школа; Owner: postgres
--

COPY "Школа"."Кабинет" ("Номер", "Профильный") FROM stdin;
1	t
2	f
3	f
4	t
5	t
\.


--
-- Data for Name: Класс; Type: TABLE DATA; Schema: Школа; Owner: postgres
--

COPY "Школа"."Класс" ("Код", "Классный_руководитель") FROM stdin;
8 "А"	5
9 "А"	7
10 "А"	6
10 "Б"	8
11 "Б"	4
\.


--
-- Data for Name: Оценка; Type: TABLE DATA; Schema: Школа; Owner: postgres
--

COPY "Школа"."Оценка" ("Ученик", "Предмет", "Оценка") FROM stdin;
2	Русский язык	5
2	Литература	5
2	Математика	4
2	Информатика	4
2	Физика	3
7	Русский язык	3
7	Литература	2
7	Математика	4
7	Информатика	5
7	Физика	5
\.


--
-- Data for Name: Предмет; Type: TABLE DATA; Schema: Школа; Owner: postgres
--

COPY "Школа"."Предмет" ("Наименование") FROM stdin;
Математика
Русский язык
Физика
Литература
Информатика
\.


--
-- Data for Name: Расписание; Type: TABLE DATA; Schema: Школа; Owner: postgres
--

COPY "Школа"."Расписание" ("Класс", "Учитель", "Предмет", "Кабинет", "Время") FROM stdin;
10 "А"	8	Информатика	5	1
10 "А"	8	Информатика	5	2
10 "А"	3	Литература	3	3
10 "А"	6	Математика	1	4
10 "А"	6	Математика	4	5
\.


--
-- Data for Name: Ученик; Type: TABLE DATA; Schema: Школа; Owner: postgres
--

COPY "Школа"."Ученик" (id, "ФИО", "Пол", "Класс") FROM stdin;
1	Фуранов Егор Дмитриевич	Муж	8 "А"
2	Милс Тамара Юрьевна	Жен	8 "А"
3	Сокол Антон Никитич	Муж	9 "А"
4	Сперо Александр Ильич	Муж	9 "А"
5	Мелькова Элла Марковна	Жен	10 "А"
6	Снеткова Екатерина Григорьевна	Жен	10 "А"
7	Бессмертный Артём Александрович	Муж	10 "Б"
8	Сокол Ирина Никитична	Жен	11 "Б"
\.


--
-- Data for Name: Учитель; Type: TABLE DATA; Schema: Школа; Owner: postgres
--

COPY "Школа"."Учитель" (id, "ФИО", "Кабинет") FROM stdin;
1	Иванова Мария Ивановна	2
2	Петрова Вера Алексеевна	1
3	Тутова Надежда Олеговна	3
4	Тамова Любовь Сеергеевна	4
6	Ветрова Элиза Камильевна	\N
7	Энов Илья Васильевич	\N
5	Сямова Анна Владимировна	\N
8	Клац Марк Юльевич	5
\.


--
-- Name: Время Время_pkey; Type: CONSTRAINT; Schema: Школа; Owner: postgres
--

ALTER TABLE ONLY "Школа"."Время"
    ADD CONSTRAINT "Время_pkey" PRIMARY KEY (id);


--
-- Name: Класс Класс_pkey; Type: CONSTRAINT; Schema: Школа; Owner: postgres
--

ALTER TABLE ONLY "Школа"."Класс"
    ADD CONSTRAINT "Класс_pkey" PRIMARY KEY ("Код");


--
-- Name: Класс Класс_Классный_руководитель_key; Type: CONSTRAINT; Schema: Школа; Owner: postgres
--

ALTER TABLE ONLY "Школа"."Класс"
    ADD CONSTRAINT "Класс_Классный_руководитель_key" UNIQUE ("Классный_руководитель");


--
-- Name: Кабинет Номер кабинета; Type: CONSTRAINT; Schema: Школа; Owner: postgres
--

ALTER TABLE ONLY "Школа"."Кабинет"
    ADD CONSTRAINT "Номер кабинета" PRIMARY KEY ("Номер");


--
-- Name: Оценка Оценка_pkey; Type: CONSTRAINT; Schema: Школа; Owner: postgres
--

ALTER TABLE ONLY "Школа"."Оценка"
    ADD CONSTRAINT "Оценка_pkey" PRIMARY KEY ("Ученик", "Предмет");


--
-- Name: Предмет Предмет_pkey; Type: CONSTRAINT; Schema: Школа; Owner: postgres
--

ALTER TABLE ONLY "Школа"."Предмет"
    ADD CONSTRAINT "Предмет_pkey" PRIMARY KEY ("Наименование");


--
-- Name: Расписание Расписание_pkey; Type: CONSTRAINT; Schema: Школа; Owner: postgres
--

ALTER TABLE ONLY "Школа"."Расписание"
    ADD CONSTRAINT "Расписание_pkey" PRIMARY KEY ("Класс", "Учитель", "Предмет", "Кабинет", "Время");


--
-- Name: Ученик Ученик_pkey; Type: CONSTRAINT; Schema: Школа; Owner: postgres
--

ALTER TABLE ONLY "Школа"."Ученик"
    ADD CONSTRAINT "Ученик_pkey" PRIMARY KEY (id);


--
-- Name: Учитель Учитель_pkey; Type: CONSTRAINT; Schema: Школа; Owner: postgres
--

ALTER TABLE ONLY "Школа"."Учитель"
    ADD CONSTRAINT "Учитель_pkey" PRIMARY KEY (id);


--
-- Name: Учитель Учитель_Кабинет_key; Type: CONSTRAINT; Schema: Школа; Owner: postgres
--

ALTER TABLE ONLY "Школа"."Учитель"
    ADD CONSTRAINT "Учитель_Кабинет_key" UNIQUE ("Кабинет");


--
-- Name: Класс Класс_Классный_руководитель_fkey; Type: FK CONSTRAINT; Schema: Школа; Owner: postgres
--

ALTER TABLE ONLY "Школа"."Класс"
    ADD CONSTRAINT "Класс_Классный_руководитель_fkey" FOREIGN KEY ("Классный_руководитель") REFERENCES "Школа"."Учитель"(id);


--
-- Name: Оценка Оценка_Предмет_fkey; Type: FK CONSTRAINT; Schema: Школа; Owner: postgres
--

ALTER TABLE ONLY "Школа"."Оценка"
    ADD CONSTRAINT "Оценка_Предмет_fkey" FOREIGN KEY ("Предмет") REFERENCES "Школа"."Предмет"("Наименование");


--
-- Name: Оценка Оценка_Ученик_fkey; Type: FK CONSTRAINT; Schema: Школа; Owner: postgres
--

ALTER TABLE ONLY "Школа"."Оценка"
    ADD CONSTRAINT "Оценка_Ученик_fkey" FOREIGN KEY ("Ученик") REFERENCES "Школа"."Ученик"(id);


--
-- Name: Расписание Расписание_Время_fkey; Type: FK CONSTRAINT; Schema: Школа; Owner: postgres
--

ALTER TABLE ONLY "Школа"."Расписание"
    ADD CONSTRAINT "Расписание_Время_fkey" FOREIGN KEY ("Время") REFERENCES "Школа"."Время"(id) NOT VALID;


--
-- Name: Расписание Расписание_Кабинет_fkey; Type: FK CONSTRAINT; Schema: Школа; Owner: postgres
--

ALTER TABLE ONLY "Школа"."Расписание"
    ADD CONSTRAINT "Расписание_Кабинет_fkey" FOREIGN KEY ("Кабинет") REFERENCES "Школа"."Кабинет"("Номер") NOT VALID;


--
-- Name: Расписание Расписание_Класс_fkey; Type: FK CONSTRAINT; Schema: Школа; Owner: postgres
--

ALTER TABLE ONLY "Школа"."Расписание"
    ADD CONSTRAINT "Расписание_Класс_fkey" FOREIGN KEY ("Класс") REFERENCES "Школа"."Класс"("Код") NOT VALID;


--
-- Name: Расписание Расписание_Предмет_fkey; Type: FK CONSTRAINT; Schema: Школа; Owner: postgres
--

ALTER TABLE ONLY "Школа"."Расписание"
    ADD CONSTRAINT "Расписание_Предмет_fkey" FOREIGN KEY ("Предмет") REFERENCES "Школа"."Предмет"("Наименование") NOT VALID;


--
-- Name: Расписание Расписание_Учитель_fkey; Type: FK CONSTRAINT; Schema: Школа; Owner: postgres
--

ALTER TABLE ONLY "Школа"."Расписание"
    ADD CONSTRAINT "Расписание_Учитель_fkey" FOREIGN KEY ("Учитель") REFERENCES "Школа"."Учитель"(id) NOT VALID;


--
-- Name: Ученик Ученик_Класс_fkey; Type: FK CONSTRAINT; Schema: Школа; Owner: postgres
--

ALTER TABLE ONLY "Школа"."Ученик"
    ADD CONSTRAINT "Ученик_Класс_fkey" FOREIGN KEY ("Класс") REFERENCES "Школа"."Класс"("Код");


--
-- Name: Учитель Учитель_Кабинет_fkey; Type: FK CONSTRAINT; Schema: Школа; Owner: postgres
--

ALTER TABLE ONLY "Школа"."Учитель"
    ADD CONSTRAINT "Учитель_Кабинет_fkey" FOREIGN KEY ("Кабинет") REFERENCES "Школа"."Кабинет"("Номер") NOT VALID;


--
-- PostgreSQL database dump complete
--

