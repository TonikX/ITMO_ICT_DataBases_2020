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

SET default_table_access_method = heap;


-- Таблица экземпляров книг
CREATE TABLE public."Book_instances" (
    id integer NOT NULL,
    status text NOT NULL,
    id_book integer NOT NULL
);

CREATE SEQUENCE public."Book_instances_id_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

ALTER SEQUENCE public."Book_instances_id_seq" OWNED BY public."Book_instances".id;


-- Таблица кинг
CREATE TABLE public."Books" (
    id integer NOT NULL,
    author text NOT NULL,
    name text NOT NULL,
    year_of_pub date NOT NULL,
    section text NOT NULL,
    pressmark text NOT NULL,
    debit_date text
);

-- Установка инкремента
CREATE SEQUENCE public."Books_id_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public."Books_id_seq" OWNED BY public."Books".id;


-- Таблица выдачи экземпляра
CREATE TABLE public."Instance_issues" (
    date_of_issue date NOT NULL,
    return_date date,
    id_reader integer NOT NULL,
    id_instance integer NOT NULL
);

-- Таблица экземпляров в читальных залах
CREATE TABLE public."Instances_in_room" (
    id_rooms integer NOT NULL,
    id_instance integer NOT NULL,
    value integer NOT NULL
);

-- Таблица читателей
CREATE TABLE public."Readers" (
    id integer NOT NULL,
    number_of_card integer NOT NULL,
    full_name text NOT NULL,
    passport_number integer NOT NULL,
    data_of_birthday date NOT NULL,
    address text NOT NULL,
    call_number integer NOT NULL,
    graduation text NOT NULL,
    graduate_degree boolean NOT NULL
);

-- Установка инкремента для читатейлей
CREATE SEQUENCE public."Readers_id_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

ALTER SEQUENCE public."Readers_id_seq" OWNED BY public."Readers".id;

CREATE TABLE public."Reading_rooms" (
    id integer NOT NULL,
    number integer NOT NULL,
    name text NOT NULL,
    people_capacity integer NOT NULL
);

-- Установка инкремента для номеров читальных залов
CREATE SEQUENCE public."Reading_rooms_id_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public."Reading_rooms_id_seq" OWNED BY public."Reading_rooms".id;

-- Таблица регистрации
CREATE TABLE public."Registers" (
    id_room integer NOT NULL,
    id_reader integer NOT NULL,
    date_recorded date NOT NULL,
    date_of_re_registration date,
    discharge_date date
);

ALTER TABLE ONLY public."Book_instances" ALTER COLUMN id SET DEFAULT nextval('public."Book_instances_id_seq"'::regclass);

ALTER TABLE ONLY public."Books" ALTER COLUMN id SET DEFAULT nextval('public."Books_id_seq"'::regclass);

ALTER TABLE ONLY public."Readers" ALTER COLUMN id SET DEFAULT nextval('public."Readers_id_seq"'::regclass);

ALTER TABLE ONLY public."Reading_rooms" ALTER COLUMN id SET DEFAULT nextval('public."Reading_rooms_id_seq"'::regclass);


SELECT pg_catalog.setval('public."Book_instances_id_seq"', 1, false);

SELECT pg_catalog.setval('public."Books_id_seq"', 1, true);

SELECT pg_catalog.setval('public."Readers_id_seq"', 1, false);

SELECT pg_catalog.setval('public."Reading_rooms_id_seq"', 1, false);

ALTER TABLE ONLY public."Book_instances"
    ADD CONSTRAINT "Book_instances_pkey" PRIMARY KEY (id);

-- Установка первичных ключей
ALTER TABLE ONLY public."Books"
    ADD CONSTRAINT "Books_pkey" PRIMARY KEY (id);

ALTER TABLE ONLY public."Readers"
    ADD CONSTRAINT "Readers_pkey" PRIMARY KEY (id);

ALTER TABLE ONLY public."Reading_rooms"
    ADD CONSTRAINT "Reading_rooms_pkey" PRIMARY KEY (id);
	
	
-- Установка FK
CREATE INDEX "id_books(FK)" ON public."Book_instances" USING btree (id_book);

CREATE INDEX "id_instance(fk)" ON public."Instance_issues" USING btree (id_instance);

CREATE INDEX "id_instance_in_rooms(fk)" ON public."Instances_in_room" USING btree (id_instance);

CREATE INDEX "id_reader(fk)" ON public."Instance_issues" USING btree (id_reader);

CREATE INDEX "id_reader_in_register(fk)" ON public."Registers" USING btree (id_reader);

CREATE INDEX "id_room(fk)" ON public."Registers" USING btree (id_room);

CREATE INDEX "id_rooms(fk)" ON public."Instances_in_room" USING btree (id_rooms);

ALTER TABLE ONLY public."Book_instances"
    ADD CONSTRAINT "Book_instances_id_book_fkey" FOREIGN KEY (id_book) REFERENCES public."Books"(id) NOT VALID;

ALTER TABLE ONLY public."Instance_issues"
    ADD CONSTRAINT "Instance_issues_id_instance_fkey" FOREIGN KEY (id_instance) REFERENCES public."Book_instances"(id) NOT VALID;

ALTER TABLE ONLY public."Instance_issues"
    ADD CONSTRAINT "Instance_issues_id_reader_fkey" FOREIGN KEY (id_reader) REFERENCES public."Readers"(id) NOT VALID;

ALTER TABLE ONLY public."Instances_in_room"
    ADD CONSTRAINT "Instances_in_room_id_instance_fkey" FOREIGN KEY (id_instance) REFERENCES public."Book_instances"(id) NOT VALID;


ALTER TABLE ONLY public."Instances_in_room"
    ADD CONSTRAINT "Instances_in_room_id_instance_fkey1" FOREIGN KEY (id_instance) REFERENCES public."Book_instances"(id) NOT VALID;

ALTER TABLE ONLY public."Instances_in_room"
    ADD CONSTRAINT "Instances_in_room_id_rooms_fkey" FOREIGN KEY (id_rooms) REFERENCES public."Reading_rooms"(id) NOT VALID;

ALTER TABLE ONLY public."Registers"
    ADD CONSTRAINT "Registers_id_reader_fkey" FOREIGN KEY (id_reader) REFERENCES public."Readers"(id) NOT VALID;

ALTER TABLE ONLY public."Registers"
    ADD CONSTRAINT "Registers_id_reader_fkey1" FOREIGN KEY (id_reader) REFERENCES public."Readers"(id) NOT VALID;

ALTER TABLE ONLY public."Registers"
    ADD CONSTRAINT "Registers_id_room_fkey" FOREIGN KEY (id_room) REFERENCES public."Reading_rooms"(id) NOT VALID;

