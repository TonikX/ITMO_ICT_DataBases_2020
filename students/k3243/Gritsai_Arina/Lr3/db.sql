-- Database: lr_3 - создаём базу данных
CREATE DATABASE lr_3
    WITH
    OWNER = postgres
    ENCODING = 'UTF8'
    LC_COLLATE = 'C'
    LC_CTYPE = 'C'
    TABLESPACE = pg_default
    CONNECTION LIMIT = -1;

GRANT ALL ON DATABASE lr_3 TO postgres;

GRANT TEMPORARY, CONNECT ON DATABASE lr_3 TO PUBLIC;

-- SCHEMA: public - создаём схему
CREATE SCHEMA public
    AUTHORIZATION postgres;

COMMENT ON SCHEMA public
    IS 'standard public schema';

GRANT ALL ON SCHEMA public TO PUBLIC;

GRANT ALL ON SCHEMA public TO postgres;

-- Table: public.client - создаём таблицу "Клиент"
CREATE TABLE public.client
(
    passport_id integer NOT NULL,
    name character varying(25) COLLATE pg_catalog."default" NOT NULL,
    surname character varying(30) COLLATE pg_catalog."default" NOT NULL,
    patronymic character varying(30) COLLATE pg_catalog."default" NOT NULL,
    city character varying(30) COLLATE pg_catalog."default" NOT NULL,
    CONSTRAINT "Client_pkey" PRIMARY KEY (passport_id)
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public.client
    OWNER to postgres;

GRANT ALL ON TABLE public.client TO postgres WITH GRANT OPTION;

-- Table: public.employees - создаём таблицу "Служащие"
CREATE TABLE public.employees
(
    personnel_num integer NOT NULL,
    wage integer NOT NULL,
    surname_emp character varying(25) COLLATE pg_catalog."default" NOT NULL,
    name_emp character varying(30) COLLATE pg_catalog."default" NOT NULL,
    patronymic_emp character varying(30) COLLATE pg_catalog."default" NOT NULL,
    CONSTRAINT employees_pkey PRIMARY KEY (personnel_num)
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public.employees
    OWNER to postgres;

GRANT ALL ON TABLE public.employees TO postgres WITH GRANT OPTION;

-- Table: public.floor - создаём таблицу "Этаж"
CREATE TABLE public.floor
(
    floor_id integer NOT NULL,
    floor_num integer NOT NULL,
    CONSTRAINT floor_pkey PRIMARY KEY (floor_id)
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public.floor
    OWNER to postgres;

GRANT ALL ON TABLE public.floor TO postgres WITH GRANT OPTION;

-- Table: public.room - создаем таблицу "Номер" с внешним ключом от таблицы "Этаж"
CREATE TABLE public.room
(
    serial_number integer NOT NULL,
    fki_floor_id integer NOT NULL,
    cost_per_day integer NOT NULL,
    telephone_num integer NOT NULL,
    type character varying(10) COLLATE pg_catalog."default" NOT NULL,
    CONSTRAINT room_pkey PRIMARY KEY (serial_number),
    CONSTRAINT floor_id FOREIGN KEY (fki_floor_id)
        REFERENCES public.floor (floor_id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public.room
    OWNER to postgres;

GRANT ALL ON TABLE public.room TO postgres WITH GRANT OPTION;
-- Index: fki_fk_floor_id
CREATE INDEX fki_fk_floor_id
    ON public.room USING btree
    (fki_floor_id ASC NULLS LAST)
    TABLESPACE pg_default;

-- Table: public.cleaning_schedule - создаем таблицу "Расписание уборки"с
-- внешними ключаси от таблиц "Этаж", "Служащие", "Номер"
CREATE TABLE public.cleaning_schedule
(
    cleaning_id integer NOT NULL,
    data date NOT NULL,
    week_day character varying(11) COLLATE pg_catalog."default" NOT NULL,
    fki_floor_id integer NOT NULL,
    fki_pers_num integer NOT NULL,
    fki_serial_num integer NOT NULL,
    CONSTRAINT cleaning_schedule_pkey PRIMARY KEY (cleaning_id),
    CONSTRAINT floor_id FOREIGN KEY (fki_floor_id)
        REFERENCES public.floor (floor_id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    CONSTRAINT pers_num FOREIGN KEY (fki_pers_num)
        REFERENCES public.employees (personnel_num) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    CONSTRAINT serial_num FOREIGN KEY (fki_serial_num)
        REFERENCES public.room (serial_number) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public.cleaning_schedule
    OWNER to postgres;

GRANT ALL ON TABLE public.cleaning_schedule TO postgres WITH GRANT OPTION;
-- Index: fki_floor_id
CREATE INDEX fki_floor_id
    ON public.cleaning_schedule USING btree
    (fki_floor_id ASC NULLS LAST)
    TABLESPACE pg_default;
-- Index: fki_pers_num
CREATE INDEX fki_pers_num
    ON public.cleaning_schedule USING btree
    (fki_pers_num ASC NULLS LAST)
    TABLESPACE pg_default;
-- Index: fki_serial_num
CREATE INDEX fki_serial_num
    ON public.cleaning_schedule USING btree
    (fki_serial_num ASC NULLS LAST)
    TABLESPACE pg_default;

-- Table: public.registration - создаём таблицу "Регистрация" с внешними ключами
-- к таблицам "Этаж", "Клиент", "Номер"
CREATE TABLE public.registration
(
    reg_id integer NOT NULL,
    set_date date NOT NULL,
    off_date date NOT NULL,
    fki_serial_num integer NOT NULL,
    fki_pass_id integer NOT NULL,
    amount_of_days integer NOT NULL,
    fki_floor_id integer NOT NULL,
    CONSTRAINT registration_pkey PRIMARY KEY (reg_id),
    CONSTRAINT floor_id FOREIGN KEY (fki_floor_id)
        REFERENCES public.floor (floor_id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    CONSTRAINT pass_id FOREIGN KEY (fki_pass_id)
        REFERENCES public.client (passport_id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    CONSTRAINT serial_num FOREIGN KEY (fki_serial_num)
        REFERENCES public.room (serial_number) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public.registration
    OWNER to postgres;

GRANT ALL ON TABLE public.registration TO postgres WITH GRANT OPTION;
-- Index: fki2_floor_id
CREATE INDEX fki2_floor_id
    ON public.registration USING btree
    (fki_floor_id ASC NULLS LAST)
    TABLESPACE pg_default;
-- Index: fki_pass_id
CREATE INDEX fki_pass_id
    ON public.registration USING btree
    (fki_pass_id ASC NULLS LAST)
    TABLESPACE pg_default;
-- Index: fki_room_num
CREATE INDEX fki_room_num
    ON public.registration USING btree
    (fki_serial_num ASC NULLS LAST)
    TABLESPACE pg_default;



-- Заполняем таблицу "Клиенты"
INSERT INTO public.client(
	passport_id, name, surname, patronymic, city)
	VALUES (172730, 'Ivan', 'Matveev', 'Olegivich', 'Moscow');

INSERT INTO public.client(
	passport_id, name, surname, patronymic, city)
	VALUES (893944, 'Alena', 'Selezneva', 'Viktorovna', 'Saint-Petersburg');

INSERT INTO public.client(
	passport_id, name, surname, patronymic, city)
	VALUES (566778, 'Vladimir', 'Morozov', 'Dmitrievich', 'Bryansk');

INSERT INTO public.client(
	passport_id, name, surname, patronymic, city)
	VALUES (489856, 'Maria', 'Loginovs', 'Semenovna', 'Samara');

INSERT INTO public.client(
	passport_id, name, surname, patronymic, city)
	VALUES (656566, 'Andrey', 'Mironov', 'Vladoslavovich', 'Saint-Petersburg');

-- Заполняем таблицу "Служащие"
INSERT INTO public.employees(
	personnel_num, wage, surname_emp, name_emp, patronymic_emp)
	VALUES (1216, 30000, 'Samoilova', 'Evgenia', 'Dmitrievna');
INSERT INTO public.employees(
	personnel_num, wage, surname_emp, name_emp, patronymic_emp)
	VALUES (1130, 20000, 'Eliseeva', 'Lubov', 'Michailovna');
INSERT INTO public.employees(
	personnel_num, wage, surname_emp, name_emp, patronymic_emp)
	VALUES (1217, 16000, 'Marchina', 'Ludmila', 'Andreevna');
INSERT INTO public.employees(
	personnel_num, wage, surname_emp, name_emp, patronymic_emp)
	VALUES (1020, 25000, 'Grigorev', 'Anatoliy', 'Vladislavovich');
INSERT INTO public.employees(
	personnel_num, wage, surname_emp, name_emp, patronymic_emp)
	VALUES (1517, 20000, 'Petrov', 'Vasiliy', 'Ivanovich');

-- Заполняем таблицу "Этаж"
INSERT INTO public.floor(
	floor_id, floor_num)
	VALUES (1, 1);

INSERT INTO public.floor(
	floor_id, floor_num)
	VALUES (2, 2);

INSERT INTO public.floor(
	floor_id, floor_num)
	VALUES (3, 3);

INSERT INTO public.floor(
	floor_id, floor_num)
	VALUES (4, 4);

INSERT INTO public.floor(
	floor_id, floor_num)
	VALUES (5, 5);

-- Заполняем таблицу "Номер"
INSERT INTO public.room(
	serial_number, fki_floor_id, cost_per_day, telephone_num, type)
	VALUES (11, 1, 1500, 6121811, 'single');

INSERT INTO public.room(
	serial_number, fki_floor_id, cost_per_day, telephone_num, type)
	VALUES (23, 2, 1500, 6126323, 'single');

INSERT INTO public.room(
	serial_number, fki_floor_id, cost_per_day, telephone_num, type)
	VALUES (45, 4, 2500, 6128745, 'double');

INSERT INTO public.room(
	serial_number, fki_floor_id, cost_per_day, telephone_num, type)
	VALUES (37, 3, 2500, 6121837, 'double');

INSERT INTO public.room(
	serial_number, fki_floor_id, cost_per_day, telephone_num, type)
	VALUES (56, 5, 3500, 6123456, 'triple');

-- Заполняем таблицу "Расписание уборки"
INSERT INTO public.cleaning_schedule(
	cleaning_id, data, week_day, fki_floor_id, fki_pers_num, fki_serial_num)
	VALUES (12, '2020-04-11', 'Friday', 1, 1517, 45);
INSERT INTO public.cleaning_schedule(
	cleaning_id, data, week_day, fki_floor_id, fki_pers_num, fki_serial_num)
	VALUES (16, '2020-04-16', 'Thursday', 2, 1020, 11);
INSERT INTO public.cleaning_schedule(
	cleaning_id, data, week_day, fki_floor_id, fki_pers_num, fki_serial_num)
	VALUES (21, '2020-05-06', 'Wednesday', 3, 1217, 23);
INSERT INTO public.cleaning_schedule(
	cleaning_id, data, week_day, fki_floor_id, fki_pers_num, fki_serial_num)
	VALUES (27, '2020-05-18', 'Monday', 4, 1130, 37);
INSERT INTO public.cleaning_schedule(
	cleaning_id, data, week_day, fki_floor_id, fki_pers_num, fki_serial_num)
	VALUES (6, '2020-06-19', 'Friday', 5, 1216, 56);

-- Заполняем таблицу "Регистрация"
INSERT INTO public.registration(
	reg_id, set_date, off_date, fki_serial_num, fki_pass_id, amount_of_days, fki_floor_id)
	VALUES (12, '2020-04-01', '2020-04-10', 45, 893944, 9, 4);
INSERT INTO public.registration(
	reg_id, set_date, off_date, fki_serial_num, fki_pass_id, amount_of_days, fki_floor_id)
	VALUES (18, '2020-04-02', '2020-04-15', 11, 489856, 13, 1);
INSERT INTO public.registration(
	reg_id, set_date, off_date, fki_serial_num, fki_pass_id, amount_of_days, fki_floor_id)
	VALUES (48, '2020-04-26', '2020-05-05', 23, 566778, 9, 2);
INSERT INTO public.registration(
	reg_id, set_date, off_date, fki_serial_num, fki_pass_id, amount_of_days, fki_floor_id)
	VALUES (52, '2020-05-01', '2020-05-17', 37, 656566, 16, 3);
INSERT INTO public.registration(
	reg_id, set_date, off_date, fki_serial_num, fki_pass_id, amount_of_days, fki_floor_id)
	VALUES (63, '2020-05-30', '2020-06-18', 56, 172730, 19, 5);
