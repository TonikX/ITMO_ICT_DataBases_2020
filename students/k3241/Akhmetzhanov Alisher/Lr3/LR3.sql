-- SCHEMA: lr3

CREATE SCHEMA lr3
    AUTHORIZATION postgres;

GRANT ALL ON SCHEMA lr3 TO lr3;

GRANT ALL ON SCHEMA lr3 TO postgres;


-- TABLE: Клиент

CREATE TABLE lr3."Клиент"
(
    "ИД_паспорта" bigint NOT NULL DEFAULT nextval('"Клиент_ИД_паспорта_seq"'::regclass),
    "Дата_заселения" text COLLATE pg_catalog."default" NOT NULL,
    "Имя" text COLLATE pg_catalog."default" NOT NULL,
    "фамилия" text COLLATE pg_catalog."default" NOT NULL,
    "Отчество" text COLLATE pg_catalog."default" NOT NULL,
    "Город" text COLLATE pg_catalog."default" NOT NULL,
    CONSTRAINT "Клиент_pkey" PRIMARY KEY ("ИД_паспорта")
)


-- TABLE: Администратор

CREATE TABLE lr3."Администратор"
(
    "ИД_администратора" bigint NOT NULL DEFAULT nextval('"Администратор_ИД_администратора_seq"'::regclass),
    "Имя" text COLLATE pg_catalog."default" NOT NULL,
    "фамилия" text COLLATE pg_catalog."default" NOT NULL,
    "Отчество" text COLLATE pg_catalog."default" NOT NULL,
    CONSTRAINT "Администратор_pkey" PRIMARY KEY ("ИД_администратора")
)


-- TABLE: Работники

CREATE TABLE lr3."Работники"
(
    "ИД_работника" bigint NOT NULL DEFAULT nextval('"Работники_ИД_работника_seq"'::regclass),
    "Имя" text COLLATE pg_catalog."default" NOT NULL,
    "фамилия" text COLLATE pg_catalog."default" NOT NULL,
    "Отчество" text COLLATE pg_catalog."default" NOT NULL,
    CONSTRAINT "Работники_pkey" PRIMARY KEY ("ИД_работника")
)


-- TABLE: Этаж

CREATE TABLE lr3."Этаж"
(
    "ИД_этажа" bigint NOT NULL DEFAULT nextval('"Этаж_ИД_этажа_seq"'::regclass),
    "Номер_этажа" integer NOT NULL,
    CONSTRAINT "Этаж_pkey" PRIMARY KEY ("ИД_этажа")
)


-- TABLE: ТипКомнаты

CREATE TABLE lr3."ТипКомнаты"
(
    "ИД_типа" bigint NOT NULL DEFAULT nextval('"ТипКомнаты_ИД_типа_seq"'::regclass),
    "Вместимость" integer NOT NULL,
    CONSTRAINT "ТипКомнаты_pkey" PRIMARY KEY ("ИД_типа")
)


-- TABLE: Номер

CREATE TABLE lr3."Номер"
(
    "ИД_номера" bigint NOT NULL DEFAULT nextval('"Номер_ИД_номера_seq"'::regclass),
    "ИД_этажа" bigint NOT NULL,
    "ЦенаЗаДень" real NOT NULL,
    "ИД_типа" bigint NOT NULL,
    CONSTRAINT "Номер_pkey" PRIMARY KEY ("ИД_номера"),
    CONSTRAINT "ИД_этажа" FOREIGN KEY ("ИД_этажа")
        REFERENCES lr3."Этаж" ("ИД_этажа") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID,
    CONSTRAINT "ИД_типа" FOREIGN KEY ("ИД_типа")
        REFERENCES lr3."ТипКомнаты" ("ИД_типа") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID
)


-- TABLE: Расписание

CREATE TABLE lr3."Расписание"
(
    "ИД_расписания" bigint NOT NULL DEFAULT nextval('"Расписание_ИД_расписания_seq"'::regclass),
    "БуднийДень" integer NOT NULL,
    "ИД_этажа" bigint NOT NULL,
    "ИД_работника " bigint NOT NULL,
    CONSTRAINT "Расписание_pkey" PRIMARY KEY ("ИД_расписания"),
    CONSTRAINT "ИД_этажа" FOREIGN KEY ("ИД_этажа")
        REFERENCES lr3."Этаж" ("ИД_этажа") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID,
    CONSTRAINT "ИД_работника" FOREIGN KEY ("ИД_работника")
        REFERENCES lr3."Работники" ("ИД_работника") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID
)


-- TABLE: ДниНедели

CREATE TABLE lr3."ДниНедели"
(
    "ИД_дня" bigint NOT NULL DEFAULT nextval('"ДниНедели_ИД_дня_seq"'::regclass),
    "Дата" date NOT NULL,
    "ИД_этажа" bigint NOT NULL,
    "ИД_работника " bigint NOT NULL,
    CONSTRAINT "ДниНедели_pkey" PRIMARY KEY ("ИД_дня"),
    CONSTRAINT "ИД_этажа" FOREIGN KEY ("ИД_этажа")
        REFERENCES lr3."Этаж" ("ИД_этажа") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    CONSTRAINT "ИД_работника" FOREIGN KEY ("ИД_работника")
        REFERENCES lr3."Работники" ("ИД_работника") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)


-- TABLE: ДоговорОзаселении

CREATE TABLE lr3."ДоговорОзаселении"
(
    "ИД_договора" bigint NOT NULL DEFAULT nextval('"ДоговорОзаселении_ИД_договора_seq"'::regclass),
    "ИД_администратора" bigint NOT NULL,
    "ИД_паспорта" bigint NOT NULL,
    "ИД_номера" bigint NOT NULL,
    CONSTRAINT "ДоговорОзаселении_pkey" PRIMARY KEY ("ИД_договора"),
    CONSTRAINT "ИД_администратора" FOREIGN KEY ("ИД_администратора")
        REFERENCES lr3."Администратор" ("ИД_администратора") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID,
    CONSTRAINT "ИД_паспорта" FOREIGN KEY ("ИД_паспорта")
        REFERENCES lr3."Клиент" ("ИД_паспорта") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID,
    CONSTRAINT "ИД_номера" FOREIGN KEY ("ИД_номера")
        REFERENCES lr3."Номер" ("ИД_номера") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID
)


-- Fill table Клиент

insert into "Клиент" ("Дата_заселения", "Имя", "фамилия", "Отчество", "Город") values ("111", "Анатолий", "Лесников",	"Дмитриевич",	"Москва")
insert into "Клиент" ("Дата_заселения", "Имя", "фамилия", "Отчество", "Город") values ("222", "Артем", "Пингвинин",	"Дмитриевич",	"Санкт-Петербург")
insert into "Клиент" ("Дата_заселения", "Имя", "фамилия", "Отчество", "Город") values ("333", "Кадыр", "Лесников",	"Никитич",	"Красноярск")
insert into "Клиент" ("Дата_заселения", "Имя", "фамилия", "Отчество", "Город") values ("444", "Алишер", "Лесников", "Мегикянович",	"Чебоксары")
insert into "Клиент" ("Дата_заселения", "Имя", "фамилия", "Отчество", "Город") values ("555", "Настасья", "Лесникова",	"Алишеровна","Астана")


-- Fill table Администратор

insert into "Администратор" ("Имя", "фамилия", "Отчество") values ("Сергей", "Андреевич", "Тополев")
insert into "Администратор" ("Имя", "фамилия", "Отчество") values ("Василий", "Михайлович", "Пупкин")
insert into "Администратор" ("Имя", "фамилия", "Отчество") values ("Андрей", "Викторович", "Назаров")
insert into "Администратор" ("Имя", "фамилия", "Отчество") values ("Семен", "Лесников", "Новоселов")
insert into "Администратор" ("Имя", "фамилия", "Отчество") values ("Сергей", "Сергеевич", "Новиков")


-- Fill table Работники

insert into "Работники" ("Имя", "фамилия", "Отчество") values ("Анфиса", "Михайловна", "Простакова")
insert into "Работники" ("Имя", "фамилия", "Отчество") values ("Андрей", "Александрович", "Курпатов")
insert into "Работники" ("Имя", "фамилия", "Отчество") values ("Михаил", "Анатольевич", "Борисенко")
insert into "Работники" ("Имя", "фамилия", "Отчество") values ("Ирина", "Юрьевна", "Зацепина")
insert into "Работники" ("Имя", "фамилия", "Отчество") values ("Светлана", "Михайловна", "Конверова")


-- Fill table Этаж

insert into "Этаж" ("Номер_этажа") values (1)
insert into "Этаж" ("Номер_этажа") values (2)
insert into "Этаж" ("Номер_этажа") values (3)
insert into "Этаж" ("Номер_этажа") values (4)
insert into "Этаж" ("Номер_этажа") values (5)


-- Fill table ТипКомнаты

insert into "ТипКомнаты" ("Вместимость") values (1)
insert into "ТипКомнаты" ("Вместимость") values (2)
insert into "ТипКомнаты" ("Вместимость") values (3)


-- Fill table Номер

insert into "Номер" ("ИД_этажа", "ЦенаЗаДень", "ИД_типа") values (1, 100, 1)
insert into "Номер" ("ИД_этажа", "ЦенаЗаДень", "ИД_типа") values (2, 100, 1)
insert into "Номер" ("ИД_этажа", "ЦенаЗаДень", "ИД_типа") values (3, 300, 3)
insert into "Номер" ("ИД_этажа", "ЦенаЗаДень", "ИД_типа") values (4, 200, 2)
insert into "Номер" ("ИД_этажа", "ЦенаЗаДень", "ИД_типа") values (5, 200, 2)


-- Fill table Расписание

insert into "Расписание" ("БуднийДень", "ИД_этажа", "ИД_работника") values (1, 1, 1)
insert into "Расписание" ("БуднийДень", "ИД_этажа", "ИД_работника") values (1, 2, 2)
insert into "Расписание" ("БуднийДень", "ИД_этажа", "ИД_работника ") values (1, 3, 3)
insert into "Расписание" ("БуднийДень", "ИД_этажа", "ИД_работника") values (1, 4, 4)
insert into "Расписание" ("БуднийДень", "ИД_этажа", "ИД_работника") values (1, 5, 5)


-- Fill table ДниНедели

insert into "ДниНедели" ("Дата", "ИД_этажа", "ИД_работника") values ('2020-04-20', 1, 1)
insert into "ДниНедели" ("Дата", "ИД_этажа", "ИД_работника") values ('2020-04-20', 2, 2)
insert into "ДниНедели" ("Дата", "ИД_этажа", "ИД_работника") values ('2020-04-20', 3, 3)
insert into "ДниНедели" ("Дата", "ИД_этажа", "ИД_работника") values ('2020-04-20', 4, 4)
insert into "ДниНедели" ("Дата", "ИД_этажа", "ИД_работника") values ('2020-04-20', 5, 5)


-- Fill table ДоговорОзаселении

insert into "ДоговорОзаселении" ("ИД_администратора", "ИД_паспорта", "ИД_номера") values (2, 1, 1)
insert into "ДоговорОзаселении" ("ИД_администратора", "ИД_паспорта", "ИД_номера") values (2, 2, 2)
insert into "ДоговорОзаселении" ("ИД_администратора", "ИД_паспорта", "ИД_номера") values (1, 3, 1)
insert into "ДоговорОзаселении" ("ИД_администратора", "ИД_паспорта", "ИД_номера") values (3, 4, 4)
insert into "ДоговорОзаселении" ("ИД_администратора", "ИД_паспорта", "ИД_номера") values (5, 5, 5)