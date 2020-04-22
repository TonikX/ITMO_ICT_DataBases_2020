-- Database: Climbing Club

-- DROP DATABASE "Climbing Club";

CREATE DATABASE "Climbing Club"
    WITH 
    OWNER = postgres
    ENCODING = 'UTF8'
    LC_COLLATE = 'Russian_Russia.1251'
    LC_CTYPE = 'Russian_Russia.1251'
    TABLESPACE = pg_default
    CONNECTION LIMIT = -1;

COMMENT ON DATABASE "Climbing Club"
    IS 'База данных альпинистского клуба';

-- Table: public."Club"

-- DROP TABLE public."Club";
--Таблица Клуб. Содержит информацию об альпинистских клубах

CREATE TABLE public."Club"
(
    id integer NOT NULL,
    name text COLLATE pg_catalog."default" NOT NULL,
    country text COLLATE pg_catalog."default",
    city text COLLATE pg_catalog."default",
    email text COLLATE pg_catalog."default",
    phone_number text COLLATE pg_catalog."default" NOT NULL,
    contact_person text COLLATE pg_catalog."default" NOT NULL,
    CONSTRAINT "Club_pkey" PRIMARY KEY (id)
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public."Club"
    OWNER to postgres;
COMMENT ON TABLE public."Club"
    IS 'Содержит информацию об альпинистских клубах';

-- Table: public.members
--Таблица Участники. Содержит информацию об участниках

-- DROP TABLE public.members;

CREATE TABLE public.members
(
    id integer NOT NULL,
    name text COLLATE pg_catalog."default" NOT NULL,
    phone_number text COLLATE pg_catalog."default" NOT NULL,
    address text COLLATE pg_catalog."default",
    id_club integer NOT NULL,
    CONSTRAINT members_pkey PRIMARY KEY (id),
    CONSTRAINT id_club FOREIGN KEY (id_club)
        REFERENCES public."Club" (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE CASCADE
        NOT VALID
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public.members
    OWNER to postgres;
COMMENT ON TABLE public.members
    IS 'Содержит информацию об участниках';


-- Table: public."Group"
-- Таблица Группа. Содержит информацию о группе альпинистов

-- DROP TABLE public."Group";

CREATE TABLE public."Group"
(
    id integer NOT NULL,
    climbing_detail text COLLATE pg_catalog."default",
    climbing_status text COLLATE pg_catalog."default",
    CONSTRAINT "Group_pkey" PRIMARY KEY (id)
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public."Group"
    OWNER to postgres;
COMMENT ON TABLE public."Group"
    IS 'Содержит информацию о группе альпинистов';

-- Table: public."Group_member"
-- Ассоциативная сущность группа_участники, содержит информацию об участниках, входящий в группу

-- DROP TABLE public."Group_member";

CREATE TABLE public."Group_member"
(
    id integer NOT NULL,
    id_group integer NOT NULL,
    id_member integer NOT NULL,
    status text COLLATE pg_catalog."default",
    CONSTRAINT "Group_member_pkey" PRIMARY KEY (id),
    CONSTRAINT id_group FOREIGN KEY (id_group)
        REFERENCES public."Group" (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE CASCADE,
    CONSTRAINT id_member FOREIGN KEY (id_member)
        REFERENCES public.members (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE CASCADE
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public."Group_member"
    OWNER to postgres;
COMMENT ON TABLE public."Group_member"
    IS 'Ассоциативная сущность, содержит информацию об участниках, входящий в группу';


-- Table: public.mountain
--Таблица гора. Содержит информацию о горах

-- DROP TABLE public.mountain;

CREATE TABLE public.mountain
(
    id integer NOT NULL,
    name text COLLATE pg_catalog."default" NOT NULL,
    country text COLLATE pg_catalog."default" NOT NULL,
    district text COLLATE pg_catalog."default",
    height integer,
    CONSTRAINT mountain_pkey PRIMARY KEY (id),
    CONSTRAINT chk_height CHECK (height > 0)
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public.mountain
    OWNER to postgres;
COMMENT ON TABLE public.mountain
    IS 'Содержит информацию о горах';

-- Table: public."Route"
--Таблица маршрут. Таблица содержит информацию о доступных маршрутах

-- DROP TABLE public."Route";

CREATE TABLE public."Route"
(
    id integer NOT NULL,
    id_mountain integer NOT NULL,
    description text COLLATE pg_catalog."default" NOT NULL,
    difficulty text COLLATE pg_catalog."default" NOT NULL,
    duration_hours integer NOT NULL,
    CONSTRAINT "Route_pkey" PRIMARY KEY (id),
    CONSTRAINT id_mountain FOREIGN KEY (id_mountain)
        REFERENCES public.mountain (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public."Route"
    OWNER to postgres;
COMMENT ON TABLE public."Route"
    IS 'Таблица содержит информацию о доступных маршрутах';


-- Table: public."Climbing"
--Таблица восхождение. Содержит информацию о восхождениях

-- DROP TABLE public."Climbing";

CREATE TABLE public."Climbing"
(
    id integer NOT NULL,
    climbing_start date NOT NULL,
    climbing_end_real date,
    climbing_end_theory date NOT NULL,
    id_route integer,
    id_group integer,
    CONSTRAINT "Climbing_pkey" PRIMARY KEY (id),
    CONSTRAINT id_group FOREIGN KEY (id_group)
        REFERENCES public."Group" (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID,
    CONSTRAINT id_route FOREIGN KEY (id_route)
        REFERENCES public."Route" (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID,
    CONSTRAINT check_real_end CHECK (climbing_end_real > climbing_start),
    CONSTRAINT check_theory_end CHECK (climbing_end_theory > climbing_start)
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public."Climbing"
    OWNER to postgres;
COMMENT ON TABLE public."Climbing"
    IS 'Содержит информацию о восхождениях';


-- Table: public."Accident"
-- Таблица происшествие. Содержит данные о происшествиях участников во время восхождения, ассоциативная сущность

-- DROP TABLE public."Accident";

CREATE TABLE public."Accident"
(
    id integer NOT NULL,
    id_member integer NOT NULL,
    id_climbing integer NOT NULL,
    date date NOT NULL,
    description text COLLATE pg_catalog."default" NOT NULL,
    CONSTRAINT "Accident_pkey" PRIMARY KEY (id),
    CONSTRAINT id_climbing FOREIGN KEY (id_climbing)
        REFERENCES public."Climbing" (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    CONSTRAINT id_member FOREIGN KEY (id_member)
        REFERENCES public.members (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public."Accident"
    OWNER to postgres;
COMMENT ON TABLE public."Accident"
    IS 'Содержит данные о происшествиях участников во время восхождения, ассоциативная сущность';



--Заполнение данными
--таблица Гора
INSERT INTO public.mountain(
	id, name, country, district, height)
	VALUES (0, 'Эверест', 'Непал', 'Гималаи', 8848);
	
INSERT INTO public.mountain(
	id, name, country, district, height)
	VALUES (1, 'Монте-Роза', 'Швейцария', 'Пеннинские Альпы', 4634);
	
INSERT INTO public.mountain(
	id, name, country, district, height)
	VALUES (2, 'Белуха', 'Россия', 'Горный Алтай', 4509);
	
INSERT INTO public.mountain(
	id, name, country, district, height)
	VALUES (3, 'Айленд Пик', 'Непал', 'Гималаи', 6130);
	
INSERT INTO public.mountain(
	id, name, country, district, height)
	VALUES (4, 'Сток-Кангри', 'Индия', 'Гималаи', 6137);

--таблица Маршрут
INSERT INTO public."Route"(
	id, id_mountain, description, difficulty, duration_hours)
	VALUES (0, 0, 'Самый опасный путь', 'высокая', '145');
	
INSERT INTO public."Route"(
	id, id_mountain, description, difficulty, duration_hours)
	VALUES (1, 1, 'Чисто посмотреть', 'низкая', '48');
	
INSERT INTO public."Route"(
	id, id_mountain, description, difficulty, duration_hours)
	VALUES (2, 2, 'Импортозамещение', 'низкая', '94');
	
INSERT INTO public."Route"(
	id, id_mountain, description, difficulty, duration_hours)
	VALUES (3, 3, 'Не сильно увлекательно, но пойдет нервишки пощекотать', 'средняя', '96');
	
INSERT INTO public."Route"(
	id, id_mountain, description, difficulty, duration_hours)
	VALUES (4, 4, 'Для тех, кому страшно на Эверест, но рядом побыть хочется', 'высокая', '152');

--таблица Клуб
INSERT INTO public."Club"(
	id, name, country, city, email, phone_number, contact_person)
	VALUES (0, 'Ромашка', 'Россия', 'Саранск', 'aaa@mail.ru', '88005553535', 'Васильев А.В.');
	
INSERT INTO public."Club"(
	id, name, country, city, email, phone_number, contact_person)
	VALUES (1, 'Василек', 'Украина', 'Хацапетовка', 'bbb@mail.ru', '12345678912', 'Морозов К.Н.');
	
INSERT INTO public."Club"(
	id, name, country, city, email, phone_number, contact_person)
	VALUES (2, 'Любители котиков', 'Беларусь', 'Гданьск', 'ccc@mail.ru', '98765432198', 'Николаева У.Щ.');
	
INSERT INTO public."Club"(
	id, name, country, city, email, phone_number, contact_person)
	VALUES (3, 'Любители пёселей', 'Чехия', 'Карловы Вары','ddd@mail.ru', '78945612378', 'Бурко Л.У.');
	
INSERT INTO public."Club"(
	id, name, country, city, email, phone_number, contact_person)
	VALUES (4, 'Любители проверенных лаб', 'Другая планета', 'Санкт-Питер', 'eee@mail.ru', '11111111111', 'Лаврентьева В.Л.');

--таблица Участники
INSERT INTO public.members(
	id, name, phone_number, address, id_club)
	VALUES (0, 'Колотушкин А.У.', '88005553535', 'ул. Пушкина 1', 4);
	
INSERT INTO public.members(
	id, name, phone_number, address, id_club)
	VALUES (1, 'Мушкин П.В.', '12345678989', 'ул. Муркина 2', 4);
	
INSERT INTO public.members(
	id, name, phone_number, address, id_club)
	VALUES (2, 'Милкованова Р.Т.', '98798798778', 'Кучновский проезд 3', 4);
	
INSERT INTO public.members(
	id, name, phone_number, address, id_club)
	VALUES (3, 'Кошкина М.А.', '12312312312', 'Домовская дорога 4', 4);
	
INSERT INTO public.members(
	id, name, phone_number, address, id_club)
	VALUES (4, 'Задротов А.Р.', '46545645645', 'Кухонная площадь 5', 4);

--таблица Группа
INSERT INTO public."Group"(
	id, climbing_detail, climbing_status)
	VALUES (0, 'без происшествий', 'успешно');
	
INSERT INTO public."Group"(
	id, climbing_detail, climbing_status)
	VALUES (1, '', 'планируется');
	
INSERT INTO public."Group"(
	id, climbing_detail, climbing_status)
	VALUES (2, '', 'планируется');
	
INSERT INTO public."Group"(
	id, climbing_detail, climbing_status)
	VALUES (3, 'плохие погодные условия', 'отменено');
	
INSERT INTO public."Group"(
	id, climbing_detail, climbing_status)
	VALUES (4, '', 'планируется');

-- таблица группа-участники
INSERT INTO public."Group_member"(
	id, id_group, id_member, status)
	VALUES (0, 0, 0, 'без происшествий');
	
INSERT INTO public."Group_member"(
	id, id_group, id_member, status)
	VALUES (1, 0, 1, 'травмирован');
	
INSERT INTO public."Group_member"(
	id, id_group, id_member, status)
	VALUES (2, 1, 2, '');
	
INSERT INTO public."Group_member"(
	id, id_group, id_member, status)
	VALUES (3, 1, 3, '');
	
INSERT INTO public."Group_member"(
	id, id_group, id_member, status)
	VALUES (4, 1, 4, '');

--таблица восхождение
INSERT INTO public."Climbing"(
	id, climbing_start, climbing_end_theory, id_route, id_group)
	VALUES (0, '2020-04-15', '2020-04-20', 0, 0);
	
INSERT INTO public."Climbing"(
	id, climbing_start, climbing_end_theory, id_route, id_group)
	VALUES (1, '2020-06-12', '2020-06-15', 1, 0);
	
INSERT INTO public."Climbing"(
	id, climbing_start, climbing_end_real, climbing_end_theory, id_route, id_group)
	VALUES (2, '2020-01-07', '2020-01-13', '2020-01-12', 2, 0);
	
INSERT INTO public."Climbing"(
	id, climbing_start, climbing_end_theory, id_route, id_group)
	VALUES (3, '2020-09-30', '2020-10-05', 3, 0);
	
INSERT INTO public."Climbing"(
	id, climbing_start, climbing_end_real, climbing_end_theory, id_route, id_group)
	VALUES (4, '2018-12-12', '2018-12-15', '2018-12-15', 4, 0);

--таблица происшествие
INSERT INTO public."Accident"(
	id, id_member, id_climbing, date, description)
	VALUES 
	(0, 0, 1, '2020-04-16', 'сломал руку'),
	(1, 0, 3, '2020-01-08', 'сломал ногу'),
	(2, 1, 3, '2020-01-09', 'порезался'),
	(3, 0, 4, '2018-12-14', 'потерял сознание'),
	(4, 1, 4, '2018-12-15', 'украл тушенку');