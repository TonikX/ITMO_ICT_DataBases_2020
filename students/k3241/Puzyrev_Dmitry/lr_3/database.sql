-- SCHEMA: public

CREATE SCHEMA public
    AUTHORIZATION postgres;

COMMENT ON SCHEMA public
    IS 'standard public schema';

GRANT ALL ON SCHEMA public TO PUBLIC;

GRANT ALL ON SCHEMA public TO postgres;


-- TABLE: Customer

CREATE TABLE public."Customer"
(
    "CustomerID" bigint NOT NULL DEFAULT nextval('"Customer_CustomerID_seq"'::regclass),
    "PassportNumber" text COLLATE pg_catalog."default" NOT NULL,
    "FirstName" text COLLATE pg_catalog."default" NOT NULL,
    "MiddleName" text COLLATE pg_catalog."default" NOT NULL,
    "LastName" text COLLATE pg_catalog."default" NOT NULL,
    "City" text COLLATE pg_catalog."default" NOT NULL,
    CONSTRAINT "Customer_pkey" PRIMARY KEY ("CustomerID")
)


-- TABLE: Administrator

CREATE TABLE public."Administrator"
(
    "AdministratorID" bigint NOT NULL DEFAULT nextval('"Administrator_ID_seq"'::regclass),
    "FirstName" text COLLATE pg_catalog."default" NOT NULL,
    "MiddleName" text COLLATE pg_catalog."default" NOT NULL,
    "LastName" text COLLATE pg_catalog."default" NOT NULL,
    CONSTRAINT "Administrator_pkey" PRIMARY KEY ("AdministratorID")
)


-- TABLE: Servant

CREATE TABLE public."Servant"
(
    "ServantID" bigint NOT NULL DEFAULT nextval('"Servant_ServantID_seq"'::regclass),
    "FirstName" text COLLATE pg_catalog."default" NOT NULL,
    "MiddleName" text COLLATE pg_catalog."default" NOT NULL,
    "LastName" text COLLATE pg_catalog."default" NOT NULL,
    CONSTRAINT "Servant_pkey" PRIMARY KEY ("ServantID")
)


-- TABLE: Floor

CREATE TABLE public."Floor"
(
    "FloorID" bigint NOT NULL DEFAULT nextval('"Floor_FloorID_seq"'::regclass),
    "FloorNumber" integer NOT NULL,
    CONSTRAINT "Floor_pkey" PRIMARY KEY ("FloorID")
)


-- TABLE: RoomType

CREATE TABLE public."RoomType"
(
    "TypeID" bigint NOT NULL DEFAULT nextval('"RoomType_TypeID_seq"'::regclass),
    "Capacity" integer NOT NULL,
    CONSTRAINT "RoomType_pkey" PRIMARY KEY ("TypeID")
)


-- TABLE: Room

CREATE TABLE public."Room"
(
    "RoomID" bigint NOT NULL DEFAULT nextval('"Room_RoomID_seq"'::regclass),
    "FloorID" bigint NOT NULL,
    "DailyPrice" real NOT NULL,
    "RoomTypeID" bigint NOT NULL,
    CONSTRAINT "Room_pkey" PRIMARY KEY ("RoomID"),
    CONSTRAINT "FloorID" FOREIGN KEY ("FloorID")
        REFERENCES public."Floor" ("FloorID") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID,
    CONSTRAINT "RoomTypeID" FOREIGN KEY ("RoomTypeID")
        REFERENCES public."RoomType" ("TypeID") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID
)


-- TABLE: CleaningSchedule

CREATE TABLE public."CleaningSchedule"
(
    "ScheduleID" bigint NOT NULL DEFAULT nextval('"CleaningSchedule_ScheduleID_seq"'::regclass),
    "Weekday" integer NOT NULL,
    "FloorID" bigint NOT NULL,
    "ServantID" bigint NOT NULL,
    CONSTRAINT "CleaningSchedule_pkey" PRIMARY KEY ("ScheduleID"),
    CONSTRAINT "FloorID" FOREIGN KEY ("FloorID")
        REFERENCES public."Floor" ("FloorID") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID,
    CONSTRAINT "ServantID" FOREIGN KEY ("ServantID")
        REFERENCES public."Servant" ("ServantID") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID
)


-- TABLE: CleaningLogs

CREATE TABLE public."CleaningLogs"
(
    "LogID" bigint NOT NULL DEFAULT nextval('"CleaningLogs_LogID_seq"'::regclass),
    "Date" date NOT NULL,
    "FloorID" bigint NOT NULL,
    "ServantID" bigint NOT NULL,
    CONSTRAINT "CleaningLogs_pkey" PRIMARY KEY ("LogID"),
    CONSTRAINT "FloorID" FOREIGN KEY ("FloorID")
        REFERENCES public."Floor" ("FloorID") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    CONSTRAINT "ServantID" FOREIGN KEY ("ServantID")
        REFERENCES public."Servant" ("ServantID") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)


-- TABLE: Accomodation

CREATE TABLE public."Accomodation"
(
    "AccomodationID" bigint NOT NULL DEFAULT nextval('"Accomodation_AccomodationID_seq"'::regclass),
    "StartDate" date NOT NULL,
    "EndDate" date,
    "AdministratorID" bigint NOT NULL,
    "CustomerID" bigint NOT NULL,
    "RoomID" bigint NOT NULL,
    CONSTRAINT "Accomodation_pkey" PRIMARY KEY ("AccomodationID"),
    CONSTRAINT "AdministratorID" FOREIGN KEY ("AdministratorID")
        REFERENCES public."Administrator" ("AdministratorID") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID,
    CONSTRAINT "CustomerID" FOREIGN KEY ("CustomerID")
        REFERENCES public."Customer" ("CustomerID") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID,
    CONSTRAINT "RoomID" FOREIGN KEY ("RoomID")
        REFERENCES public."Room" ("RoomID") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID
)


-- Fill table Customer

insert into "Customer" ("PassportNumber", "FirstName", "MiddleName", "LastName", "City") values ("1111", "Александр", "Васильевич",	"Прохоров",	"Москва")
insert into "Customer" ("PassportNumber", "FirstName", "MiddleName", "LastName", "City") values ("2222", "Андрей", "Пингвинин",	"Прохоров",	"Санкт-Петербург")
insert into "Customer" ("PassportNumber", "FirstName", "MiddleName", "LastName", "City") values ("3333", "Назар", "Васильевич",	"Ноготкин",	"Краснодар")
insert into "Customer" ("PassportNumber", "FirstName", "MiddleName", "LastName", "City") values ("4444", "Алишер", "Васильевич", "Мегикян",	"Черкесск")
insert into "Customer" ("PassportNumber", "FirstName", "MiddleName", "LastName", "City") values ("5555", "Анна", "Васильевич",	"Полякова",	"Армавир")


-- Fill table Administrator

insert into "Administrator" ("FirstName", "MiddleName", "LastName") values ("Дмитрий", "Андреевич", "Пузырев")
insert into "Administrator" ("FirstName", "MiddleName", "LastName") values ("Василий", "Михайлович", "Пупкин")
insert into "Administrator" ("FirstName", "MiddleName", "LastName") values ("Андрей", "Викторович", "Назаров")
insert into "Administrator" ("FirstName", "MiddleName", "LastName") values ("Семен", "Васильевич", "Новоселов")
insert into "Administrator" ("FirstName", "MiddleName", "LastName") values ("Дмитрий", "Сергеевич", "Новиков")


-- Fill table Servant

insert into "Servant" ("FirstName", "MiddleName", "LastName") values ("Анфиса", "Михайловна", "Простакова")
insert into "Servant" ("FirstName", "MiddleName", "LastName") values ("Андрей", "Александрович", "Курпатов")
insert into "Servant" ("FirstName", "MiddleName", "LastName") values ("Михаил", "Анатольевич", "Борисенко")
insert into "Servant" ("FirstName", "MiddleName", "LastName") values ("Ирина", "Юрьевна", "Зацепина")
insert into "Servant" ("FirstName", "MiddleName", "LastName") values ("Светлана", "Михайловна", "Конверова")


-- Fill table Floor

insert into "Floor" ("FloorNumber") values (1)
insert into "Floor" ("FloorNumber") values (2)
insert into "Floor" ("FloorNumber") values (3)
insert into "Floor" ("FloorNumber") values (4)
insert into "Floor" ("FloorNumber") values (5)


-- Fill table RoomType

insert into "RoomType" ("Capacity") values (1)
insert into "RoomType" ("Capacity") values (2)
insert into "RoomType" ("Capacity") values (3)


-- Fill table Room

insert into "Room" ("FloorID", "DailyPrice", "RoomTypeID") values (1, 100, 1)
insert into "Room" ("FloorID", "DailyPrice", "RoomTypeID") values (2, 100, 1)
insert into "Room" ("FloorID", "DailyPrice", "RoomTypeID") values (3, 300, 3)
insert into "Room" ("FloorID", "DailyPrice", "RoomTypeID") values (4, 200, 2)
insert into "Room" ("FloorID", "DailyPrice", "RoomTypeID") values (5, 200, 2)


-- Fill table CleaningSchedule

insert into "CleaningSchedule" ("Weekday", "FloorID", "ServantID") values (1, 1, 1)
insert into "CleaningSchedule" ("Weekday", "FloorID", "ServantID") values (1, 2, 2)
insert into "CleaningSchedule" ("Weekday", "FloorID", "ServantID") values (1, 3, 3)
insert into "CleaningSchedule" ("Weekday", "FloorID", "ServantID") values (1, 4, 4)
insert into "CleaningSchedule" ("Weekday", "FloorID", "ServantID") values (1, 5, 5)


-- Fill table CleaningLogs

insert into "CleaningLogs" ("Date", "FloorID", "ServantID") values ('2020-04-20', 1, 1)
insert into "CleaningLogs" ("Date", "FloorID", "ServantID") values ('2020-04-20', 2, 2)
insert into "CleaningLogs" ("Date", "FloorID", "ServantID") values ('2020-04-20', 3, 3)
insert into "CleaningLogs" ("Date", "FloorID", "ServantID") values ('2020-04-20', 4, 4)
insert into "CleaningLogs" ("Date", "FloorID", "ServantID") values ('2020-04-20', 5, 5)


-- Fill table Accomodation

insert into "Accomodation" ("StartDate", "EndDate", "AdministratorID", "CustomerID", "RoomID") values ('2019-12-5', '2019-12-10', 2, 1, 1)
insert into "Accomodation" ("StartDate", "EndDate", "AdministratorID", "CustomerID", "RoomID") values ('2019-12-7', '2019-12-29', 2, 2, 2)
insert into "Accomodation" ("StartDate", "AdministratorID", "CustomerID", "RoomID") values ('2020-04-01', 1, 3, 1)
insert into "Accomodation" ("StartDate", "AdministratorID", "CustomerID", "RoomID") values ('2020-04-01', 3, 4, 4)
insert into "Accomodation" ("StartDate", "AdministratorID", "CustomerID", "RoomID") values ('2020-04-20', 5, 5, 5)

