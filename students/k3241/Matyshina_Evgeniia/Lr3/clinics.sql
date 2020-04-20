-- Table: public."Cabinet"

-- DROP TABLE public."Cabinet";

CREATE TABLE public."Cabinet"
(
    id_cabinet integer NOT NULL,
    timetable text COLLATE pg_catalog."default" NOT NULL,
    administrator text COLLATE pg_catalog."default" NOT NULL,
    phone_number text COLLATE pg_catalog."default" NOT NULL,
    CONSTRAINT "Cabinet_pkey" PRIMARY KEY (id_cabinet)
)

TABLESPACE pg_default;

ALTER TABLE public."Cabinet"
    OWNER to postgres;

INSERT INTO public."Cabinet"(id_cabinet,timetable, administrator, phone_number)
	VALUES 
	(101, '9:00-20:30', 'Palamarchyk', '89207534056'), 
	(102, '9:00-21:00', 'Ivanova', '89312456789'),
	(103, '9:00-20:00', 'Petrov', '89217534054'), 
	(104, '9:00-22:00', 'Sumov', '89297534044'),
	(105, '9:00-21:00', 'Voronina', '89237434152');



-- Table: public."Diagnosis"

-- DROP TABLE public."Diagnosis";

CREATE TABLE public."Diagnosis"
(
    id_diagnosis integer NOT NULL,
    title text COLLATE pg_catalog."default" NOT NULL,
    description text COLLATE pg_catalog."default" NOT NULL,
    CONSTRAINT "Diagnosis_pkey" PRIMARY KEY (id_diagnosis)
)

TABLESPACE pg_default;

ALTER TABLE public."Diagnosis"
    OWNER to postgres;

INSERT INTO public."Diagnosis"(id_diagnosis, title, description)
	VALUES 
	(10, 'quinsy', 'Symptoms include fever, throat pain, trouble opening the mouth, and a change to the voice.'), 
	(11, 'rhinitis', 'Common symptoms are a stuffy nose, runny nose, sneezing, and post-nasal drip.'),
	(12, 'flu', 'Usually referred to as the flu or grippe, influenza is a highly infectious respiratory disease.'), 
	(13, 'pneumonia', 'The infection causes inflammation in the air sacs in your lungs, which are called alveoli.'),
	(14, 'anaemia', 'Anemia diminishes the capacity of the blood to carry oxygen.');





-- Table: public."Doctors"

-- DROP TABLE public."Doctors";

CREATE TABLE public."Doctors"
(
    id_doctor integer NOT NULL,
    "id_cabinet(FK)" integer NOT NULL,
    full_name text COLLATE pg_catalog."default" NOT NULL,
    specialization text COLLATE pg_catalog."default" NOT NULL,
    education text COLLATE pg_catalog."default" NOT NULL,
    female_male text COLLATE pg_catalog."default" NOT NULL,
    birth_date date NOT NULL,
    information text COLLATE pg_catalog."default" NOT NULL,
    time_working_in_clinics text COLLATE pg_catalog."default" NOT NULL,
    CONSTRAINT "Doctors_pkey" PRIMARY KEY (id_doctor),
    CONSTRAINT "id_cabinet(FK)" FOREIGN KEY ("id_cabinet(FK)")
        REFERENCES public."Cabinet" (id_cabinet) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID
)

TABLESPACE pg_default;

ALTER TABLE public."Doctors"
    OWNER to postgres;

INSERT INTO public."Doctors"( id_doctor, "id_cabinet(FK)", full_name, specialization, education, female_male, birth_date, information, time_working_in_clinics)
	VALUES 
	(1, 101, 'Kirill Petrov', 'avtolmolog', 'BD', 'male', '1985/05/09', 'no information', '3 year'), 
	(2, 103, 'Sam Petrovich', 'psiholog', 'MD', 'male', '1961/04/02', 'no information', '2 month'),
	(3, 102, 'Toni Urodyl', 'lor', 'BD', 'male', '1984/03/02', 'no information', '1 year'), 
	(4, 104, 'Viktoria Erokhina', 'urolog', 'MD', 'female', '1974/10/02', 'no information', '4 month'),
	(5, 105, 'Artem Tarasov', 'pulmanolog', 'MD', 'male', '1981/11/05', 'no information', '5 year');




-- Table: public."Medical records"

-- DROP TABLE public."Medical records";

CREATE TABLE public."Medical records"
(
    id_patient integer NOT NULL,
    contacts text COLLATE pg_catalog."default" NOT NULL,
    birth_date date NOT NULL,
    full_name text COLLATE pg_catalog."default" NOT NULL,
    "id_diagnosis(FK)" integer NOT NULL,
    CONSTRAINT "Medical records_pkey" PRIMARY KEY (id_patient),
    CONSTRAINT "id_diagnosis(FK)" FOREIGN KEY ("id_diagnosis(FK)")
        REFERENCES public."Diagnosis" (id_diagnosis) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID
)

TABLESPACE pg_default;

ALTER TABLE public."Medical records"
    OWNER to postgres;

INSERT INTO public."Medical records"(id_patient, contacts, birth_date, full_name, "id_diagnosis(FK)")
	VALUES 
	(44, '+7920754994', '1999/05/06', 'Pavel Naprimerov', 10), 
	(55, '+79201754995', '2000/09/07', 'Ekaterina Grigoreva', 12),
	(33, '+7930754988', '2010/05/02', 'Artem Medvedev', 11), 
	(42, '+7928753991', '1967/06/10', 'Nikita Orexov', 13),
	(51, '+7920754654', '1956/11/12', 'Sofia Morgunova', 14);



-- Table: public."Price"

-- DROP TABLE public."Price";

CREATE TABLE public."Price"
(
    id_priem integer NOT NULL,
    cost text COLLATE pg_catalog."default" NOT NULL,
    title text COLLATE pg_catalog."default" NOT NULL,
    CONSTRAINT "Price _pkey" PRIMARY KEY (id_priem)
)

TABLESPACE pg_default;

ALTER TABLE public."Price"
    OWNER to postgres;

INSERT INTO public."Price" (id_priem, cost, title)
	VALUES 
	(0101, '400', 'dlya prav'), 
	(0102, '1200', 'base osmotr'),
	(0103, '800', 'spravka v university'), 
	(0104, '4600', 'MRT+base osmotr'),
	(0105, '3000', 'Krov');




=-- Table: public."Priem"

-- DROP TABLE public."Priem";

CREATE TABLE public."Priem"
(
    "id_patient(FK)" integer NOT NULL,
    "id_priem(FK)" integer NOT NULL,
    "id_doctor(FK)" integer NOT NULL,
    date_priem date NOT NULL,
    time_priem text COLLATE pg_catalog."default" NOT NULL,
    patient_state text COLLATE pg_catalog."default" NOT NULL,
    recommendations text COLLATE pg_catalog."default" NOT NULL,
    CONSTRAINT "id_cabinet(FK)" FOREIGN KEY ("id_doctor(FK)")
        REFERENCES public."Doctors" (id_doctor) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID,
    CONSTRAINT "id_patient(FK)" FOREIGN KEY ("id_patient(FK)")
        REFERENCES public."Medical records" (id_patient) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID,
    CONSTRAINT "id_priem(FK)" FOREIGN KEY ("id_priem(FK)")
        REFERENCES public."Price" (id_priem) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID
)

TABLESPACE pg_default;

ALTER TABLE public."Priem"
    OWNER to postgres;

INSERT INTO public."Priem" ("id_patient(FK)", "id_priem(FK)", "id_doctor(FK)", date_priem, time_priem, patient_state, recommendations )
	VALUES 
	(44, 0101, 1, '2020/01/03', '9:00', 'S', 'stay home' ), 
	(55, 0103, 2, '2020/03/04', '10:00', 'S', 'specialized tablets'),
	(33, 0102, 4, '20202/04/05', '12:00', 'N', 'stay home'), 
	(42, 0104, 5, '2020/05/03', '15:00', 'N', 'no recommendations' ),
	(51, 0105, 3, '2020/03/06', '18:00', 'N', 'stay home');




-- Table: public."Timetable"

-- DROP TABLE public."Timetable";

CREATE TABLE public."Timetable"
(
    "id_doctor(FK)" integer NOT NULL,
    working_days text COLLATE pg_catalog."default" NOT NULL,
    not_working_days text COLLATE pg_catalog."default" NOT NULL,
    CONSTRAINT "id_doctor(FK)" FOREIGN KEY ("id_doctor(FK)")
        REFERENCES public."Doctors" (id_doctor) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID
)

TABLESPACE pg_default;

ALTER TABLE public."Timetable"
    OWNER to postgres;

INSERT INTO public."Timetable" ("id_doctor(FK)", working_days, not_working_days)
	VALUES 
	(1, 'mon', 'fri'), 
	(3, 'mon tues', 'wed'),
	(4, 'wed fri', 'sat'), 
	(5, 'sat', 'sun'),
	(2, 'sun', 'sat');






