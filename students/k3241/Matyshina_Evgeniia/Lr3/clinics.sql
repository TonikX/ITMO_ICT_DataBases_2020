-- Создание таблицы Кабинеты
-- Table: public."Cabinet"

-- DROP TABLE public."Cabinet";

CREATE TABLE public."Cabinet"
(
    id_cabinet integer NOT NULL DEFAULT nextval('"Cabinet_id_cabinet_seq"'::regclass),
    full_name text COLLATE pg_catalog."default" NOT NULL,
    contacts text COLLATE pg_catalog."default" NOT NULL,
    CONSTRAINT id_cabinet PRIMARY KEY (id_cabinet)
)

TABLESPACE pg_default;

ALTER TABLE public."Cabinet"
    OWNER to postgres;
-- Заполнение таблицы кабинеты
INSERT INTO public."Cabinet"(id_cabinet, full_name, contacts)
VALUES
(default, 'Palamarchyk', '89207534056'),
(default,'Ivanova', '89312456789' ),
(default, 'Petrov', '89217534054'),
(default, 'Sumov', '89297534044'),
(default, 'Voronina', '89237434152');





-- Создание таблицы Диагнозы
- Table: public."Diagnosis"

-- DROP TABLE public."Diagnosis";

CREATE TABLE public."Diagnosis"
(
    id_diagnosis integer NOT NULL DEFAULT nextval('"Diagnosis_id_diagnosis_seq"'::regclass),
    title text COLLATE pg_catalog."default" NOT NULL,
    description text COLLATE pg_catalog."default" NOT NULL,
    CONSTRAINT id_diagnosis PRIMARY KEY (id_diagnosis)
)

TABLESPACE pg_default;

ALTER TABLE public."Diagnosis"
    OWNER to postgres;
-- Заполнение таблицы документы
INSERT INTO public."Diagnosis"(id_diagnosis, title, description)
	VALUES 
	(default, 'quinsy', 'Symptoms include fever, throat pain, trouble opening the mouth, and a change to the voice.'), 
	(default, 'rhinitis', 'Common symptoms are a stuffy nose, runny nose, sneezing, and post-nasal drip.'),
	(default, 'flu', 'Usually referred to as the flu or grippe, influenza is a highly infectious respiratory disease.'), 
	(default, 'pneumonia', 'The infection causes inflammation in the air sacs in your lungs, which are called alveoli.'),
	(default, 'anaemia', 'Anemia diminishes the capacity of the blood to carry oxygen.');





-- Создание таблицы врачи
-- Table: public."Doctors"

-- DROP TABLE public."Doctors";

CREATE TABLE public."Doctors"
(
    id_doctor integer NOT NULL DEFAULT nextval('"Doctors_id_doctor_seq"'::regclass),
    "id_cabinetFK" integer NOT NULL DEFAULT nextval('"Doctors_id_cabinetFK_seq"'::regclass),
    full_name text COLLATE pg_catalog."default" NOT NULL,
    specialization text COLLATE pg_catalog."default" NOT NULL,
    education text COLLATE pg_catalog."default" NOT NULL,
    male_female text COLLATE pg_catalog."default" NOT NULL,
    birthday date NOT NULL,
    dogovor text COLLATE pg_catalog."default" NOT NULL,
    time_working_in_clinics text COLLATE pg_catalog."default" NOT NULL,
    CONSTRAINT id_doctor PRIMARY KEY (id_doctor),
    CONSTRAINT "id_cabinetFK" FOREIGN KEY ("id_cabinetFK")
        REFERENCES public."Cabinet" (id_cabinet) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID
)

TABLESPACE pg_default;

ALTER TABLE public."Doctors"
    OWNER to postgres;
-- Заполнение таблицы врачи
INSERT INTO public."Doctors"(id_doctor, "id_cabinetFK", full_name, specialization, education, male_female, birthday, dogovor, time_working_in_clinics)
	VALUES
	(default, 6, 'Kirill Petrov', 'avtolmolog', 'BD', 'male', '1985/05/09', 'no 	information', '3 year'), 
	(default, 7, 'Sam Petrovich', 'psiholog', 'MD', 'male', '1961/04/02', 'no information', '2 month'),
	(default, 8, 'Toni Urodyl', 'lor', 'BD', 'male', '1984/03/02', 'no information', '1 year'), 
	(default, 9, 'Viktoria Erokhina', 'urolog', 'MD', 'female', '1974/10/02', 'no information', '4 month'),
	(default, 10, 'Artem Tarasov', 'pulmanolog', 'MD', 'male', '1981/11/05', 'no information', '5 year');





-- Создание таблицы медицинские карты
-- Table: public."Medical_records"

-- DROP TABLE public."Medical_records";

CREATE TABLE public."Medical_records"
(
    id_patient integer NOT NULL DEFAULT nextval('"Medical_records_id_patient_seq"'::regclass),
    contacts text COLLATE pg_catalog."default" NOT NULL,
    birthday date NOT NULL,
    full_name text COLLATE pg_catalog."default" NOT NULL,
    CONSTRAINT id_patient PRIMARY KEY (id_patient)
        INCLUDE(id_patient)
)

TABLESPACE pg_default;

ALTER TABLE public."Medical_records"
    OWNER to postgres;
-- Заполнение таблицы медицинские карты
INSERT INTO public."Medical_records"(id_patient, contacts, birthday, full_name)
	VALUES 
	(default, '+7920754994', '1999/05/06', 'Pavel Naprimerov'), 
	(default, '+79201754995', '2000/09/07', 'Ekaterina Grigoreva'),
	(default, '+7930754988', '2010/05/02', 'Artem Medvedev'), 
	(default, '+7928753991', '1967/06/10', 'Nikita Orexov'),
	(default, '+7920754654', '1956/11/12', 'Sofia Morgunova');





-- Создание таблицы диагнозы пациента
-- Table: public."Patient_diagnosis"

-- DROP TABLE public."Patient_diagnosis";

CREATE TABLE public."Patient_diagnosis"
(
    "id_diagnosisFK" integer NOT NULL DEFAULT nextval('"Patient_diagnosis_id_diagnosisFK_seq"'::regclass),
    "id_patientFK" integer NOT NULL DEFAULT nextval('"Patient_diagnosis_id_patientFK_seq"'::regclass),
    date_diagnosis date NOT NULL,
    CONSTRAINT "id_diagnosisFK" FOREIGN KEY ("id_diagnosisFK")
        REFERENCES public."Diagnosis" (id_diagnosis) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    CONSTRAINT "id_patientFK" FOREIGN KEY ("id_patientFK")
        REFERENCES public."Medical_records" (id_patient) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID
)

TABLESPACE pg_default;

ALTER TABLE public."Patient_diagnosis"
    OWNER to postgres;
-- Заполнение таблицы диагнозы пациента
INSERT INTO public."Patient_diagnosis"("id_diagnosisFK", "id_patientFK", date_diagnosis)
	VALUES
	(1, 11, '2020/04/05'),
	(2, 12, '2020/05/04'),
	(3, 13, '2020/06/07'),
	(4, 14, '2021/05/04'),
	(5, 15, '2020/11/03');





-- Создание таблицы стоимость приема
-- Table: public."Priem_cost"

-- DROP TABLE public."Priem_cost";

CREATE TABLE public."Priem_cost"
(
    id_priem integer NOT NULL DEFAULT nextval('"Priem_cost_id_priem_seq"'::regclass),
    cost text COLLATE pg_catalog."default" NOT NULL,
    title text COLLATE pg_catalog."default" NOT NULL,
    description text COLLATE pg_catalog."default" NOT NULL,
    CONSTRAINT id_priem PRIMARY KEY (id_priem)
        INCLUDE(id_priem)
)

TABLESPACE pg_default;

ALTER TABLE public."Priem_cost"
    OWNER to postgres;
-- Заполнение таблицы стоимость приема
INSERT INTO public."Priem_cost" (id_priem, cost, title, description)
	VALUES 
	(default, '400', 'dlya prav', 'no description given'), 
	(default, '1200', 'base osmotr', 'no description given'),
	(default, '800', 'spravka v university', 'no description given'), 
	(default, '4600', 'MRT+base osmotr', 'no description given'),
	(default, '3000', 'Krov', 'no description given');





-- Создание таблицы прием
-- Table: public."Priem"

-- DROP TABLE public."Priem";

CREATE TABLE public."Priem"
(
    "id_patientFK" integer NOT NULL DEFAULT nextval('"Priem_id_patientFK_seq"'::regclass),
    "id_priemFK" integer NOT NULL DEFAULT nextval('"Priem_id_priemFK_seq"'::regclass),
    "id_doctorFK" integer NOT NULL DEFAULT nextval('"Priem_id_doctorFK_seq"'::regclass),
    date_priem date NOT NULL,
    time_priem text COLLATE pg_catalog."default" NOT NULL,
    patient_state text COLLATE pg_catalog."default" NOT NULL,
    recommendations text COLLATE pg_catalog."default" NOT NULL,
    CONSTRAINT "id_doctorFK" FOREIGN KEY ("id_doctorFK")
        REFERENCES public."Doctors" (id_doctor) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID,
    CONSTRAINT "id_patientFK" FOREIGN KEY ("id_patientFK")
        REFERENCES public."Medical_records" (id_patient) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID,
    CONSTRAINT "id_priemFK" FOREIGN KEY ("id_priemFK")
        REFERENCES public."Priem_cost" (id_priem) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID
)

TABLESPACE pg_default;

ALTER TABLE public."Priem"
    OWNER to postgres;
-- Заполнение таблицы прием
INSERT INTO public."Priem"(
	"id_patientFK", "id_priemFK", "id_doctorFK", date_priem, time_priem, patient_state, recommendations)
	VALUES 
	(11, 6, 16, '2020/01/03', '9:00', 'S', 'stay home' ), 
	(12, 7, 17, '2020/03/04', '10:00', 'S', 'specialized tablets'),
	(13, 8, 18, '20202/04/05', '12:00', 'N', 'stay home'), 
	(14, 9, 19, '2020/05/03', '15:00', 'N', 'no recommendations' ),
	(15, 10, 20, '2020/03/06', '18:00', 'N', 'stay home');	





-- Создание таблицы график работы 
-- Table: public."Schedule"

-- DROP TABLE public."Schedule";

CREATE TABLE public."Schedule"
(
    id_schedule integer NOT NULL DEFAULT nextval('"Schedule_id_schedule_seq"'::regclass),
    "id_doctorFK" integer NOT NULL DEFAULT nextval('"Schedule_id_doctorFK_seq"'::regclass),
    "id_cabinetFK" integer NOT NULL DEFAULT nextval('"Schedule_id_cabinetFK_seq"'::regclass),
    time_start text COLLATE pg_catalog."default" NOT NULL,
    time_end text COLLATE pg_catalog."default" NOT NULL,
    date date NOT NULL,
    CONSTRAINT id_schedule PRIMARY KEY (id_schedule),
    CONSTRAINT "id_cabinetFK" FOREIGN KEY ("id_cabinetFK")
        REFERENCES public."Cabinet" (id_cabinet) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    CONSTRAINT "id_doctorFK" FOREIGN KEY ("id_doctorFK")
        REFERENCES public."Doctors" (id_doctor) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)

TABLESPACE pg_default;

ALTER TABLE public."Schedule"
    OWNER to postgres;
-- Заполнение таблицы график работы
INSERT INTO public."Schedule"(
	id_schedule, "id_doctorFK", "id_cabinetFK", time_start, time_end, date)
	VALUES 
	(default, 16, 6, '9:00', '22:00', '2020/05/03'),
	(default, 17, 7, '11:00', '20:00', '2020/05/04'),
	(default, 18, 8, '9:00', '18:00', '2020/06/03'),
	(default, 19, 9, '7:00', '12:00', '2020/05/11'),
	(default, 20, 10, '12:00', '18:00', '2020/12/03');

