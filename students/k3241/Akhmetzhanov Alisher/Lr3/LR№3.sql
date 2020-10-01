-- SCHEMA: public

CREATE SCHEMA public
    AUTHORIZATION postgres;

GRANT ALL ON SCHEMA public TO PUBLIC;

GRANT ALL ON SCHEMA public TO postgres;


-- TABLE: Клиент

CREATE TABLE public."Customer"
(
    "CustomerID" bigint NOT NULL DEFAULT nextval('"Customer_CustomerID_seq"'::regclass),
    "Date" text COLLATE pg_catalog."default" NOT NULL,
    "FirstName" text COLLATE pg_catalog."default" NOT NULL,
    "LastName" text COLLATE pg_catalog."default" NOT NULL,
    "SecondName" text COLLATE pg_catalog."default" NOT NULL,
    "City" text COLLATE pg_catalog."default" NOT NULL,
    CONSTRAINT "Customer_pkey" PRIMARY KEY ("CustomerID")
);


-- TABLE: администратор

CREATE TABLE public."Administrator"
(
    "AdministratorID" bigint NOT NULL DEFAULT nextval('"Administrator_AdministratorID_seq"'::regclass),
    "FirstName" text COLLATE pg_catalog."default" NOT NULL,
    "LastName" text COLLATE pg_catalog."default" NOT NULL,
    "SecondName" text COLLATE pg_catalog."default" NOT NULL,
    CONSTRAINT "Administrator_pkey" PRIMARY KEY ("AdministratorID")
);


-- TABLE: работники

CREATE TABLE public."Workers"
(
    "WorkerID" bigint NOT NULL DEFAULT nextval('"Workers_WorkerID_seq"'::regclass),
    "FirstName" text COLLATE pg_catalog."default" NOT NULL,
    "LastName" text COLLATE pg_catalog."default" NOT NULL,
    "SecondName" text COLLATE pg_catalog."default" NOT NULL,
    CONSTRAINT "Workers_pkey" PRIMARY KEY ("WorkerID")
);


-- TABLE: Этаж

CREATE TABLE public."Floor"
(
    "FloorID" bigint NOT NULL DEFAULT nextval('"Floor_FloorID_seq"'::regclass),
    "FloorNumber" integer NOT NULL,
    CONSTRAINT "Floor_pkey" PRIMARY KEY ("FloorID")
)


-- TABLE: Тип Комнаты

CREATE TABLE public."RoomType"
(
    "TypeID" bigint NOT NULL DEFAULT nextval('"RoomType_TypeID_seq"'::regclass),
    "Capacity" integer NOT NULL,
    CONSTRAINT "RoomType_pkey" PRIMARY KEY ("TypeID")
);


-- TABLE: Room

CREATE TABLE public."Room"
(
    "RoomID" bigint NOT NULL DEFAULT nextval('"Room_RoomID_seq"'::regclass),
    "FloorID" bigint NOT NULL,
    "DailyPrice" real NOT NULL,
    "TypeID" bigint NOT NULL,
    CONSTRAINT "Room_pkey" PRIMARY KEY ("RoomID"),
    CONSTRAINT "FloorID" FOREIGN KEY ("FloorID")
        REFERENCES public."Floor" ("FloorID") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID,
    CONSTRAINT "TypeID" FOREIGN KEY ("TypeID")
        REFERENCES public."RoomType" ("TypeID") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID
);


-- TABLE: расписание

CREATE TABLE public."Timetable"
(
    "TimetableID" bigint NOT NULL DEFAULT nextval('"Timetable_TimetableID_seq"'::regclass),
    "Weekday" integer NOT NULL,
    "FloorID" bigint NOT NULL,
    "WorkerID " bigint NOT NULL,
    CONSTRAINT "Timetable_pkey" PRIMARY KEY ("TimetableID"),
    CONSTRAINT "FloorID" FOREIGN KEY ("FloorID")
        REFERENCES public."Floor" ("FloorID") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID,
    CONSTRAINT "WorkerID" FOREIGN KEY ("WorkerID")
        REFERENCES public."Workers" ("WorkerID") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID
);


-- TABLE: Дни недели

CREATE TABLE public."Logs"
(
    "LogsID" bigint NOT NULL DEFAULT nextval('"Logs_LogsID_seq"'::regclass),
    "Date" date NOT NULL,
    "FloorID" bigint NOT NULL,
    "WorkerID " bigint NOT NULL,
    CONSTRAINT "Logs_pkey" PRIMARY KEY ("LogsID"),
    CONSTRAINT "FloorID" FOREIGN KEY ("FloorID")
        REFERENCES public."Floor" ("FloorID") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    CONSTRAINT "WorkerID" FOREIGN KEY ("WorkerID")
        REFERENCES public."Workers" ("WorkerID") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
);


-- TABLE: Догвоор О заселении

CREATE TABLE public."Contract"
(
    "ContractID" bigint NOT NULL DEFAULT nextval('"Contract_ContractID_seq"'::regclass),
    "AdministratorID" bigint NOT NULL,
    "CustomerID" bigint NOT NULL,
    "RoomID" bigint NOT NULL,
    CONSTRAINT "Contract_pkey" PRIMARY KEY ("ContractID"),
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
);


-- Fill table Customer

insert into "Customer" ("Date", "FirstName", "LastName", "SecondName", "City") values ("2000-01-11", "Анатолий", "Лесников","Дмитриевич",	"Москва");
insert into "Customer" ("Date", "FirstName", "LastName", "SecondName", "City") values ("2000-02-12", "Артем", "Мыльников","Дмитриевич",	"Санкт-Петербург");
insert into "Customer" ("Date", "FirstName", "LastName", "SecondName", "City") values ("2000-03-13", "Кадыр", "Лесников","Никитич",	"Красноярск");
insert into "Customer" ("Date", "FirstName", "LastName", "SecondName", "City") values ("2000-04-14", "Алишер", "Лесников","Мегикянович",	"Чебоксары");
insert into "Customer" ("Date", "FirstName", "LastName", "SecondName", "City") values ("2000-05-15", "Назар", "Назаров","Алишерович","Астана");
insert into "Customer" ("Date", "FirstName", "LastName", "SecondName", "City") values ("2000-06-16", "Алишер", "Ахметжанов","Мансурович","Астана");


-- Fill table Administrator

insert into "Administrator" ("FirstName", "LastName", "SecondName") values ("Сергей", "Андреев", "Артемович");
insert into "Administrator" ("FirstName", "LastName", "SecondName") values ("Василий", "Михайлов", "Дмитриевич");
insert into "Administrator" ("FirstName", "LastName", "SecondName") values ("Андрей", "Викторов", "Назарович");
insert into "Administrator" ("FirstName", "LastName", "SecondName") values ("Степан", "Барашкин", "Никитич");
insert into "Administrator" ("FirstName", "LastName", "SecondName") values ("Стас", "Козлов", "Степаныч");


-- Fill table Workers

insert into "Workers" ("FirstName", "LastName", "SecondName") values ("Артемида", "Простакова", "Михайловна");
insert into "Workers" ("FirstName", "LastName", "SecondName") values ("Андрей", "Бояров", "Андреевич");
insert into "Workers" ("FirstName", "LastName", "SecondName") values ("Михаил", "Курпатов", "Борисович");
insert into "Workers" ("FirstName", "LastName", "SecondName") values ("Ирина", "Борисенко", "Анатольевна");
insert into "Workers" ("FirstName", "LastName", "SecondName") values ("Светлана", "Залепина", "Романовна");


-- Fill table Floor

insert into "Floor" ("FloorNumber") values (1);
insert into "Floor" ("FloorNumber") values (2);
insert into "Floor" ("FloorNumber") values (3);
insert into "Floor" ("FloorNumber") values (4);
insert into "Floor" ("FloorNumber") values (5);


-- Fill table RoomType

insert into "RoomType" ("Capacity") values (1);
insert into "RoomType" ("Capacity") values (2);
insert into "RoomType" ("Capacity") values (3);


-- Fill table Room

insert into "Room" ("FloorID", "DailyPrice", "TypeID") values (1, 100, 1);
insert into "Room" ("FloorID", "DailyPrice", "TypeID") values (2, 200, 2);
insert into "Room" ("FloorID", "DailyPrice", "TypeID") values (3, 300, 3);
insert into "Room" ("FloorID", "DailyPrice", "TypeID") values (4, 200, 2);
insert into "Room" ("FloorID", "DailyPrice", "TypeID") values (5, 200, 2);


-- Fill table Timetable

insert into "Timetable" ("Weekday", "FloorID", "WorkerID") values (1, 1, 6);
insert into "Timetable" ("Weekday", "FloorID", "WorkerID") values (2, 2, 7);
insert into "Timetable" ("Weekday", "FloorID", "WorkerID ") values (3, 3, 8);
insert into "Timetable" ("Weekday", "FloorID", "WorkerID") values (4, 4, 9);
insert into "Timetable" ("Weekday", "FloorID", "WorkerID") values (5, 5, 10);
insert into "Timetable" ("Weekday", "FloorID", "WorkerID") values (5, 5, 8);


-- Fill table Logs

insert into "Logs" ("Date", "FloorID", "WorkerID") values ('2020-04-10', 1, 6);
insert into "Logs" ("Date", "FloorID", "WorkerID") values ('2020-04-15', 2, 7);
insert into "Logs" ("Date", "FloorID", "WorkerID") values ('2020-04-20', 3, 8);
insert into "Logs" ("Date", "FloorID", "WorkerID") values ('2020-04-25', 4, 9);
insert into "Logs" ("Date", "FloorID", "WorkerID") values ('2020-04-30', 5, 10);


-- Fill table Contract

insert into "Contract" ("AdministratorID", "CustomerID", "RoomID") values (6, 6, 1);
insert into "Contract" ("AdministratorID", "CustomerID", "RoomID") values (7, 7, 2);
insert into "Contract" ("AdministratorID", "CustomerID", "RoomID") values (8, 8, 1);
insert into "Contract" ("AdministratorID", "CustomerID", "RoomID") values (9, 9, 4);
insert into "Contract" ("AdministratorID", "CustomerID", "RoomID") values (10, 10, 5);