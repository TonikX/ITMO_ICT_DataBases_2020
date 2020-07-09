--
-- PostgreSQL database dump
--

-- Dumped from database version 12.2
-- Dumped by pg_dump version 12.2

-- Started on 2020-06-07 18:18:33

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
-- TOC entry 212 (class 1259 OID 16515)
-- Name: Аэропорт; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."Аэропорт" (
    "ID_airport" integer NOT NULL,
    "Название" text,
    "Страна" text
);


ALTER TABLE public."Аэропорт" OWNER TO postgres;

--
-- TOC entry 213 (class 1259 OID 16553)
-- Name: Аэропорт_ID_airport_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public."Аэропорт" ALTER COLUMN "ID_airport" ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public."Аэропорт_ID_airport_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- TOC entry 210 (class 1259 OID 16508)
-- Name: Маршрут; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."Маршрут" (
    "ID_route" integer NOT NULL,
    "ID_airport_start" integer,
    "ID_airport_finish" integer,
    "Расстояние" integer
);


ALTER TABLE public."Маршрут" OWNER TO postgres;

--
-- TOC entry 211 (class 1259 OID 16511)
-- Name: Маршрут_ID_route_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public."Маршрут" ALTER COLUMN "ID_route" ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public."Маршрут_ID_route_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- TOC entry 209 (class 1259 OID 16493)
-- Name: Посадка; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."Посадка" (
    "ID_landing" integer NOT NULL,
    "ID_flight" integer NOT NULL,
    "ID_airport_landing" integer,
    "Время_посадки" timestamp with time zone,
    "Время_вылета_посадки" timestamp with time zone
);


ALTER TABLE public."Посадка" OWNER TO postgres;

--
-- TOC entry 214 (class 1259 OID 16556)
-- Name: Посадка_ID_landing_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public."Посадка" ALTER COLUMN "ID_landing" ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public."Посадка_ID_landing_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- TOC entry 207 (class 1259 OID 16464)
-- Name: Рейс; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."Рейс" (
    "ID_flight" integer NOT NULL,
    "ID_airplane" integer NOT NULL,
    "Количество_проданных_билетов" integer,
    "ID_route" integer,
    "Время_вылета" timestamp with time zone,
    "Время_прилёта" timestamp with time zone
);


ALTER TABLE public."Рейс" OWNER TO postgres;

--
-- TOC entry 208 (class 1259 OID 16491)
-- Name: Рейс_ID_flight_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public."Рейс" ALTER COLUMN "ID_flight" ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public."Рейс_ID_flight_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- TOC entry 202 (class 1259 OID 16394)
-- Name: Самолёт; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."Самолёт" (
    "ID_airplane" integer NOT NULL,
    "Тип_самолёта" text,
    "Число_мест" integer,
    "Скорость_полёта" integer,
    "Компания-авиаперевозчик" text
);


ALTER TABLE public."Самолёт" OWNER TO postgres;

--
-- TOC entry 205 (class 1259 OID 16460)
-- Name: Самолёт_ID_airplane_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public."Самолёт" ALTER COLUMN "ID_airplane" ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public."Самолёт_ID_airplane_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- TOC entry 203 (class 1259 OID 16421)
-- Name: Сотрудник; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."Сотрудник" (
    "ID_worker" integer NOT NULL,
    "ФИО" text,
    "Возраст" integer,
    "Авиакомпания" text,
    "Должность" text,
    "Образование" text,
    "Стаж_работы" interval,
    "Паспортные-данные" text
);


ALTER TABLE public."Сотрудник" OWNER TO postgres;

--
-- TOC entry 206 (class 1259 OID 16462)
-- Name: Сотрудники_ID_worker_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public."Сотрудник" ALTER COLUMN "ID_worker" ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public."Сотрудники_ID_worker_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- TOC entry 204 (class 1259 OID 16443)
-- Name: Экипаж; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."Экипаж" (
    "ID_flight" integer NOT NULL,
    "ID_worker" integer NOT NULL,
    "ID_staff" integer NOT NULL
);


ALTER TABLE public."Экипаж" OWNER TO postgres;

--
-- TOC entry 215 (class 1259 OID 16558)
-- Name: Экипаж_ID_staff_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public."Экипаж" ALTER COLUMN "ID_staff" ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public."Экипаж_ID_staff_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- TOC entry 2746 (class 2606 OID 16522)
-- Name: Аэропорт Аэропорт_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Аэропорт"
    ADD CONSTRAINT "Аэропорт_pkey" PRIMARY KEY ("ID_airport");


--
-- TOC entry 2744 (class 2606 OID 16514)
-- Name: Маршрут Маршрут_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Маршрут"
    ADD CONSTRAINT "Маршрут_pkey" PRIMARY KEY ("ID_route");


--
-- TOC entry 2740 (class 2606 OID 16500)
-- Name: Посадка Посадка_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Посадка"
    ADD CONSTRAINT "Посадка_pkey" PRIMARY KEY ("ID_landing");


--
-- TOC entry 2737 (class 2606 OID 16471)
-- Name: Рейс Рейс_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Рейс"
    ADD CONSTRAINT "Рейс_pkey" PRIMARY KEY ("ID_flight");


--
-- TOC entry 2729 (class 2606 OID 16401)
-- Name: Самолёт Самолёт_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Самолёт"
    ADD CONSTRAINT "Самолёт_pkey" PRIMARY KEY ("ID_airplane");


--
-- TOC entry 2731 (class 2606 OID 16428)
-- Name: Сотрудник Сотрудник_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Сотрудник"
    ADD CONSTRAINT "Сотрудник_pkey" PRIMARY KEY ("ID_worker");


--
-- TOC entry 2733 (class 2606 OID 16565)
-- Name: Экипаж Экипаж_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Экипаж"
    ADD CONSTRAINT "Экипаж_pkey" PRIMARY KEY ("ID_staff");


--
-- TOC entry 2741 (class 1259 OID 16534)
-- Name: fki_Маршрут_ID_airport_finish_fkey; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fki_Маршрут_ID_airport_finish_fkey" ON public."Маршрут" USING btree ("ID_airport_finish");


--
-- TOC entry 2742 (class 1259 OID 16528)
-- Name: fki_Маршрут_ID_airport_start_fkey; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fki_Маршрут_ID_airport_start_fkey" ON public."Маршрут" USING btree ("ID_airport_start");


--
-- TOC entry 2738 (class 1259 OID 16540)
-- Name: fki_Посадка_ID_airport_landing_fkey; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fki_Посадка_ID_airport_landing_fkey" ON public."Посадка" USING btree ("ID_airport_landing");


--
-- TOC entry 2734 (class 1259 OID 16546)
-- Name: fki_Рейс_ID_airplane_fkey; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fki_Рейс_ID_airplane_fkey" ON public."Рейс" USING btree ("ID_airplane");


--
-- TOC entry 2735 (class 1259 OID 16552)
-- Name: fki_Рейс_ID_route_fkey; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fki_Рейс_ID_route_fkey" ON public."Рейс" USING btree ("ID_route");


--
-- TOC entry 2752 (class 2606 OID 16529)
-- Name: Маршрут Маршрут_ID_airport_finish_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Маршрут"
    ADD CONSTRAINT "Маршрут_ID_airport_finish_fkey" FOREIGN KEY ("ID_airport_finish") REFERENCES public."Аэропорт"("ID_airport");


--
-- TOC entry 2753 (class 2606 OID 16523)
-- Name: Маршрут Маршрут_ID_airport_start_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Маршрут"
    ADD CONSTRAINT "Маршрут_ID_airport_start_fkey" FOREIGN KEY ("ID_airport_start") REFERENCES public."Аэропорт"("ID_airport");


--
-- TOC entry 2751 (class 2606 OID 16535)
-- Name: Посадка Посадка_ID_airport_landing_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Посадка"
    ADD CONSTRAINT "Посадка_ID_airport_landing_fkey" FOREIGN KEY ("ID_airport_landing") REFERENCES public."Аэропорт"("ID_airport");


--
-- TOC entry 2750 (class 2606 OID 16501)
-- Name: Посадка Посадка_ID_flight_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Посадка"
    ADD CONSTRAINT "Посадка_ID_flight_fkey" FOREIGN KEY ("ID_landing") REFERENCES public."Рейс"("ID_flight");


--
-- TOC entry 2749 (class 2606 OID 16547)
-- Name: Рейс Рейс_ID_route_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Рейс"
    ADD CONSTRAINT "Рейс_ID_route_fkey" FOREIGN KEY ("ID_route") REFERENCES public."Маршрут"("ID_route");


--
-- TOC entry 2747 (class 2606 OID 16478)
-- Name: Экипаж Экипаж_ID_flight_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Экипаж"
    ADD CONSTRAINT "Экипаж_ID_flight_fkey" FOREIGN KEY ("ID_flight") REFERENCES public."Рейс"("ID_flight");


--
-- TOC entry 2748 (class 2606 OID 16483)
-- Name: Экипаж Экипаж_ID_worker_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Экипаж"
    ADD CONSTRAINT "Экипаж_ID_worker_fkey" FOREIGN KEY ("ID_worker") REFERENCES public."Сотрудник"("ID_worker");


-- Completed on 2020-06-07 18:18:33

--
-- PostgreSQL database dump complete
--

